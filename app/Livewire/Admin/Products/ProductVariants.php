<?php

namespace App\Livewire\Admin\Products;

use Livewire\Attributes\Computed;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Option;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Variant;
use App\Models\OptionProduct;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    /*
    public function deleteFeature($optionId, $featureId) {

        // dd($optionId->toArray(), $featureId->toArray());
        // $this->product->options()->updateExistingPivo => Actualiza un campo features (de tipo json) dentro de la tabla pivote 'options_product'.
        //  filtrando por $optionId y eliminando el feature con el ID $featureId.
        //array_filter(argumento A->pivot->features, argumento B)
        //  argumento A=> Filtra o busca el registro  option_id  la coincidencia de $optionId.
        // A->pivot->features => Obtenemos el valor completo del campo 'features' asociado a $optionId
        //  argumento B (funcion anonima) => function ($feature) use ($featureId) {
        //  //$featureId es el feature que quiero eliminar, retornando todos los features que no coincidan con $featureId.
        // return $feature['id'] != $featureId;}
        // array_filter le indicamos que compare el ID de cada objeto Feature con el ID de $featureId.


        $this->product->options()->updateExistingPivot($optionId, [
            'features' => array_filter($this->product->options()->find($optionId)->pivot->features, function($feature) use ($featureId) {
                return $feature['id'] != $featureId;
            })
        ]);
        // Actualizo la instancia de $product
        $this->product = $this->product->fresh();


    }
    */
    public function deleteFeature($optionId, $featureId)
    {
        // Buscar la relación en la tabla pivote
        $optionProduct = $this->product->options()->find($optionId);
        //dd($optionProduct->toArray());

        // Asegurarse de que se encontró la relación y que tiene el campo features
        if ($optionProduct && isset($optionProduct->pivot->features)) {
            // Filtrar las características para eliminar la que coincide con featureId
            $filteredFeatures = array_filter($optionProduct->pivot->features, function($feature) use ($featureId) {
                return $feature['id'] != $featureId;
            });

            // Actualizar la tabla pivote con las características filtradas
            $this->product->options()->updateExistingPivot($optionId, ['features' => $filteredFeatures]);

            // Actualizar la instancia del producto
            $this->product = $this->product->fresh();
        } else {
            // Manejar el caso donde no se encuentra la relación o no tiene el campo features
            throw new \Exception("La relación no se encontró o no contiene el campo 'features'.");
        }
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

        // Eliminar  las variantes del producto
        $this->generarVariantes();

    }

    public function deleteOption($optionId)
    {



        // dd($optionId->toArray());
        // $this->product->options() => accedemos a la tabla de intermedia Option_Product de la relacion muchos a muchos
        // Elimina la opción seleccionada
        $this->product->options()->detach($optionId);
        // Actualizo la instancia de $product
        $this->product = $this->product->fresh();

        // Eliminar  las variantes del producto
        $this->generarVariantes();


    }


    protected function generarVariantes(){
        //var_dump($this->product->id);
        $productoSelecionado = Product::find($this->product->id);
        $featureProductoSelecionado = $productoSelecionado->options->pluck('pivot.features');
        // variantas de un producto seleccionado
        //dd( ($featureProductoSelecionado->toArray()));
        $todasLasCombinaciones = $this->generarCombinaciones($featureProductoSelecionado);
        // elimino las variantes anteriores, y las vuelvo a crear sumando las actuales
        $this->product->variant()->delete();
        foreach ($todasLasCombinaciones as $unaCombinacion) {
            $unaVarianteDelProductoSelecionado = Variant::create([
                'product_id' => $this->product->id,
            ]);

            // Uso correcto del método attach
            $unaVarianteDelProductoSelecionado->features()->attach($unaCombinacion);
        }

        //return "Variante creada con exito";

    }
   public function generarCombinaciones($arrays, $indice = 0, $combinacion = [])
    {

        if ($indice == count($arrays)) {
            return [$combinacion];
        }
        $resultado = [];
        foreach ($arrays[$indice] as $item) {
            $combinacionesTemporal = $combinacion;//['a','a']
            // @var_dump($item);
            $combinacionesTemporal[] = $item['id']; //['a','a','a']
            // var_dump($combinacionesTemporal);
            //  @var_dump($combinacionesTemporal);
            //combinacion de un solo array en un resultado final
            $resultado = array_merge($resultado, $this->generarCombinaciones($arrays, $indice + 1, $combinacionesTemporal));


        }
        return $resultado;

    }

    /*
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

            $this->product->options()->attach($this->variantsSelect['option_id'],['features' => $this->variantsSelect['features']]);
            // ['features' => $this->variantsSelect['features']] => se guarda en la tabla pivote en formato json de manera automatica
            // porque el modelo OptionProduct tiene el atributo $casts = ['features' => 'array'];
                 $featureEncontrado = OptionProduct::find($this->variantsSelect['option_id'])->get();

            //falta crear las variantes en la tabla products
            $this->product=$this->product->fresh();

            //borro los valores de features por cambio de Option
            $this->reset(['variantsSelect','openModal']);


        }
    */
    public function saveFeature()
    {
        // Validar los datos de entrada
        $this->validate([
            'variantsSelect.option_id' => 'required',
            'variantsSelect.features.*.id' => 'required',
            'variantsSelect.features.*.value' => 'required',
            'variantsSelect.features.*.description' => 'required',
        ]);

        // Realizar la operación de attach para guardar en la tabla pivote OptionsProductos
        $this->product->options()->attach($this->variantsSelect['option_id'], ['features' => $this->variantsSelect['features']]);

        // Verificar si la operación de attach se completó exitosamente
        // Capturar cualquier excepción para asegurar que el flujo de ejecución no continúe en caso de error
        try {
            // Buscar la opción del producto recién adjuntado
            $featureEncontrado = OptionProduct::where('option_id', $this->variantsSelect['option_id'])
                ->where('product_id', $this->product->id)
                ->first();
            //dd($featureEncontrado->toArray());

            if ($featureEncontrado) {
                // Aquí puedes agregar la lógica que depende de $featureEncontrado
                // Por ejemplo, crear variantes en la tabla products
                $this->product = $this->product->fresh();

                // Generar las variantes del producto
                $this->generarVariantes();

                // Borrar los valores de features por cambio de Option
                $this->reset(['variantsSelect', 'openModal']);
            } else {
                // Manejar el caso donde no se encuentra la opción del producto
                // Puedes lanzar una excepción o manejar el error según sea necesario
                throw new \Exception('No se encontró la opción del producto después de adjuntar.');
            }
        } catch (\Exception $e) {
            // Manejar la excepción, por ejemplo, registrándola o lanzando una excepción personalizada
            // Log::error($e->getMessage());
            throw new \Exception('Error al adjuntar la opción al producto: ' . $e->getMessage());
        }
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
