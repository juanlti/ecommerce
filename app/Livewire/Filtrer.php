<?php

namespace App\Livewire;

use Livewire\Component;

class Filtrer extends Component
{

    public $family;
    public function render()
    {
        return view('livewire.filtrer');
    }
}
