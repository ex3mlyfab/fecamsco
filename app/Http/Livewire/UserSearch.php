<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserSearch extends Component
{

    use WithPagination;
    public $searchTerm;
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        return view('livewire.user-search', [
            'users' => User::where('first_name','like', $searchTerm)->orWhere('email', 'like',$searchTerm)->paginate(10)
        ]);
    }
}
