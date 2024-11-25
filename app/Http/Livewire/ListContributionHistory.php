<?php

namespace App\Http\Livewire;

use App\Models\Deduction;
use Livewire\Component;
use Livewire\WithPagination;

class ListContributionHistory extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $user_id;
    protected $listeners = ['updateContributionTable' => 'updated'];

    public function updated(){
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.list-contribution-history',
    [
        'deductions' => Deduction::where('user_id', $this->user_id)->orderBy('created_at', 'DESC')->paginate(10)
    ]);
    }
}
