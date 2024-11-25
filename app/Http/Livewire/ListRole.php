<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class ListRole extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    protected $listeners = ['updateRoleTable' => 'updated'];

    public function updated(){
        $this->reset();
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';

        return view('livewire.list-role',[
            'roles' => Role::where('name','like', $searchTerm)->with('permissions')->paginate(10),

        ]);
    }
}
