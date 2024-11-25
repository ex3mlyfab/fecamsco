<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class ListPermission extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    protected $listeners = ['updatePermissionTable' => 'updated'];

    public function updated(){
        $this->reset();
    }
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';

        return view('livewire.list-permission', [
            'permissions' => Permission::where('name','like', $searchTerm)->paginate(10)
        ]);
    }
}
