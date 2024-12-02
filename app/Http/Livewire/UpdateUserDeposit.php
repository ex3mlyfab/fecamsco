<?php

namespace App\Http\Livewire;

use App\Models\Deposit;
use App\Models\User;
use Livewire\Component;

class UpdateUserDeposit extends Component
{
     private User $user;

     public $amount;
     public $user_id;


     public function store()
     {
         $this->user = User::find($this->user_id);
        Deposit::create([
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'saving_upload_id' => 0,
            'deposit_date' => now(),
            'approved_by' => auth()->user()->id,
            'approval_date' => now(),
        ]);
         $this->user->save();
         $this->emit('updateUserDeposit', 'deposit updated successfully');
         redirect()->route('members.list')->with('message', 'Deposit updated successfully');

     }
    public function render()
    {
        return view('livewire.update-user-deposit');
    }
}
