<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRole extends Component
{
    public $role_name =  '';
    public $permissions = [];


    public function store()
    {
        $this->validate([
            'role_name' => 'required|string|unique:roles,name'
        ]);
       
        $role = Role::create([
            'name' => $this->role_name,
            'guard_name' => 'web'
        ]);
        if($this->permissions){
            $role->syncPermissions($this->permissions);
        }
        $this->role_name = '';
        $this->permissions = [];
        $this->emitTo('list-role', 'updateRoleTable');
        session()->flash('message', 'Role Has Been Created Successfully.');

    }
    public function render()
    {
        $stored_permissions = Permission::all();
        return view('livewire.create-role', [
            'stored_permissions' => $stored_permissions
        ]);
    }
}
