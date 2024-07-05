<?php

namespace App\Livewire;
use App\Models\Family;
use Livewire\Component;

class Navigation extends Component
{
    public $families;
    public $family_id;

    public function mount(){
        $this->families=Family::all();
        //obtengo el primer id de la familia utilizando la coleccion de familias
        $this->family_id=$this->families->first()->id;

    }
    public function render()
    {
        return view('livewire.navigation');
    }
}
