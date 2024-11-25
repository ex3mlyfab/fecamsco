<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UpdateContribution extends Component
{
    public $deduction_amount;
    public $effective_from;
    public $user_id;

    public function store(){
        $this->validate([
            'deduction_amount' => 'required|numeric|min:5000',
            'effective_from' => 'required'
        ]);

        $user =  User::findOrFail($this->user_id);
        $user->deductions()->create([
            'deduction_amount' => $this->deduction_amount,
            'effective_from' => $this->effective_from,
            'status' => 1
        ]);

        $this->deduction_amount = "";
        $this->effective_from = "";

        session()->flash('message', 'deduction created Successfully');
        $this->emitTo('list-contribution-history', 'updateContributionTable');

    }
    public function render()
    {
        return view('livewire.update-contribution');
    }
}
