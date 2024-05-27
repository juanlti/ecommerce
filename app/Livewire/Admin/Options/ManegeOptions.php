<?php

namespace App\Livewire\Admin\Options;

use Livewire\Component;
use App\Models\Option;
use App\Models\Category;
class ManegeOptions extends Component
{
    //defino una variable $options, almacena todas las opciones que esta en la bd
    public $options;

    public function mount(){
        //carga inicial de la variable $options
        //sintaxis para resolver problema de n+1
        $this->options=Option::with('features')->get();


    }
    public function render()
    {
        return view('livewire.admin.options.manege-options');
    }
}
