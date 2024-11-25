<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Livewire\Component;

class CreateSupplier extends Component
{
    public $name, $address,$phone;

    public function store()
    {
        $this->validate([
            'name' => 'required|string|unique:suppliers,name',
            'address' => 'nullable|string',
            'phone' => 'required|numeric|unique:suppliers,phone'
        ]);
        Supplier::create([
            'name'=> $this->name,
            'address' =>$this->address,
            'phone' =>$this->phone
        ]);

       $this->name = "";
       $this->address = "";
       $this->phone = "";
       redirect()->route('supplier.all')->with([
        'message' => 'Supplier Created Successfully'
       ]);
    }
    public function render()
    {
        return view('livewire.create-supplier');
    }
}
