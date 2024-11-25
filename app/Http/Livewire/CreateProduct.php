<?php

namespace App\Http\Livewire;

use App\Models\ProductService;
use App\Models\ProductServiceCategory;
use Livewire\Component;

class CreateProduct extends Component
{
    public $name;
    public $productcategory;
    public $description;
    public $reorder_level;


    public function store(){
            $this->validate([
                'name' => 'required|string|unique:product_services,name',
                'productcategory' => 'required',
                'description' => 'nullable|string'
            ]);

            ProductService::create([
                'name' => $this->name,
                'product_service_id' => $this->productcategory,
                'description' => $this->description,
                'added_by' => auth()->user()->id,
                'reorder_level' => $this->reorder_level,
                'minimum_level' => $this->reorder_level,
                'selling_price' =>0
            ]);
            $this->name = "";
            $this->productcategory = "";
            $this->description = "";
            $this->reorder_level = "";
            session()->flash('message', 'Product successfully created.');
    }

    public function render()
    {
        return view('livewire.create-product',[
            'categories' => ProductServiceCategory::all()
        ]);
    }
}
