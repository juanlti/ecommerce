<div>
    {{-- Do your work, then step back.    <h1>Estoy es el componente de add new feature {{$valor}}</h1> --}}

    <form class="flex space-x-4" wire:submit="addFeature">
        {{-- flex => ocupa todo el ancho --}}
        {{-- space-x-4 => separacion entre los elementos --}}

        <div class="flex-1">
                {{--  ocupa todo el posible, para mostrar el tipo de opcion, si es Texto o Color--}}
            <x-label class="mb-1">
                Valor
            </x-label>
            {{--  @dump($option)  --}}
            @switch($option->type)



                @case(1)
                    {{-- si case es 1, se muestra el input de texto- --}}
                    <x-input class="w-full" wire:model="newFeature.value"
                             placeholder="Tamanio: ejemplo 3LLL"/>
                    @break
                @case(2)
                    {{-- obtuve el 42 pixeles de la inspeccion, agrego esa misma configuracion con h-[42px]--}}
                    {{-- flex items-center, centro los objetos y con padding p-3 una separacion con la caja y el objeto --}}
                    <div
                        class="border border-gray-300 h-[42px] rounded-md flex items-center p-3 flex justify-between">
                        {{-- si case es 2, se muestra el input de color- --}}
                        {{$newFeature['value'] ?: 'Selecione un color'}}
                        {{-- ?: --}}
                        {{-- objeto ?(verifica que la variable este definida) :(verifica que tenga valor no nulo) 'una sentencia '  --}}
                        <x-input type="color"
                                 wire:model.live="newFeature.value"
                                 placeholder="Color: lila3000"/>


                    </div>
                    @break

                @default
            @endswitch


        </div>

        <div class="flex-1">
            {{--  ocupa todo el posible, para mostrar una descripcion --}}
            <x-label class="mb-1">
                Descripcion
            </x-label>

            <x-input class="w-full" wire:model="newFeature.description"
                     placeholder="Tamanio: ejemplo 3LLL"/>



        </div>
        <div class="pt-7">
            <x-button>Agregar</x-button>
        </div>
    </form>

</div>
