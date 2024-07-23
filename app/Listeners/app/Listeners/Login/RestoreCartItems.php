<?php

namespace App\Listeners\app\Listeners\Login;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Gloudemans\Shoppingcart\Facades\Cart;
class RestoreCartItems
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        //Login tiene la instancia del usuario
        //$event->user->id;
        //recuperaro la instancia shopping  del carrito de compras del usuario autenticado
        Cart::instance('shopping')->restore($event->user->id);
    }
}
