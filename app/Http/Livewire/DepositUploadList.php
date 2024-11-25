<?php

namespace App\Http\Livewire;

use App\Models\SavingUploadDetail;
use Livewire\Component;
use Livewire\WithPagination;

class DepositUploadList extends Component
{
    use WithPagination;

    protected $listeners = ['updateDepositTable' => 'updated'];
    protected $paginationTheme = 'bootstrap';
    public $orderColumn = "deduction_period";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon fa fa-solid fa-caret-up"></i>';

    public $searchTerm = "";

    public function updated()
    {
        $this->reset();
    }
    public function sortOrder($columnName = "")
    {
        $caretOrder = "up";
        if ($this->sortOrder == 'asc') {
            $this->sortOrder = 'desc';
            $caretOrder = "down";
        } else {
            $this->sortOrder = 'asc';
            $caretOrder = "up";
        }
        $this->sortLink = '<i class="sorticon fa-solid fa-caret-' . $caretOrder . '"></i>';

        $this->orderColumn = $columnName;
    }

    public function render()
    {
        $deposits = SavingUploadDetail::orderby($this->orderColumn,$this->sortOrder)->select('*');

        if(!empty($this->searchTerm)){

             $deposits->orWhere('deduction_period','like',"%".$this->searchTerm."%");

        }

        $deposits = $deposits->paginate(10);
        return view('livewire.deposit-upload-list', ['deposits' => $deposits]);
    }
}
