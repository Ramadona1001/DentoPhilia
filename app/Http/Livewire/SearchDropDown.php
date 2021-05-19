<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class SearchDropDown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];
        if (strlen($this->search) >= 2) {
            $searchResults = User::where('name','like','%'.$this->search.'%')->limit(5)->get();
        }
        return view('livewire.search-drop-down',[
            'searchResults' => $searchResults
        ]);
    }
}
