<?php

namespace App\Livewire\Admin\Options;

use App\Models\Feature;
use App\Models\Option;
use Livewire\Component;

class AddNewFeature extends Component
{
    public $option;
    public $newFeature = [
        'value' => '123',
        'description' => 'kkkk'];

    public function render()
    {
        return view('livewire.admin.options.add-new-feature');
    }

    public function addFeature()
    {
        //@dump($this->option);
        //dd($this->newFeature);

        //validaciones de los inputs
        $this->validate([
            'newFeature.value' => 'required',
            'newFeature.description' => 'required'
        ]);
        // acceso a la relecion  de opcion y creo las nuevas features
        $this->option->features()->create([
            'value' => $this->newFeature['value'],
            'description' => $this->newFeature['description'],
        ]);

        //emito un evento ( succedio algo ), este evento debe ser escuchado por el metoddo 'updateOptionList' que esta en el componente padre.
        $this->dispatch('updateOptionList');

        //reseta (o vuelve los valores orignales), que contiene el arreglo de $newFeature
        $this->reset('newFeature');


    }
}
