<?php

namespace App\Http\Livewire;

use App\Jobs\DepositImportJob;
use App\Models\SavingUploadDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class DepositUpload extends Component
{
    use WithFileUploads;
    public $batchId;
    public $uploaded_file;
    public $importing = false;
    public $importFilePath;
    public $importFinished = false;
    public $deduction_period;
    public $saving_upload_detail;

    public function import()
    {
        $this->validate([
            'uploaded_file' => 'required',
            'deduction_period' => 'required|date|unique:saving_upload_details,deduction_period',

        ]);
        $this->importing = true;
        $this->importFilePath = $this->uploaded_file->store('imports');
        // try {
        $converted_date= Carbon::createFromFormat('Y-m', $this->deduction_period);
            $this->saving_upload_detail = SavingUploadDetail::create([
                'uploaded_by' => auth()->user()->id,
                'deduction_period' =>Carbon::parse($converted_date)->startOfMonth() ,
                'uploaded_file' => $this->importFilePath,
                'ministry_name' => 'FEDERAL STAFF HOSPITAL JABI',
                'element_name' => 'CTSS_FESHA JABI',
                'upload_status' => 0

            ]);
        // } catch (\Exception $ex) {
        //     session()->flash('error', 'Something goes wrong!!');
        // }

        $batch = Bus::batch([
            new DepositImportJob($this->importFilePath, $this->saving_upload_detail->id),
        ])->dispatch();

        $this->batchId = $batch->id;
    }
    public function getImportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function updateImportProgress()
    {
        // $this->importFinished = $this->importBatch->finished();

        $this->importFinished = $this->importBatch->finished();

        if ($this->importFinished) {
            //Storage::delete($this->importFilePath);
            $this->importing = false;
            $this->uploaded_file = "";
            $this->deduction_period = "";
            $this->dispatchBrowserEvent('deposit-upload');

        }

    }

    public function render()
    {
        return view('livewire.deposit-upload');
    }
}
