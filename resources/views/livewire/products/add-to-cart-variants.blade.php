<div>


    <x-container>
        <div class="card">
            <div class="grid md:grid-cols-2 gap-6">
                {{-- separacion entre columnas de ram de 6 con gap-6--}}

                <div class="col-span-1">
                    {{-- columna n1 (lado izquierdo: foto + descripcion --}}

                    <figure>
                        {{-- muestro la imagen utilizando el accesor --}}
                        <img src="{{ optional($this->variant)->image ? $this->variant->image : asset('img/no-image.png') }}"
                             class="aspect-[1/1] w-full object-cover object-center" alt="">
                            {{-- con el  optional() evito  errores de nulos y de variables indefinidas, muestra un assets --}}
                    </figure>

                </div>
                <div class="col-span-1">
                    {{-- columna n2 (lado derecho: nombre producto,calificacion por estrellas, precio, cantidad y etc  --}}
                    <h1 class="text-xl text-gray-600 mb-2">
                        {{$product->name}}

                    </h1>
                    <div class="flex space-x-2 items-center mb-4">
                        {{-- dos elementos de manera horizoan y una seperacion en  ancho con 2--}}
                        <ul class="flex space-x-1 text-sm">
                            {{-- cambiar las dirreciones de posicionamiento de vertical a horizontal, utilizo flex, y una separacio entre estrellas de  1 con space-x-1 y cambio el tamanio de las mismas con text-sm --}}
                            <li>
                                <i class="fa-solid fa-star" style="color: #fbbf24"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star" style="color: #fbbf24"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star" style="color: #fbbf24"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star" style="color: #fbbf24"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star" style="color: #fbbf24"></i>
                            </li>

                        </ul>
                        <p class="text-sm text-gray-700">4.7 (55)</p>
                    </div>

                    <p class="font-semibold text-2xl text-gray-600 mb-4">
                        ${{$product->price}}


                    </p>
                    <div class="flex items-center space-x-6 mb-6" x-data="{
                    qty:@entangle('qty'),
                    }">

                        {{-- UTILIZO ALPINE SIEMPRE Y CUANDO ESTE NO NECESITE UNA COMUNICACION CON LA BD, CASO CONTRARIO UTILIZO LIVEWIRE --}}
                        {{-- Con x-data inicializo alpine --}}
                        {{-- qty:1 es una propidad de alpine y puede ser utilizada dentro del div declarado --}}
                        {{--   ALPINE SIN CONEXION CON LIVEWIRE
                          <div class="flex items-center space-x-6 mb-6" x-data="{
                    qty:0,
                    }"> --}}
                        {{--   ALPINE SIN SINCRONIZACION  CON LIVEWIRE
                 <div class="flex items-center space-x-6 mb-6" x-data="{
           qty:0,
           }"> --}}
                        {{--   ALPINE  SINCRONIZADO CON LIVEWIRE
              <div class="flex items-center space-x-6 mb-6" x-data="{
            qty:@entangle('qty'),
        }"> --}}

                        <button class="btn btn-gray" x-on:click="qty=qty-1" x-bind:disabled="qty<=0">
                            {{-- para bloquear un boton con alpine, utilizo la funcion de x-bind-disable="aca debe ser true la condicion para bloquearse "--}}
                            -
                        </button>

                        <span x-text="qty" class="inline-block w-2 text-center">
                            {{-- span por defecto tiene el display inline es decir un ancho que varia segun su contendio, para cambiarlo --}}
                            {{-- le agrego la clase inline-block otorgando un ancho fijo con w-2 text-center --}}
                            {{-- la etiqueta span hago uso de las propiedades de alpine declarando la clase x-text y la propidad "qty"--}}

                            </span>
                        <button class="btn btn-gray" x-on:click="qty=qty+1">
                            {{-- el botton genera la accion de aumentar la variable declara en x-data con el mensaje x-on:click="qty=qty+1  --}}
                            +

                        </button>
                    </div>

                    <div class="flex flex-wrap mb-4">
                        {{-- flex agrega elementos horizontales--}}
                        {{-- flex-wrap  permite que los elementos hijos se ajusten al ancho del padre, y si no caben en una sola fila, se ajustan a la siguiente fila --}}

                        @foreach($product->options as $option)
                            {{-- obtengo las opciones de de ese producto --}}
                            <div class="mr-4 mb-4">

                                <p class="font-semibold text-lg mb-2">{{$option->name}}</p>

                                <ul class="flex items-center space-x-4">
                                    @foreach($option->pivot->features as $feature)
                                        {{-- accedo a  la tabla pivote (option_product) a la columna $feature--}}
                                        <li>
                                            @switch($option->type)
                                                {{-- verifico todos los tipos de opciones --}}
                                                @case(1)
                                                    <button
                                                        class="w-20 h-8 font-semibold uppercase text-sm rounded-lg {{$selectedFeatures[$option->id]==$feature['id'] ? 'bg-purple-600 text-white' :' border border-gray-200 text-gray-700'}}"
                                                        wire:click="$set('selectedFeatures.{{$option->id}}',{{$feature['id']}})">
                                                        {{-- wire.click y metodo magico $set('indicoLaClaveAmodifcar','nuevoValor') modifico la clave de un arreglo de manera dinamica, obteniendo el id de esa clave, y como segundo parametro el valor, ejemplo: $set('selectedFeatures.{{$option->id}}',{{$feature['id']}}) --}}
                                                        {{$feature['value']}}
                                                    </button>


                                                    @break

                                                @case(2)
                                                    <div
                                                        class="p-0.5 border-2 rounded-lg flex items-center -mt-1.ax5 {{$selectedFeatures[$option->id]==$feature['id']? 'border-purple-600 ':'border-transparent' }}">
                                                        {{-- margin negativo --}}
                                                        <button class="w-20 h-8 roundwdadq-lg border border-gray-200"
                                                                style="background-color:{{$feature['value']}}"
                                                                wire:click="$set('selectedFeatures.{{$option->id}}',{{$feature['id']}})"></button>

                                                    </div>

                                                    @break

                                            @endswitch


                                        </li>

                                    @endforeach
                                </ul>
                            </div>

                        @endforeach
                        {{--  {{var_dump($selectedFeatures)}} --}}
                        {{--    @dump($selectedFeatures) --}}


                    </div>

                    <button class="btn btn-purple w-full mb-6" wire:click="add_to_cart" wire:loading.attr="disabled">
                        {{-- ejecutar un metodo de livewire: wire:click y nombre del metodo add_to_cart --}}
                        {{-- para bloquear o desactivar un botton, en funcion de livewire, utilizo el metodo: wire:loading.attr="disabled"
                            aclaracion: cuando se este moficiando al menos una propiedad ( o atributom, sin especificar cual),del componente de livewire, este botton, queda desactivado hasta que  el componente haya terminado con su actualizacion
                            attr => atrbuto que se esta modificando
                        --}}
                        Agregar al carrito
                    </button>
                    <div class="text-sm mb-4">
                        {{-- muestro la descripcion del producto --}}
                        {{$product->description}}
                    </div>
                    <div class="text-gray-700 flex items-center space-x-4">
                        <i class="fa-solid fa-truck-fast text-2xl">
                        </i>
                        <p>
                            Despacho a domicilio
                        </p>
                    </div>


                </div>


            </div>
        </div>
    </x-container>
</div>
