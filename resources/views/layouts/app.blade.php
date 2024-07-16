<!DOCTYPE html>
{{-- PLANTILLA DE USO GENERAL, REUTILIZABLE EN TODOS LOS DOMINIONS MENOS EN LOS DE ADMIN'S --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    @stack('css')
    {{--con @stack('css'), declaro que a futuro, las paginas que se extiendan de app.blade van a tener css  --}}
    <!-- Fonts Awesome -->
    <script src="https://kit.fontawesome.com/520678b794.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

</head>
<body class="font-sans antialiased">
<x-banner/>

<div class="min-h-screen bg-gray-100">
    {{--  @livewire('navigation-menu') --}}
    {{-- utilizo el componente navigation propio--}}
    @livewire('navigation')
    <!-- Page Heading -->


    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <div class="mt-16">
        {{-- le agrego una separacion de mt-16 al footer en la parte superior, para que haya una distancia entre main y footer--}}
        {{-- incluyo el footer.blade.php --}}
        @include('layouts.partials.app.footer')
    </div>
</div>

@stack('modals')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@livewireScripts
@stack('js')
@if (session('swal'))

    <script>
        // SESSION O USO DE SWAL
        // Preparar la configuración de Swal con los colores personalizados
        let swalConfig = {!! json_encode(session('swal')) !!};
        swalConfig.background = '#f9f9f9'; // Cambia el color de fondo
        swalConfig.confirmButtonColor = '#3085d6'; // Cambia el color del botón de confirmación

        // json_encode => RECIBE CODIGO DE PHP EN JS
        Swal.fire(swalConfig);
    </script>
@endif

<script>
    // session de tipo livewire, este se activa cuando escuche un evento de tipo livewire
    //data es un parametro
    Livewire.on('swal', data => {
        Swal.fire(data[0]);

    });


</script>
</body>
</html>
