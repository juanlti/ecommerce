<?php

namespace App\Livewire;
use App\Models\Family;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Computed;
class Navigation extends Component
{
    public $families;
    public $family_id;






    public function mount(){
        $this->families=Family::all();
        //obtengo el primer id de la familia utilizando la coleccion de familias
        $this->family_id=$this->families->first()->id;

    }
    #[Computed()]
    public function categories(){

        return Category::where('family_id',$this->family_id)->with('subcategory')->get();

    }
    public function render()
    {
        return view('livewire.navigation');

    }
    #[Computed()]
    public function familyName(){
        return Family::find($this->family_id)->name;

    }

}
