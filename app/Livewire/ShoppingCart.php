<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ShoppingCart extends Component
{


    public $cartAll;
    //creo una variable de bloqueo para evitar una condicion de carrera en la base de datos respecto
    // a la actualizacion de productos en el carrito de compra.

    public $updatingCart = false;
    //si $updatingCart  esta en false, esta desocupado, puede actualizar
    // si $updatingCart esta en true, esta ocupado, debe esperar
    public function mount()
    {
        //carga inicial de datos
        Cart::instance('shopping');
    }

    public function increase(string $rowId)
    {
        if ($this->updatingCart) {
            //esta ocupado, no puede actualizar, se va del metodo increase() por el return
            return;

        }
        //declaro la instancia utilizar
        Cart::instance('shopping');
        // ocupa recurso, por lo tanto, nadie mas puede realizar esta accion hasta que termine ( pase a false)
        $this->updatingCart = true;

        if (auth()->check()) {
            // el metodo check() verifica si  la instancia de ese usuario esta autenticado, si es asi, guarda el carrito en la bd
            //auth() es el idUsuario autehnticado
            Cart::store(auth()->id());
        }

        //dd($rowId);
        //busco el objeto en la bd con $rowId
        $item = Cart::get($rowId);
        //dd($item);
        //actualizo  el registro en la bd, utilizando el mensaje update() sobre la clase Cart
        //Cart::update($IDRegistro, $item->qty + 1);
        Cart::update($rowId, $item->qty + 1);
        // emito un evento para el mensaje cartUpdated, que indica la cantidad de productos en el carrito
        $this->dispatch('cartUpdated', Cart::count());
        // libera recurso, por lo tanto  desocupado, y cualquiera puede realizar esta accion
        $this->updatingCart = false;


    }

    public function decrease(string $rowId)
    {

        if ($this->updatingCart) {
            //esta ocupado, no puede actualizar, se va del metodo increase() por el return
            return;

        }
        // ocupa recurso, por lo tanto, nadie mas puede realizar esta accion hasta que termine ( pase a false)
        $this->updatingCart = true;
        //declaro la instancia utilizar
        Cart::instance('shopping');

        if (auth()->check()) {
            // el metodo check() verifica si  la instancia de ese usuario esta autenticado, si es asi, guarda el carrito en la bd
            //auth() es el idUsuario autehnticado
            Cart::store(auth()->id());

        }


        //dd($rowId);
        //busco el objeto en la bd con $rowId
        $item = Cart::get($rowId);
        if ($item->qty > 1) {
            //eliminar en menos -1
            Cart::update($rowId, $item->qty - 1);
        } else {
            // borro la instancia del carrito de compra
            Cart::remove($rowId);
        }
        //dd($item);
        //actualizo  el registro en la bd, utilizando el mensaje update() sobre la clase Cart
        //Cart::update($IDRegistro, $item->qty - 1);


        // emito un evento para el mensaje cartUpdated, que indica la cantidad de productos en el carrito
        $this->dispatch('cartUpdated', Cart::count());

        // libera recurso, por lo tanto  desocupado, y cualquiera puede realizar esta accion
        $this->updatingCart = false;


    }

    public function remove(string $rowId)
    {
        if ($this->updatingCart) {
            //esta ocupado, no puede actualizar, se va del metodo increase() por el return
            return;

        }
        // ocupa recurso, por lo tanto  ocupado, y nadie mas puede realizar esta accion hasta que termine
        $this->updatingCart = true;
        Cart::instance('shopping');
        if (auth()->check()) {
            // el metodo check() verifica si  la instancia de ese usuario esta autenticado, si es asi, guarda el carrito en la bd
            //unParametro es el idUsuario autehnticad
            Cart::store(auth()->id());

        }
        //declaro la instancia utilizar

        Cart::remove($rowId);


        // emito un evento para el mensaje cartUpdated, que indica la cantidad de productos en el carrito
        $this->dispatch('cartUpdated', Cart::count());

        // libera recurso, por lo tanto  desocupado, y cualquiera puede realizar esta accion
        $this->updatingCart = false;


    }


    public function destroy()
    {
        if ($this->updatingCart) {
            //esta ocupado, no puede actualizar, se va del metodo increase() por el return
            return;

        }

        // ocupa recurso, por lo tanto, nadie mas puede realizar esta accion hasta que termine ( pase a false)
        $this->updatingCart = true;
        //declaro la instancia utilizar
        Cart::instance('shopping');
        Cart::destroy();
        // emito un evento para el mensaje cartUpdated, que indica la cantidad de productos en el carrito
        $this->dispatch('cartUpdated', Cart::count());

        // libera recurso, por lo tanto  desocupado, y cualquiera puede realizar esta accion
        $this->updatingCart = false;


    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
