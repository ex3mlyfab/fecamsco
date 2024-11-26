<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UpdateUserEmail extends Component
{
    private User $user;
    public $user_id;
    public $email;
    public $password;


    public function store()
    {
         $this->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:5'
        ]);
        $this->user = User::find($this->user_id);
// dd($this->email);
        $this->user->email = $this->email;
        $this->user->password = bcrypt($this->password);
        $this->user->save();
        $this->emit('updateUserEmail', 'email updated successfully');
        redirect()->route('members.list');
    }
    public function render()
    {
        return view('livewire.update-user-email');
    }
}
