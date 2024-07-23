<?php

namespace App\Livewire\Products;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Models\Option;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Feature;
use Livewire\Attributes\Computed;

class AddToCartVariants extends Component
{
    public $options;
    public $product;
    public $qty = 1;
    public $selectedFeatures = [
        //'idOption' => 'idFeature

    ];

    public function mount()
    {


        // dump($this->options);
        foreach ($this->product->options as $option) {


            //$option->pivot  es igual a la tabla intermedia, en este caso OptionProduct
            //convierto los features de esa opcions que pertece a una producto dado en una coleccion
            //$features=$option->pivot->features;
            $featuresColecction = collect($option->pivot->features);
            //dump($featuresColecction);

            //creamos una nueva clave en el arreglo selectedFeatures, donde la clave es el id de la opcion y el valor es el id de la caracteristica
            $this->selectedFeatures[$option->id] = $featuresColecction->first()['id'];
            //dump($this->selectedFeatures);


        }
        //dump($this->selectedFeatures);


    }


    #[Computed]
    public function variant()
    {
        //la variable  variant computable, cambia cuando selecionamos otro feature_id
        //defino un metodo computable
        // obtengo todos los variates de ese producto
        //return $this->product->variants->();


        // para obtener solo las variates selecionados en el carra de compras, utlizo la funcion filter(function( { }));
        $res = $this->product->variants->filter(function ($variant) {
            return !array_diff($variant->features->pluck('id')->toArray(), $this->selectedFeatures);
        })->first();
        //dump($res);
        return $res;
        //$variant->features-> recupero todos los features
        //pluck('id'), trae el campo id
        //pluck('id')->toArray() convierte un arrreglo de id's
        //por ultimo el metodo !array_dif(campara el arreglo obtenito por la consulta, $variant->features->pluck('id')->toArray() con el selecionado por el usuario $this->selectedFeatures
        // compara, obtenemos los que coincidan  por id
        // como solo necesitamos el primero, utilizamos la funcion first();

    }

    public function add_to_cart()
    {
        // hago uso de la libreria ShoppingCart para agregar la cantidad de  un productos al carrito
        Cart::instance('shopping');
        Cart::add([
            // defino la mensaje a utilizar  paga pasar la cantidad del producto
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => [
                // el parametro options es un array asociativo que permite agregar mas informacion al producto de manera opcional
                // acceso a la variable variant computada, para obtener, imagen y etc
                'image' => $this->variant->image,
                //accedo al sku de la variante
                'sku' => $this->variant->sku,
                'features' => Feature::whereIn('id', $this->selectedFeatures)->pluck('description', 'id')->toArray(),
                /*
                 *  'features' => Feature::whereIn('id', $this->selectedFeatures)->get(pluck('description')->toArray()),
                 * obtengo el siguiente resultado:
                 * [ 'abc => 'pantalo rojo de tela',
                 *  'cba => 'tela de algodon',
                 *  'bca => 'talla M',
                 *   conclusion: abc,cba y bca es el id generado por el metodo pluck('description')->toArray()
                 *   Entonces para obtener el mismo que en la bd,  hago lo siguiente:
                 *      '1 => 'pantalo rojo de tela',
                 *      '2 => 'tela de algodon',
                 *      '3 => 'talla M',
                 *   'features' => Feature::whereIn('id', $this->selectedFeatures)->get(pluck('description','id')->toArray()),
                 *
                 * ]
                 *
                 */
            ],

        ]);
        // el metodo store(unParametro); guarda el carrito (instancia) en la base de datos en la tabla shopping_cart

        if(auth()->check()){
            // el metodo check() verifica si  la instancia de ese usuario esta autenticado
            //unParametro es el idUsuario autehnticad
            Cart::store(auth()->id());

        }

        //evento de producto agregado al carrito
        $this->dispatch('cartUpdated',Cart::count());

        //emito un evento al terminar con la carga de un producto al carrito
        //nombre del swal, y  [sus opciones]
        $this->dispatch('swal', [
            'title' => 'Producto agregado al carrito',
            'icon' => 'success',
            'timer' => 3000,
            /*
            'toast' => true,
            'position' => 'top-right',
            'showConfirmButton' => false,
            */
        ]);


    }


    public function render()
    {
        return view('livewire.products.add-to-cart-variants');
    }
}
