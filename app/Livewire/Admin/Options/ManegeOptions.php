<?php

namespace App\Livewire\Admin\Options;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Option;
use App\Models\Feature;
use App\Livewire\Forms\Admin\Options\NewOptionForm;
use Illuminate\Database\Eloquent\Collection;

class ManegeOptions extends Component
{
    //defino una variable $options, almacena todas las opciones que esta en la bd
    // $options es una variable
    public $options;
    //$openModel, mantiene el estado del modal en el cliente. $openModal=true (abierto), $openModal=false (cerrado)
    public $openModal = false;

    //atributo, este se genera con la clase FormObject, el mismo se encuentra con valores inicializados
    public NewOptionForm $newOptionForm;


    public function deleteFeature(Feature $feature){
        //dd($feature->toArray());
        $feature->delete();
    }
    public function deleteOption(Option $option){
        //dd($option->toArray());
        $option->delete();
        $this->options = Option::with('features')->get();
    }

    //este este metodo 'addFeature' escucha emi
    #[On('updateOptionList')]
    public function updateOptionList(){
        //actualiza la lista de los features segun el componente hijo (addNewFeature)
        $this->options = Option::with('features')->get();
    }


    public function addFeature()
    {
       // dd('estoy en addFeature');
        //$this->options = Option::with('features')->get();
        $this->newOptionForm->addFeature();
    }


    public function addOpt()
    {
        //dd($this->newOption['features']);

        //ejecuto la creacion de Option
        $this->newOptionForm->save();

        //actualizar el contenido
        $this->options = Option::with('features')->get();



        //@dump(' solo si se guarda info');
        $this->reset('openModal');
        //emito un evento (dispatch), este evento es un alerta, y la alerta contiene un mensaje de operacion exitosa
        $this->dispatch('swal', [
            'icon' => 'succes',
            'title' => '!Bien hecho!',
            'text' => 'La opcion se agrego correctamente',
        ]);
        // dd($newOption??'es nulo');
    }
    public function removeFeature($index)
    {

        $this->newOptionForm->removeFeature($index);

    }
    public
    function mount()
    {
        //carga inicial de la variable $options
        //sintaxis para resolver problema de n+1
        $this->options = Option::with('features')->get();
        //$this->newOptionForm = new NewOptionForm();

    }
    public
    function render()
    {
        return view('livewire.admin.options.manege-options');
    }
}
