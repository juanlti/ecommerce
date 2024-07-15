<div class="bg-white pb-24 pt-6">
    {{-- Nothing in the world is as soft and yielding as water. --}}


    <x-container class="md:flex px-4">
        {{--  para que sea responsive necesito que mi pantalla utilize el flex a partir de una pantalla mid md:flex --}}
        @if(count($options))
            {{-- aside contiene las opciones y features de los productos, en el caso que los productos, no tengan, este espacio, se oculta --}}

            <aside class="md:w-52 md:flex-shrink-0 md:mr-8 mb-8 md:mb-0">
                {{-- a partir de una pantalla mediana o mas grande, tiene  md:flex-shrink-0 md:mr-8 --}}
                {{-- la clase padre flex, contiene varios hijos, y uno de estos, ocupa mas espeacio que el resto, la clase padre flex, automaticamente achica al hijo  mas chico para dar especio al otro --}}
                {{-- con la clase flex-shrink-0, declaro que este hijo no puede ser reducido por la clase padre --}}
                {{-- mr-8 separacion entre y el siguiente componente --}}
                <ul class="space-y-4">
                    {{-- separacion entre li de manera vertical --}}
                    @foreach($options as $option)
                        {{--  Paso n1  para mostrar o ocultar una informacion, utilizo alpine, x-data en li --}}
                        <li x-data="{
                    open: false

                    }">
                            <button
                                class="px-4 py-2 bg-gray-200 w-full text-left text-gray-700 flex justify-between items-center"
                                x-on:click="open=!open">
                                {{--Paso n3 para agregarle dinamismo utilizo  x-on:click="variableCompartida, modificando su valor por cada click --}}
                                {{-- text-left para posicionar el texto a la izquierda --}}
                                {{$option['name']}}

                                {{-- para obtener un cambio de icono de manera dinamica, utilizo  paso n4 x-bind:class --}}
                                <i class="fa-solid fa-angle-down" x-bind:class="{
                            'fa-angle-down': open,
                             'fa-angle-up': !open,
                            }"></i>
                            </button>
                            {{-- Paso n2 relaciono el componente a ocultar/mostrar,  utilizando x-show y la variable compartida de "open"  --}}
                            <ul class="mt-2 space-y-2" x-show="open">
                                @foreach($option['features'] as $feature)
                                    <li>
                                        <label class="inline-flex items-center">
                                            {{--  inline-flex mantiene el mismo reglon, permite utilizar las propiedades de flex --}}
                                            <x-checkbox class="mr-2" value="{{$feature['id']}}"
                                                        wire:model.live="selected_features">
                                                {{-- sincronizar  el valor de x-checkbox con una variable de la clase, selected_features, utilizo la propiedad de wire:model.live="unaVariableDeClase"  --}}

                                            </x-checkbox>
                                            {{$feature['description']}}
                                        </label>
                                    </li>
                                @endforeach

                            </ul>


                        </li>

                    @endforeach
                </ul>

            </aside>
        @endif


        <div class="md:flex-1">
           {{--  {{$orderBy}} --}}
            <div class="mb-4">
                <div class="flex items-center">
                <span class="mr-2">
                    Ordenar por:
                        </span>
                    <x-select wire:model.live=orderBy>
                        {{-- sincronizo la variable $orderBy del componente con el elemento x-select del usuario, entonces orderBy va a tomar en tiempo real las 3 posibles opciones: 1, 2 , 3 --}}

                        <option value="1">Relevancia</option>
                        <option value="2">Precio: Mayor a menor</option>
                        <option value="3">Precio: Menor a mayor</option>
                    </x-select>


                </div>

                <div class="my-4"/>
                {{-- my-4 espacio y con linea --}}
                {{-- ocupa todo el espacio  allProducts--}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    {{--             <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"> --}}
                    {{-- muestro los elementos en grilla.  --}}
                    {{-- PANTALLA CHICA => UNA SOLA COLUMNA: grid-cols-1 --}}
                    {{-- PANTALLA SMALL => DOS COLUMNAS:  sm:grid-cols-2 --}}
                    {{-- PANTALLA MEDIANA => TRES COLUMNAS: md:grid-cols-3  --}}
                    {{-- PANTALLA GRANDE => 4  COLUMNAS: lg:grid-cols-4 --}}
                    {{-- y por cada columna una separacion de gap-6--}}
                    @foreach($allProducts as $product)
                        <article class="bg-white shadow rounded overflow-hidden">

                            <img src="{{$product->image}}" alt="" class="w-full h-48 object-cover object-center">

                            <div class="p-4">
                                <h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px] mb-2">
                                    {{-- para que el precio de cada tarjeta se encuentre alineaado con el resto, sin importar el tamanio del nombre, defino una altura minima de 56px
                                    despuee, aparece el precio --}}
                                    {{-- line-clamp-2 indica la cantidad maximas de lineas para mostrar un texto--}}
                                    {{$product->name}}
                                </h1>

                                <p class="text-gray-600 mb-4">
                                    ${{$product->price}}
                                </p>


                                <a href="" class="btn btn-purple block w-full text-center">
                                    {{-- las referencias no ocupan el ancho disponible, para obtener ese resultado=>  block w-full --}}

                                    Ver mas
                                </a>


                            </div>

                        </article>
                        {{--
                            @isset($product)
                            @dump($product->toArray())
                            @dump($product->options)
                            @endisset
                           --}}

                    @endforeach

                </div>
                <div class="mt-8">
                    {{-- indice de paginacion --}}
                    {{$allProducts->links()}}


                </div>

            </div>


    </x-container>

    {{--  para mostrar el contenido de una variable de php, utilizo la funcion var_dump --}}

</div>
