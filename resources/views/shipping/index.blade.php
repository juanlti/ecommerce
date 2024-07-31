<x-app-layout>
    {{-- PLANTILLA PRINCIPAL <x-app-layout> --}}
    <x-container class="mt-12 px-4">
        {{-- CONTENIDO PRINCIPAL --}}
        <div class="grid grid-cols-3 gap-6">
            {{-- el grid principal tiene 3 columnas --}}
            <div class="col-span-2">
                {{-- este div, ocupa 2 columnas  --}}
                {{-- llamo al componente de livewire shipping-addresses --}}
                @livewire('shipping-addresses')

            </div>

            <div class="col-span-1">
                {{-- ocupa solo 1 columna, resumen carrito de compra--}}
                <div class="bg-white rounded-lg shadow overflow-hidden mb-4">
                    {{-- shadow sombreado de los elementos--}}
                    {{-- overflow-hidden si un elemento sale de su padre, esto sobrante de oculta --}}
                    <div class="bg-purple-600 text-white p-4 flex justify-between items-center">
                        <p class="font-semibold">
                            {{-- codigo de php --}}
                            {{--  especifo la instancia de la coleccion por tanto no hace falta hacerlo mas adelante--}}

                            Resumen de compra ({{Cart::instance('shopping')->count()}})
                            {{--Cart::instance('shopping')->count() cuenta los productos en el carrito de compras --}}


                        </p>
                        <a href="{{route('cart.index')}}">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>

                    </div>
                    <div class="p-4 text-gray-600">
                        {{-- todos los elementos de text gris tonalidad 600 --}}
                        <ul>
                            @forelse(Cart::content() as $product)
                                {{-- recorro los $product del carrito de compras  de la clase Product--}}
                                {{-- altura de 3 rems --}}
                                <li class="flex items-center space-x-4 space-y-2">
                                    <figure class="shrink-0">
                                        {{-- evita que las imagenes se compriman o cambien de tamanio--}}
                                        <img class="h-12 aspect-square" src="{{$product->options->image}}" alt="">

                                    </figure>
                                    <div class="flex-1">
                                        {{--  truncate evito un desbordamiento del elemento hijo y reemplazando por puntos --}}
                                        <p class="text-sm">{{$product->name}}</p>
                                        <p>${{$product->price}}</p>
                                    </div>
                                    <div class="shrink-0">
                                        <p>{{$product->qty}}</p>

                                    </div>
                                </li>


                                @endforeach
                        </ul>
                        <hr class="my-4">
                        <div class="flex justify-between">
                            <p class="text-lg">Total</p>
                            <p>${{Cart::subtotal()}}</p>
                        </div>

                    </div>

                </div>

                <a href="" class="btn btn-purple block w-full text-center">

                    Siguiente

                </a>


            </div>

        </div>

    </x-container>
    {{-- llamo a la vista del componente del livewire --}}

</x-app-layout>
