<?php

namespace App\Livewire\Products;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;
    public $qty = 1;
    //aclaracion, la variable qty es la cantidad de productos que se van a agregar al carrito,
    // ejemplo: si el usuario desea agregar 5 productos al carrito, este componente sigue con el valor inicializado hasta que un metodo lo modifique, y recien ahi, pasa a valor 5 en el componentede livewire
    // con esto logramos evitar llamadas (o comnunicacion), innecesarias al servidor


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
                'image' => $this->product->image,
                'sku' => $this->product->sku,
                'features' => [],
            ],

        ]);

        // el metodo store(unParametro); guarda el carrito (instancia) en la base de datos en la tabla shopping_cart

        if(auth()->check()){
            // el metodo check() verifica si  la instancia de ese usuario esta autenticado
            //unParametro es el idUsuario autehnticad
            Cart::store(auth()->id());

        }

        //evento de producto agregado al carrito
        //hago la conexion entre el back y el front, utilizando el nombre del metodo y el parametro que se va a enviar
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
        return view('livewire.products.add-to-cart');
    }
}
