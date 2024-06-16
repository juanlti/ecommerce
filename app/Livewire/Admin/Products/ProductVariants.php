<?php

namespace App\Livewire\Admin\Products;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Option;
use App\Models\Feature;

class ProductVariants extends Component
{
    public $openModal = false;
    public $options;
    //$product es una instancia del producto selecionado y  lo recibimos por parametro.
    public $product;
    //$variantsSelect contiene el featureSelecionado=['idOption',['featuresPertenecenIdOption']]
    public $variantsSelect = [
        // PARTE 2)  contiene el valor selecionado por el usuario
        'option_id' => '',
        'features' => [
            // PARTE 3) FEATURES QUE PERTECENEN A OPTION_ID
            [
                'id' => '',
                'value' => '',
                'description' => '',
            ],
        ],
    ];

    public function updatedVariantsSelectOptionId()
    {
        //dump('cambiooooo');
        //borro los valores de features por cambio de Option
        $this->variantsSelect['features'] = [
            [
                'id' => '',
                'value' => '',
                'description' => '',
            ],

        ];


    }

    #[Computed()]
    public function features()
    {
        // Busco los feature que correspondan al option_id
        // dd($this->variantsSelect['option_id']);
        return Feature::where('option_id', $this->variantsSelect['option_id'])->get();
    }

    public function addFeature()
    {
        // dd('estoy en el metodo addFeature');
        $this->variantsSelect['features'][] = [
            'id' => '',
            'value' => '',
            'description' => '',
        ];
    }

    public function mount()
    {
        // Carga total opciones, al momento de inicializar el componente ProductVariants
        $this->options = Option::all();
        // dd($opcion->toArray());
    }

    public function removeFeature($index)
    {
        //dd($index);
        //busca y elemina el feature selecionado
        unset($this->variantsSelect['features'][$index]);
        //creo un nuevo array con los valores que no son nulos
        $this->variantsSelect['features'] = array_values($this->variantsSelect['features']);

    }

    public function saveFeature()
    {

        $this->validate([
            'variantsSelect.option_id'=> 'required',
            'variantsSelect.features.*.id'=> 'required',
            'variantsSelect.features.*.value'=> 'required',
            'variantsSelect.features.*.description'=> 'required',
        ]);

        //dd($this->variantsSelect);
        //metodo attach, se encarga de guardar en la tabla pivote (o intermedia) OptionsProductos

        $this->product->options()->attach($this->variantsSelect['option_id'],
        ['features' => $this->variantsSelect['features']]);
        // ['features' => $this->variantsSelect['features']] => se guarda en la tabla pivote en formato json de manera automatica
        // porque el modelo OptionProduct tiene el atributo $casts = ['features' => 'array'];

        //falta crear las variantes en la tabla products

        //borro los valores de features por cambio de Option
        $this->reset(['variantsSelect','openModal']);


    }

    public function feature_change($index)
    {
        //dump('estoy'.$index);
        //obtengo el id del feature selecionado
        //dd($this->variantsSelect['features'][$index]['id']);
        $featureEncontrado = Feature::find($this->variantsSelect['features'][$index]['id']);
        //recupero el id obtenido
        if($featureEncontrado){
            $this->variantsSelect['features'][$index]['value']=$featureEncontrado->value;
            $this->variantsSelect['features'][$index]['description']=$featureEncontrado->description;

        }

        //dd($this->variantsSelect);

    }

    public function render()
    {
        return view('livewire.admin.products.product-variants');
    }
}
