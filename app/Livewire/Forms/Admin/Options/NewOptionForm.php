<?php

namespace App\Livewire\Forms\Admin\Options;

use App\Models\Feature;
use App\Models\Option;
use Livewire\Form;

class NewOptionForm extends Form
{
    //NewOptionForm es una clase, que permite refactorizar codigo, es decir. utilizar esta clase en diferentes clases de Livewire


    //arreglo newOption, contiene los 3 atributos a rellenar de la entidad Option
    //$newOption->name: nombre de la descripcion, ejemplo Tamanio, Color y etc
    //$newOption->type: tipo de dato. Ejemplo: texto si es color.
    //$newOption->features: representa la entidad features en el cual contiene 2 campos ['value','description']

    //atributos, atributos inicializados
    public $name = '';
    public $type = 1;
    public $features = [
        ['value' => '',
            'description' => '',]
    ];

    public function rules(): array
    {

        $rules = ['name' => ' required|max:150', 'type' => 'required|in:1,2', 'features' => 'required|array|min:1',];


        foreach ($this->features as $index => $feature) {
            // validaciones de los features segun el tipo
            if ($this->type == 1) {
                //type==1 es texto
                $rules['features.' . $index . '.value'] = 'required|max:50';

            } else {
                //type==2 es color
                $rules['features.' . $index . '.value'] = 'required|regex:/^#[a-f0-9]{6}$/i';
                //^#[a-f0-9]+$ es una exp. regular que verifique lo siguiente:
                // 1) comienza con *. 2) 'a hasta la f'. 3) de 0 a 9. 4) x6 valores
            }

            $rules['features.' . $index . '.description'] = 'required|min:10|max:150';
// Validaciones del features son correctas, se valida los atributos de $option
        }
        return $rules;
    }

    public function validationAttributes()
    {
        $attributes = [
            'name' => 'nombre',
            'type' => 'tipo',
            'features' => 'valores',

        ];
        foreach ($this->features as $index=> $feature) {
            //$filteredFeature = array_intersect_key($feature, array_flip(['value', 'description']));
           // dump($filteredFeature);

            $attributes['features.'.$index.'.value']='valor '.($index+1);
            $attributes['features.'.$index.'.description']='Descripciones '.($index+1);



        }


        return $attributes;

    }

    public function addFeature()
    {

        $this->features[] = [
            'value' => '',
            'description' => '',
        ];
    }


    public function save()
    {
        //metodo para crear opciones desde OptionForm ( desacoplamiento )

        //ejecuto las validaciones de los inputs
        //dd($this->name);
        $this->validate();
        //caso positivo, sigo con la ejecucion de la creacion del objeto Option

        //creo el objeto option
        $optionCreateNew = Option::create([
            'name' => $this->name,
            'type' => $this->type,
        ]);

        //dd($optionCreateNew->id);

        //Creo los features corresponientes a cada option
        foreach ($this->features as $feature) {
            //'name','type','options_id'
            //Forma n1  (manera explicita):
            //$featureIndex es un objeto del array $this->newOption['features']
            //  dd($featureIndex);
            $newFeature = Feature::create([
                // dd($optionCreateNew->id),
                'value' => $feature['value'],
                'description' => $feature['description'],
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
        //reset borra el valor de todos los atributos
        //dd('ultimo paso');
        $this->reset();


    }

    public function removeFeature($index)
    {
        //dd($id);
        //el metodo unset, elimina una asociacion dentro de un arreglo
        unset($this->features[$index]);
        // si tengo 3 features de 0 hasta 2, y elimino feature con pos 1, seguimos teniendo la misma cantidad 0 y 2 (original, nose modifica).
        //  Como resultado, una posicion vacia.  Dos soluciones:
        // condicional para vericar cuando un arreglo tenga una posicion nula.
        //  array_values, restablece de cero los Indices de los featues, por cada operacion.
        $this->features = array_values($this->features);
        // $this->newOption['features'] contiene los indices ordenado, quitando espacios vacios con los valores actuales
    }

}

