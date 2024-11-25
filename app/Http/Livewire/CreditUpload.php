<?php

namespace App\Http\Livewire;

use App\Jobs\CtlsImportJob;
use App\Models\CtlsDetails;
use App\Models\SavingUploadDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreditUpload extends Component
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
            $this->saving_upload_detail = CtlsDetails::create([
                'uploaded_by' => auth()->user()->id,
                'deduction_period' => Carbon::createFromFormat('Y-m', $this->deduction_period),
                'uploaded_file' => $this->importFilePath,
                'ministry_name' => 'FEDERAL STAFF HOSPITAL JABI',
                'element_name' => 'CTSS_FESHA JABI',
                'upload_status' => 0

            ]);

            // dd($this->saving_upload_detail->id);
        // } catch (\Exception $ex) {
        //     session()->flash('error', 'Something goes wrong!!');
        // }


        $batch = Bus::batch([
            new CtlsImportJob($this->importFilePath, $this->saving_upload_detail->id),
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
            $this->dispatchBrowserEvent('credit-upload');
            $this->uploaded_file = "";
            $this->deduction_period = "";
        }

    }

    public function render()
    {
        return view('livewire.credit-upload');
    }
}
