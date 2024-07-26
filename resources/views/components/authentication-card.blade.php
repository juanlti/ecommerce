{{-- parametros al componente authentication-card --}}
@props(['width' => 'sm:max-w-md'])
{{-- si el parametro width es nulo, entonces toma el valor de sm:max-w-md, caso contrario, toma el valor por parametro --}}
{{-- estructura del componente --}}
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full {{$width}} mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
