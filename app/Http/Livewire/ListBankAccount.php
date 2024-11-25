<?php

namespace App\Http\Livewire;

use App\Models\BankAccount;
use Livewire\Component;
use Livewire\WithPagination;

class ListBankAccount extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    protected $listeners = ['updateBankTable' => 'updated '];

    public function updated(){
        $this->reset();
    }
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';

        return view('livewire.list-bank-account',
    [
        'accounts' => BankAccount::where('bank_name','like', $searchTerm)->paginate(10)
    ]);
    }
}
