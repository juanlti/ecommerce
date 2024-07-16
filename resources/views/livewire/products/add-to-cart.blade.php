<div>


    <x-container>
        <div class="card">
            <div class="grid md:grid-cols-2 gap-6">
                {{-- separacion entre columnas de ram de 6 con gap-6--}}

                <div class="col-span-1">
                    {{-- columna n1 (lado izquierdo: foto + descripcion --}}

                    <figure class="mb-2">
                        {{-- muestro la imagen utilizando el accesor --}}
                        <img src="{{$product->image}}" class="aspect-[16/9] w-full object-cover object-center" alt="">
                        <div class="text-sm">
                            {{-- muestro la descripcion del producto --}}
                            {{$product->description}}
                        </div>
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

                    <button class="btn btn-purple w-full mb-6" wire:click="add_to_cart" wire:loading.attr="disabled">
                        {{-- ejecutar un metodo de livewire: wire:click y nombre del metodo add_to_cart --}}
                        {{-- para bloquear o desactivar un botton, en funcion de livewire, utilizo el metodo: wire:loading.attr="disabled"
                            aclaracion: cuando se este moficiando al menos una propiedad ( o atributom, sin especificar cual),del componente de livewire, este botton, queda desactivado hasta que  el componente haya terminado con su actualizacion
                            attr => atrbuto que se esta modificando
                        --}}
                        Agregar al carrito
                    </button>
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
