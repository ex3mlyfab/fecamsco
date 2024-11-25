<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TableCellAction extends Component
{
    public $link;
    public $link_id;
    public $method;
    public function render()
    {
        return view('livewire.table-cell-action');
    }
}
