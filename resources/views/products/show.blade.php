<x-app-layout>
    {{-- esta vista se extiende la platantilla views/layouts/app.blade.php --}}

    <x-container class="px-4 my-4">


        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{route('welcome.index')}}"
                       class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-purple-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Home

                    </a>
                </li>

                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{route('famiy.show',$product->subcategory->category->family)}}"
                           class="ms-1 text-sm font-medium text-gray-700 hover:text-purple-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            {{$product->subcategory->category->family->name}}</a>

                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{route('categories.show',$product->subcategory->category)}}"
                           class="ms-1 text-sm font-medium text-gray-700 hover:text-purple-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">

                            {{$product->subcategory->category->name}}</a>

                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{route('categories.show',$product->subcategory->category)}}"
                           class="ms-1 text-sm font-medium text-gray-700 hover:text-purple-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">

                            {{$product->subcategory->name}}</a>

                    </div>
                </li>


            </ol>
        </nav>


    </x-container>
    {{--  informacion de producto selecionado por el boton "ver mas"--}}
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
                    <div class="flex items-center space-x-6 mb-6">
                        <button class="btn btn-gray">
                            -
                        </button>

                        <span class="mr-4 ml-4">
                                1
                            </span>
                        <button class="btn btn-gray">
                            +

                        </button>

                    </div>

                    <button class="btn btn-purple w-full mb-6">
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
</x-app-layout>
