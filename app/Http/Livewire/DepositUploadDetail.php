<?php

namespace App\Http\Livewire;

use App\Models\SavingUpload;
use Livewire\Component;
use Livewire\WithPagination;

class DepositUploadDetail extends Component
{
    use WithPagination;

    public $deposit_upload_id;


    protected $paginationTheme = 'bootstrap';

    public $orderColumn = "employee_name";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon fa fa-solid fa-caret-up"></i>';

    public $searchTerm = "";

    public function updated()
    {
        $this->resetPage();
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


    public function getSavingsProperty()
    {
        return SavingUpload::where('saving_upload_detail_id', $this->deposit_upload_id)->get();
    }
    public function render()
    {
        $getSavings = SavingUpload::where('saving_upload_detail_id', $this->deposit_upload_id)->search('employee_name', $this->searchTerm)->orderby($this->orderColumn, $this->sortOrder)->select('*')->paginate(10);
        return view('livewire.deposit-upload-detail', [
            'deposits' => $getSavings
        ]);
    }
}
