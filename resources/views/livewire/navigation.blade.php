<div x-data="{ open:false,}">
    {{-- utilizo alpine, para abrir o cerrar el menu, si open:false => menu escondido, caso contrario open:true => menu visible --}}
    <header class="bg-purple-600">
        <x-container class="px-4 py-4">
            {{-- x-container se inicializa con una separacion de 4 pixles (px-4) --}}
            <div class="flex justify-between items-center space-x-8">
                {{-- items-center, centro todos los hijos  --}}
                {{-- INICIO la clase flex, permite que sus hijos se agreguen de manera horizontal --}}
                <button class="text-xl md:text-3xl" x-on:click="open=true">
                    {{-- utilizo el button para llamar al metodo x-data y cambiar true/false por click --}}
                    <i class="fas fa-bars text-white">

                    </i>

                </button>
                {{-- elem 1  logo--}}
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
                   {{-- x-input oninput=search(this.value) es un mensaje al metodo N2--}}
                    <x-input oninput="search(this.value)" class="w-full"
                             placeholder="Buscar por producto, tienda o marca">


                    </x-input>


                </div>
                <div class="flex items-center space-x-4 md:space-x-8">
                    {{-- elem 3 --}}
                    {{--  agrego un componente  de lista desplegable ( list dropdown ) en el icon user--}}
                    <x-dropdown>
                        {{-- requiere dos argumentos x-slot x2 --}}
                        <x-slot name="trigger">
                            {{-- trigger, disparador del dropwon --}}
                            {{-- button icono del usuario--}}
                            @auth
                                {{-- si el usuario esta logeado, muestro la imagen del usuario --}}
                                {{-- Auth::user()->profile_photo_url, obtengo la imagen del usuario --}}
                                {{-- Auth::user()->name, obtengo el nombre del usuario --}}
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                         src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                                </button>

                            @else
                                {{-- si el usuario no esta logeado, muestro el icono del usuario --}}
                                <button class="text-xl md:text-3xl">
                                    <i class="fas fa-user text-white">

                                    </i>
                                </button>
                            @endauth


                        </x-slot>
                        <x-slot name="content">
                            {{-- contendido del dropdown --}}
                            @guest
                                {{--  Informacion publica usuario no logeado --}}

                                {{-- div inicio --}}
                                <div class="px-4 py-2">
                                    <div class="flex justify-center">
                                        <a href="{{route('login')}}" class="btn btn-purple"> Iniciar Session </a>


                                    </div>
                                    <p class="text-sm text-center mt-4">
                                        ¿No tienes cuenta? <a href="{{route('register')}}"
                                                              class="text-purple-600 font-semibold hover:underline">
                                            Registrate </a>
                                    </p>

                                </div>
                                {{-- div fin --}}
                            @else
                                {{--  Informacion privada usuario logeado --}}
                                <x-dropdown-link href="{{route('profile.show')}}"> Mi perfil</x-dropdown-link>

                                <div class="border-t border-gray-200">

                                    <!-- Formulario para cerrar session Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}"
                                                         @click.prevent="$root.submit()">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>

                                </div>
                            @endguest
                        </x-slot>

                    </x-dropdown>


                    <a href="{{route('cart.index')}}" class="relative">
                        <i class="fas fa-shopping-cart text-white text-xl md:text-3xl"></i>

                        <span id="cart-count" class="absolute -top-2 -end-4 inline-flex w-6 h-6 items-center justify-center bg-red-500 rounded-full text-xs font-bold text-white borded-2 border-white">
                            {{Cart::instance('shopping')->count()}}
                        </span>

                    </a>

                    {{-- FIN bottones --}}
                </div>
                {{-- falta cierre div --}}
            </div>

            {{-- FIN de class=flex --}}
            <div class="mt-4 md:hidden">

                <x-input oninput="search(this.value)" class="w-full" placeholder="Buscar por producto, tienda o marca">


                </x-input>


            </div>


        </x-container>


    </header>

    <div x-show="open" x-on:click="open = false" style="display: none"
         class="fixed top-0 left-0 inset-0 bg-black bg-opacity-25 z-10">
        {{-- fondo negro/gris --}}
        {{-- fixed quito al elemento de su padre, sin restricciones de posicionamiento --}}
        {{-- top-0 arriba y left-0 izquierda => extremo superior izquierdo --}}
        {{-- inset-0, ocupar todo el lugar disponible  --}}
        {{-- z-10, efecto de ver el elemento mas cerca o mas lejos, utilizando un orden de apilamiento --}}
        {{-- z-Mayor => cerca del usuario, z-Menor => mas lejos del usuario --}}
        <div x-show="open" x-on:click.stop style="display: none" class="fixed top-0 left-0 z-20">
            {{-- x-show="open"  es una variable,  cambia por el metodo de x-data. Si x-data es false => el style se mantiene en none, caso contrario si x-data es true => el style en none desaparece, poniendolo visible --}}
            {{-- menu --}}

            <div class="flex">
                {{-- primer Div --}}
                <div class="w-screen md:w-80 h-screen bg-white">
                    {{-- pantalla chica hasta mediana, utiliza  w-screen  --}}
                    {{-- despues de pantalla mediana hasta grande,  utiliza md:w-80 --}}
                    <div class="bg-purple-600 px-4 py-3 text-white font-semibold">

                        <div class="flex justify-between items-center">
                            <span class="text-lg"> Hola </span>


                            <button x-on:click="open = false">
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
                                {{-- para obtener el objeto ( o una propiedad del mismo), cuando el cursor se encuentra posicionado, utilizamos  mouseover--}}
                                {{-- $set('family_id',{{$family}}),  asigno el objeto a la variable family_id --}}
                                {{--$set('family_id',{{$family}}),  setea los valores de manera automatica $('NombreDeLaPropiedad.valor)--}}
                                <li wire:mouseover="$set('family_id',{{$family->id}})">
                                    <a href="{{route('famiy.show',$family)}}"
                                       class="flex justify-between items-center px-4 py-4 hover:bg-gray-100 hover:bg-purple-200">
                                        {{$family->name}}

                                        <i class="fa-solid fa-angle-right"> </i>
                                    </a>
                                </li>

                            @endforeach
                        </ul>


                    </div>


                </div>

                {{--  comienzo del segundo Div ( informacion lateral ) --}}
                <div class="w-80 xl:w-[57rem] pt-[52px] hidden md:block">


                    {{-- segundo  Div --}}
                    {{-- comienza despues del padding => pt-[52px] d--}}
                    {{-- "inicia con w-80  pero si la pantalla crece, pasa a  xl:w-[57rem]--}}


                    <div class="h-[calc(100vh-52px)] overflow-auto bg-white px-6 py-8">
                        <div class="mb-8 flex justify-between items-center">
                            {{-- un border parte inferior de 3 pixles --}}
                            <p class="border-b-[3px] border-lime-400 uppercase text-xl font-semibold pb-1"> {{$this->familyName}}</p>
                            <a href="{{route('famiy.show',$family_id)}}" class="btn btn-purple">Ver todo</a>
                        </div>

                        {{-- altura de la pantalla  menos la parte superior del desplazamiento  [calc(100vh-52px)] --}}
                        {{-- muestro el objeto families --}}
                        {{--  {{$family_id}} --}}
                        {{--  grid de 3 columnas  con separacion de cada columna --}}

                        <ul class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                            {{-- aa--}}

                            @foreach($this->categories as $category)
                                <li>
                                    {{--  estilos para el objeto $category --}}
                                    <a href="{{route('categories.show',$category)}}" class="text-purple-600 font-semibold text-lg">
                                        {{$category->name}}
                                    </a>

                                    <ul class="mt-4 space-y-2">
                                        @foreach($category->subcategory as $subcategory)
                                            {{--  estilos para el objeto $subcategory --}}
                                            <li>
                                                <a href="{{route('subcategories.show',$subcategory)}}"
                                                   class="text-sm text-gray-700 hover:text-purple-600 font-semibold">
                                                    {{$subcategory->name}}
                                                </a>

                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>

        </div>
    </div>

    @push('js')

        <script>
            // comunicacion el backend y el frontend
        Livewire.on('cartUpdated', (count) => {
                //esucha el evento cart-count y recibe por parametro el count, cuando escuche ese evento.
                 // seleciona el id del span, y con el innerText reemplazo el valor por el count
                document.getElementById('cart-count').innerText = count;


        });



            // N2 comunicacion entre la vista navigation.blade.php y el componente de Filtrer.php
            function search(value) {
                // alert(value);
                Livewire.dispatch('search', {
                    search: value
                })
            }
        </script>
    @endpush
</div>
