<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditRole extends Component
{
    public $role;
    public $role_id;
    public $role_name;
    public $role_permissions;
    public $permissions = [];

    public function mount(){
        $this->role = Role::find($this->role_id);
        $this->role_name =$this->role->name;
        $this->permissions = $this->role->permissions->pluck('id')->toArray();
    }
    public function store()
    {
        if($this->permissions){
            $this->role->syncPermissions($this->permissions);
        }
    
    }
    public function render()
    {
        $stored_permissions = Permission::all();
        return view('livewire.edit-role', [
            'stored_permissions' => $stored_permissions
        ]);
    }
}
