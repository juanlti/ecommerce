@props(['breadcrumbs'=>[]])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <!-- Fonts Awesome -->
    <script src="https://kit.fontawesome.com/520678b794.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased" x-data="{ sidebarOpen:false}" :class="{'overflow-hidden':sidebarOpen}">
<!-- inicializo Alpine =>  x-data -->
<!-- Configuracion de sidebar ( panel lateral), si esta en false siderbar "oculto" |  si esta en true siderbar "mostrar" -->

<div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 sm:hidden"
     style="display:none"
     x-show="sidebarOpen"
     x-on:click="sidebarOpen=false" x-on:click="bg-indigo-500 opacity-25">

</div>


<!-- PANEL SUPERIOR-->
@include('layouts.partials.admin.navigator')

<!-- PANEL LATERAL-->
@include('layouts.partials.admin.sidebar')


<div class="p-4 sm:ml-64">
    <div class="mt-14">

            <!-- flex justify-between realiza una separacion entre dos objetos -->
            <!-- items-center centra ambos objetos -->
            <div class="flex justify-between items-center">
                @include('layouts.partials.admin.breadcrumb')

                <!--    isset($action) VERIFICA  SI EXISTE ENTONCES LO MUESTRA -->
                @isset($action)
                <div>
                    {{$action}}
                </div>
                    @endisset
            </div>

        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <!-- PANEL LATERAL-->

            <!-- $slot  es una variable que contiene el valor de una pagina en particular. -->
            <!-- la pagina admin.dashboard contiene valores particulares  que se extienden de una estructura (o layaouts) de tipo ADMIN (esta puede ser utilizada por otras paginas)  -->
            <!-- y muentras el contenido.-->
            <!-- ejemplo: el contenido de  dashboard (slot, hola)  se renderiza en la pagina layout -->
            {{$slot}}
        </div>


    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@livewireScripts


<!-- importo los dependencias  de js -->
@stack('js')

@if (session('swal'))
    <script>

            // json_encode => RECIBE CODIGO DE PHP EN JS
        Swal.fire({!! json_encode(session('swal')) !!});

    </script>
    @endif

</body>
</html>
