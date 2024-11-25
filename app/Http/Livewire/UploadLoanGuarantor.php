<?php

namespace App\Http\Livewire;

use App\Models\Loan;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadLoanGuarantor extends Component
{
    use WithFileUploads;
    public $loan;
    public $guarantor_form;
    public $uploaded = false;

    public function store(){
        $this->validate([
            'guarantor_form' => 'required|file'
        ]);
        $loan = Loan::findOrFail($this->loan);


        $file = $this->guarantor_form; // your base64 encoded
                // using file pond
                // $image = str_replace('data:image/png;base64,', '', $image);
                // // $image = str_replace(' ', '+', $image);
                // @list($type, $file_data) = explode(';', $image);
                // @list(, $file_data) = explode(',', $file_data);
                $storage_path = public_path() . '/backend/images/loanguarantor';
                $extension = $file->getClientOriginalExtension();

                $fileName = $loan->user->fullname. Date('Y-m-d') . 'member' . '.' . $extension;
                $file->move($storage_path, $fileName);
                $loan->update([
                    'loan_form' => $fileName
                ]);
                $this->reset($this->loan, $this->guarantor_form);
                session()->flash('message', 'File is uploaded  Successfully.');
                $this->emit('file-uploaded');
    }

    public function render()
    {
        return view('livewire.upload-loan-guarantor');
    }
}
