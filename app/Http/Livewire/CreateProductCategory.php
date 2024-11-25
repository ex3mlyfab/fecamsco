<?php

namespace App\Http\Livewire;

use App\Models\ProductServiceCategory;
use Livewire\Component;

class CreateProductCategory extends Component
{
    public $productcategory = "";

    public function store()
    {
        $this->validate([
            'productcategory' => 'required|unique:product_service_categories,name'
        ]);

        ProductServiceCategory::create([
            'name' => $this->productcategory,
            'added_by' => auth()->user()->id
        ]);
        $this->productcategory = "";
        $this->emitTo('list-product-service-category', 'updateProductCategoryTable');

        session()->flash('message', 'Product Category Created Successfully.');

    }
    public function render()
    {
        return view('livewire.create-product-category');
    }
}
