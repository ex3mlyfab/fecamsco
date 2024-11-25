<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadUserGuarantor extends Component
{
    use WithFileUploads;
    public $user_id;
    public $uploaded_file;

    public function store()
    {
        $this->validate([
            'uploaded_file' => 'required|file|size:2mb'
        ]);
        $user = User::findOrFail($this->user_id);
        $file = $this->uploaded_file; // your base64 encoded
            // using file pond
            // $image = str_replace('data:image/png;base64,', '', $image);
            // // $image = str_replace(' ', '+', $image);
            // @list($type, $file_data) = explode(';', $image);
            // @list(, $file_data) = explode(',', $file_data);
        $storage_path = public_path() . '/backend/images/guarantors';
        $extension = $file->getClientOriginalExtension();
            if(isset($user->member->membership_id))
            {
                $file = $user->member->membership_id;
                $file->delete( $storage_path,$user->member->membership_id);
            }

            $fileName = $user->fullname. Date('Y-m-d') . 'guarantor' . '.' . $extension;
            $file->move($storage_path, $fileName);
            $user->member()->update([
                'membership_id' => $fileName
            ]);

            $this->uploaded_file="";
            session()->flash('message', 'file uploaded successfully');
    }
    public function render()
    {
        return view('livewire.upload-user-guarantor');
    }
}
