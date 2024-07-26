<x-app-layout>
    {{-- PLANTILLA PRINCIPAL <x-app-layout> --}}
    <x-container class="mt-12 px-4">
        {{-- CONTENIDO PRINCIPAL --}}
        <div class="grid grid-cols-3 gap-6">
            {{-- el grid principal tiene 3 columnas --}}
            <div class="col-span-2">
                {{-- este div, ocupa 2 columnas  --}}
                {{-- llamo al componente de livewire shipping-addresses --}}
                @livewire('shipping-addresses')

            </div>

            <div class="col-span-1">
                {{-- ocupa solo 1 columna --}}

            </div>

        </div>

    </x-container>
    {{-- llamo a la vista del componente del livewire --}}

</x-app-layout>
