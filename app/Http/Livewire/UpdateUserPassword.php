<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UpdateUserPassword extends Component
{
    private $user;

    public $user_id;

    public function store()
    {
        $this->validate([
            'password' => 'required|string|min:5'
        ]);

        $this->user = User::find($this->user_id);
        $this->user->password = bcrypt($this->password);
        $this->user->save();
        $this->emit('updateUserPassword', 'password updated successfully');
    }
    public function render()
    {
        return view('livewire.update-user-password');
    }
}
