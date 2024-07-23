<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
        {{-- RESPONSIVO: PANTALLA PEQUENIA, UNA SOLA COLUMNA => grid-cols-1
         PERO PANTALLA MEDIANA O GRANDE, 7 COLUMNAS => lg:grid-cols-7 --}}


        {{-- crreo una grilla de 7 columnas con una separacion de 6 rm entre ellas--}}
        {{-- pantalla mediana o grande, 5 columnas con => lg:col-span-5 --}}
        <div class="lg:col-span-5">
            {{-- la primera columna ocupa 5 de 7 --}}
            <div class="flex justify-between mb-2">
                {{--  flex  posiciona a los hermanos de manera horizontal, y con justify-between los separa en partes iguales --}}
                <h1 class="text-lg">
                    {{-- accedo a la clase  --}}
                    Carrito de compras {{Cart::count()}} Productos
                </h1>
                <button
                    class="font-semibold text-gray-600 hover:text-blue-500 underline hover:no-underline" wire:click="destroy()">Limpiar
                    carro
                </button>
                {{-- para quitar el subrrayado y cambiar de color, cuando el mouse este sobre el botton, utilizo:  hover:no-underline  y hover:text-blue-600 --}}

            </div>
            <div class="card">
                {{-- items carrito de compras --}}
                <ul class="space-y-4">
                    {{-- espacio de manera vertical  entre los elementos --}}

                    @forelse(Cart::content() as $item)
                        {{-- recorro los items del carrito --}}
                        <li class="lg:flex">
                            {{-- posicionamiento de manera horizontal para los hijos si la pantalla es mediana/grande, caso contrario pantalla chica, una sola columna --}}
                            {{-- space-x-4 => es una separacion de 1 rem y este se aplica en el padre para afectar todos los hijos menos al ultimo --}}
                            <img class="w-full lg:w-36 aspect-[16/9] object-cover object-center mr-2"
                                 src="{{$item->options->image}}" alt="[]">
                            {{-- todo el anchi disponible excepto cuando la pantalla es lg o mas, usa el ancho de w-36 --}}
                            {{-- radio --> aspect-[16/9]  --}}
                            {{-- mr-2 se aplica directamente al alemento afectando al siguiente, obteniendo una separacion de 1 rem, similar al space-x --}}
                            <div class="w-80">
                                <p class="text-sm">
                                    {{-- para obtener  una letra chica text-sm --}}
                                    <a href="{{route('products.show',['product'=>$item->id])}}">{{$item->name}}</a>

                                </p>

                                <button
                                    class="bg-red-100 hover:bg-red-200 text-red-800 text-xs font-semibold rounded px-2.5 py-0.5" wire:click="remove('{{$item->rowId}}')"
                                    wire:loading.attr="disabled">
                                    {{-- con el metodo   wire:loading.attr="disabled" detecta si alguna variable del componente esta en uso, el botton se bloquea hasta que la variabla alla terminado--}}
                                    {{-- --bg-red-100 => color de fondo --}}
                                    {{-- hover:bg-red-200 => color de fondo cuando el mouse este sobre el boton --}}
                                    {{-- text-red-800 => color de la letra --}}
                                    {{-- text-sm => tamaño de la letra --}}
                                    {{-- font-semibold => negrita --}}
                                    <i class="fa-solid fa-xmark"></i>
                                    Quitar
                                </button>
                            </div>
                            <p>
                                ${{$item->price}}
                            </p>

                            <div class="ml-auto space-x-3">
                                {{--  botones  para  aumentar, disminuir o eliminar un producto--}}
                                {{-- para posicionar un elemento a la derecha utilizo ml-auto --}}

                                <button class="btn btn-gray" wire:click="decrease('{{$item->rowId}}')"
                                        wire:loading.attr="disabled">
                                    {{-- para bloquear un boton con alpine, utilizo la funcion de x-bind-disable="aca debe ser true la condicion para bloquearse "--}}
                                    -
                                </button>

                                <span class="inline-block w-2 text-center">
                            {{-- span por defecto tiene el display inline es decir un ancho que varia segun su contendio, para cambiarlo --}}
                                    {{-- le agrego la clase inline-block otorgando un ancho fijo con w-2 text-center --}}
                                    {{$item->qty}}
                            </span>
                                <button class="btn btn-gray" wire:click="increase('{{$item->rowId}}')"
                                        wire:loading.attr="disabled">
                                    {{-- para pasar una cadena como parametro  en el mensaje increase('{{unaCadena}}')--}}

                                    +

                                </button>


                            </div>

                        </li>

                    @empty
                        {{-- collecion de carritos vacia --}}
                        <p class="text-center">
                            No hay productos en el carrito

                        </p>

                    @endforelse


                </ul>

            </div>

        </div>
        <div class="lg:col-span-2">
            {{-- la segunda columna ocupa 2 de 7 --}}
            {{-- pantalla mediana o grande, 2 columnas con => lg:col-span-2 --}}
            <div class="card">
                <div class="flex justify-between font-semibold mb-2">
                    <p>
                        Total:
                    </p>
                    <p>
                        ${{Cart::subtotal()}}
                    </p>

                </div>
                <a href="#" class="btn btn-purple block w-full text-center">
                    {{-- ocupar todo el ancho disponible => blcok w-full --}}
                    Continuar Compra</a>

            </div>

        </div>


    </div>
</div>
