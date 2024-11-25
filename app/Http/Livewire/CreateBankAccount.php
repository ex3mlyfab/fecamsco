<?php

namespace App\Http\Livewire;

use App\Models\BankAccount;
use Livewire\Component;

class CreateBankAccount extends Component
{
    public $bank_name, $account_number,$initial_balance;

    public function store(){
        $this->validate([
            'bank_name' => 'required|string',
            'account_number' => 'required|numeric',
            'initial_balance' =>  'sometimes|numeric'
        ]);

        $newAccount = BankAccount::create([
            'bank_name' => $this->bank_name,
            'account_number' => $this->account_number,
            'initial_balance' => $this->initial_balance,
            'updated_by' =>auth()->user()->id
        ]);
        $this->bank_name = "";
        $this->account_number ="";
        $this->initial_balance = 0;
        session()->flash('message', 'Account Created Successfully.');
    }
    public function render()
    {
        return view('livewire.create-bank-account');
    }
}
