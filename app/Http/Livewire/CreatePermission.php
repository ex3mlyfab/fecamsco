<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class CreatePermission extends Component
{
    public $permission_name =  '';


    public function store()
    {
        $this->validate([
            'permission_name' => 'required|string|unique:permissions,name'
        ]);

        $permission = Permission::create([
            'name' => $this->permission_name,
            'guard_name' => 'web'
        ]);
        $this->permission_name = '';
        $this->emitTo('list-permission', 'updatePermissionTable');
        session()->flash('message', 'permission Has Been Created Successfully.');
    }

    public function render()
    {
        return view('livewire.create-permission');
    }
}
