<?php

namespace App\Livewire\Admin\Options;

use Livewire\Component;
use App\Models\Option;
use App\Models\Feature;
use App\Models\Category;


class ManegeOptions extends Component
{
    //defino una variable $options, almacena todas las opciones que esta en la bd
    // $options es una variable
    public $options;
    //$openModel, mantiene el estado del modal en el cliente. $openModal=true (abierto), $openModal=false (cerrado)
    public $openModal = false;


    //arreglo newOption, contiene los 3 atributos a rellenar de la entidad Option
    //$newOption->name: nombre de la descripcion, ejemplo Tamanio, Color y etc
    //$newOption->type: tipo de dato. Ejemplo: texto si es color.
    //$newOption->features: representa la entidad features en el cual contiene 2 campos ['value','description']
    public array $newOption = [
        'name' => '',
        'type' => 1,
        'features' => [
            ['value' => '',
                'description' => '']
        ]

    ];


    public function addFeature()
    {
        $this->newOption['features'][] = [
            'value' => '',
            'description' => '',
        ];
    }

    public function addOpt()
    {
        //dd($this->newOption['features']);
        //defino reglas de validaciones
        $rules = [
            'newOption.name' => ' required|max:150',
            'newOption.type' => 'required|in:1,2',
            'newOption.features' => 'required|array|min:1',

        ];
        foreach ($this->newOption['features'] as $index => $feature) {
            // validaciones de los features segun el tipo
            if ($this->newOption['type'] == 1) {
                //type==1 es texto
                $rules['newOption.features.' . $index . '.value'] = 'required|max:50';

            } else {
                //type==2 es color
                $rules['newOption.features.' . $index . '.value'] = 'required|regex:/^#[a-f0-9]{6}$/i';
                //^#[a-f0-9]+$ es una exp. regular que verifique lo siguiente:
                // 1) comienza con *. 2) 'a hasta la f'. 3) de 0 a 9. 4) x6 valores
            }

            $rules['newOption.features.' . $index . '.description'] = 'required|min:10|max:150';
            // Validaciones del features son correctas, se valida los atributos de $option

        }


        $this->validate($rules);


        //creo el objeto option
        $optionCreateNew = Option::create([
            'name' => $this->newOption['name'],
            'type' => $this->newOption['type'],
        ]);

        //dd($optionCreateNew->id);

        //Creo los features corresponientes a cada option
        foreach ($this->newOption['features'] as $index => $featureIndex) {
            //'name','type','options_id'
            //Forma n1  (manera explicita):
            //$featureIndex es un objeto del array $this->newOption['features']
            //  dd($featureIndex);
            $newFeature = Feature::create([
                'value' => $featureIndex['value'],
                'description' => $featureIndex['description'],
                'option_id' => $optionCreateNew->id,

            ]);
            // Forma n2 (manera implicita):  crear y relacionar los Features con su Option al mismo tiempo
            /*
            $optionCreateNew->features()->create([
                'value'=>$featureIndex['value'],
                'description'=>$featureIndex['description'],
            ]);
            */
        }
        //actualizar el contenido
        $this->options = Option::with('features')->get();
        //metodo reset('cierroModalenFalse','reseteo las variables de newOption')
        $this->reset('openModal', 'newOption');
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
        //dd($id);
        //el metodo unset, elimina una asociacion dentro de un arreglo
        unset($this->newOption['features'][$index]);
        // si tengo 3 features de 0 hasta 2, y elimino feature con pos 1, seguimos teniendo la misma cantidad 0 y 2 (original, nose modifica).
        //  Como resultado, una posicion vacia.  Dos soluciones:
        // condicional para vericar cuando un arreglo tenga una posicion nula.
        //  array_values, restablece de cero los Indices de los featues, por cada operacion.
        $this->newOption['features'] = array_values($this->newOption['features']);
        // $this->newOption['features'] contiene los indices ordenado, quitando espacios vacios con los valores actuales
    }
    public
    function mount()
    {
        //carga inicial de la variable $options
        //sintaxis para resolver problema de n+1
        $this->options = Option::with('features')->get();
    }
    public
    function render()
    {
        return view('livewire.admin.options.manege-options');
    }
}
