<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserSelectResult extends Component
{
    public $result;
    public $member_id;



    public function render()
    {
        return view('livewire.user-select-result');
    }
}
