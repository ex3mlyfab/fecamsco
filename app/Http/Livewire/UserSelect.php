<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;

class UserSelect extends Component
{
    public $member_ippis =  '';

    public $result = [];
    public $member_id = [];

    public function search(){

        if($this->member_ippis != ""){
                  $resulting =  Member::where('ippis_no', $this->member_ippis)->with('user')->get();

                  $this->result= $resulting;
                  $this->member_id = $resulting;
        }
    }

    // public function getSelectedMemberProperty(){
    //     if($this->member_ippis){
    //         return Member::where('ippis_no', $this->member_ippis)->with('user')->get();
    //     }

    // }


    public function render()
    {

        return view('livewire.user-select');
    }
}
