<?php

namespace App\Http\Livewire;

use App\Models\ProductServiceCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ListProductCategory extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    protected $listeners = ['updateProductCategoryTable' => 'updated'];

    public function updated(){
        $this->reset();
    }
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        return view('livewire.list-product-category', [
            'categories' => ProductServiceCategory::where('name','like', $searchTerm)->paginate(10)
        ]);
    }
}
