<div>
    <header class="bg-purple-600">
        <x-container class="px-4 py-4">
            {{-- x-container se inicializa con una separacion de 4 pixles (px-4) --}}
            <div class="flex justify-between items-center space-x-8">
                {{-- items-center, centro todos los hijos  --}}
                {{-- INICIO la clase flex, permite que sus hijos se agreguen de manera horizontal --}}
                <button class="text-xl md:text-3xl">
                    <i class="fas fa-bars text-white">

                    </i>

                </button>
                {{-- elem 1 --}}
                <h1 class="text-white">
                    <a href="/" class="inline-flex  flex-col items-end">
                        {{-- inline-flex ocupa el ancho disponible por linea, permitiendo una alineacion entre los elementos --}}
                        {{-- flex flex-col  se utiliza para alinear los elementos de manera vertical --}}
                        {{-- href="/"  redirecciona a la pagina principal --}}
                        {{-- class="text-white
                    {{--aca va el logo, aumento el tamanio de la letra text-3x --}}
                        {{-- leading-6, hace una separacion entre de manera vertical ( de manera sutil)  --}}
                        {{--   cuando la pantalla sea mayor o igual a mediana,  md:leading-6 --}}
                        <span class="text-xl md:text-3xl leading-4 md:leading-6 front-semibold"> Ecommerce </span>
                        <span class="text-xs">Tienda online</span>
                    </a>
                </h1>
                {{-- elementos horizontales usando la clase flex--}}
                {{-- flex-1 ocupa ancho disponible --}}

                {{-- elem 1 --}}
                <div class="flex-1 hidden md:block">
                    {{-- hidden md:block, se oculta cuando la pantalla sea igual o menor a mediana md --}}
                    <x-input class="w-full" placeholder="Buscar por producto, tienda o marca">


                    </x-input>


                </div>
                <div class="flex items-center space-x-4 md:space-x-8">
                    {{-- elem 3 --}}
                    <button class="text-xl md:text-3xl">
                        <i class="fas fa-user text-white">

                        </i>
                    </button>

                    <button class="text-xl md:text-3xl">
                        <i class="fas fa-shopping-cart text-white"></i>

                    </button>

                    {{-- FIN bottones --}}
                </div>
                {{-- falta cierre div --}}
            </div>

            {{-- FIN de class=flex --}}
            <div class="mt-4 md:hidden">

                <x-input class="w-full" placeholder="Buscar por producto, tienda o marca">


                </x-input>


            </div>


        </x-container>


    </header>

    <div class="fixed top-0 left-0 inset-0 bg-black bg-opacity-25 z-10">
        {{-- fixed quito al elemento de su padre, sin restricciones de posicionamiento --}}
        {{-- top-0 arriba y left-0 izquierda => extremo superior izquierdo --}}
        {{-- inset-0, ocupar todo el lugar disponible  --}}
        {{-- z-10, efecto de ver el elemento mas cerca o mas lejos, utilizando un orden de apilamiento --}}
        {{-- z-Mayor => cerca del usuario, z-Menor => mas lejos del usuario --}}
        <div class="fixed top-0 left-0 z-20">

            <div class="flex">
                {{-- primer Div --}}
                <div class="w-screen md:w-80 h-screen bg-white">
                    {{-- pantalla chica hasta mediana, utiliza  w-screen  --}}
                    {{-- despues de pantalla mediana hasta grande,  utiliza md:w-80 --}}
                    <div class="bg-purple-600 px-4 py-3 text-white font-semibold">

                        <div class="flex justify-between items-center">
                            <span class="text-lg"> Hola </span>


                            <button>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>


                    </div>
                    <div class="h-[calc(100vh-52px)] overflow-auto">
                        {{-- calculo  la altura maxima restando el  titulo (de 52 px) [calc(100vh-52px)]--}}
                        {{-- overflow-auto, si el contenido es mayor a la altura, se agrega una barra de desplazamiento--}}
                        {{-- muestro todas las familias --}}
                        <ul>
                            @foreach($families as $family)
                                <li>
                                    <a href="{{route('admin.families.index')}}" class="flex justify-between items-center px-4 py-4 hover:bg-gray-100 hover:bg-purple-200">
                                        {{$family->name}}

                                        <i class="fa-solid fa-angle-right"> </i>
                                    </a>
                                </li>



                            @endforeach
                        </ul>



                    </div>


                </div>


                <div class="w-80 xl:w-[57rem] pt-[52px] hidden md:block">
                    {{-- segundo  Div --}}
                    {{-- comienza despues del padding => pt-[52px] d--}}
                    {{-- "inicia con w-80  pero si la pantalla crece, pasa a  xl:w-[57rem]--}}

                    <div class="h-[calc(100vh-52px)] overflow-auto bg-white">
                        {{-- altura de la pantalla  menos la parte superior del desplazamiento  [calc(100vh-52px)] --}}
                        {{-- muestro el objeto families --}}
                        {{$family_id}}
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>