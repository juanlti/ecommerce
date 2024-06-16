<div>
    {{-- Comentario: Mensaje motivacional --}}
    <section class="rounded-lg bg-white shadow-lg border border-gray-100">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                {{-- Comentario: Los elementos estarán en extremos opuestos --}}
                <h1 class="text-lg font-semibold text-gray-700">Opciones</h1>
                {{-- Comentario: Botón para generar una acción con click --}}
                {{-- El método $set cambia el valor de una variable --}}
                {{-- openModal=>true (abierto) openModal=>false (cerrado) --}}
                <x-button wire:click="$set('openModal', true)">Nuevo</x-button>
            </div>
        </header>
        <div class="p-6">
            <x-dialog-modal wire:model="openModal">
                {{-- Defino los slots requeridos para el componente x-dialog-modal --}}
                <x-slot name="title">Agregar nueva opción</x-slot>

                <x-slot name="content">
                    {{-- Defino el contenido del modal --}}
                    {{-- Defino los mensajes de validaciones --}}
                    <x-validation-errors class="mb-4"/>
                    <div class="mb-4">
                        <x-label class="mb-1">Opción</x-label>
                        <x-select class="w-full" wire:model.live="variantsSelect.option_id">
                            {{--PARTE 1) wire.live="variantsSelect.option_id almacena el valor (option_id) selecionado por el usuario --}}


                            <option value="" disabled selected>Seleciona una opcion</option>
                            @foreach($options as $option)
                                {{-- Muestra de una lista desplegable (down drop list)--}}
                                <option value="{{$option->id}}">{{ $option->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="flex items-center mb-6">
                        {{-- Centra los items--}}
                        <hr class="flex-1">
                        {{-- crea una linea --}}

                        <span class="mx-4">Valores</span>
                        <hr class="flex-1">
                        {{-- crea la segunda linea --}}
                    </div>
                    {{-- la etiqueta ul se encarga de mostrar todos los 'valores', al ejecutar el "Valor +" entonces se recarga y vuelve a interacion
                     mostrando los nateriores + el ultimo --}}
                    <ul class="mb-4 space-y-4">
                        {{-- con space-y-4 genera un espacio vertical por cada elemento de lista de UL --}}
                        {{-- aca van todos los features de la variable computada--}}
                        @foreach($variantsSelect['features'] as $index=> $feature)
                            {{-- (contiene la posicion) $index => $feature (contiene el valor en esa posicion) --}}
                            <li wire:key="variantsSelect-feature-.{{$index}}"
                                class="border border-gray-200 rounded-lg p-6 relative">

                                <div class="absolute -top-3 bg-white px-4">
                                    <button wire:click="removeFeature({{$index}})">
                                        <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>

                                    </button>

                                </div>

                                <div>
                                    <x-label class="mb-1">Valores</x-label>
                                    {{--Para enviar la respuesta del usuario de la lista drop down list al componente ProductVariants
                                    debbemos enlazar la respuesta, se la siguiente manera.
                                    wire:model="$variantsSelect.features.{{$index}}.id
                                    Almena el valor de la lista desplegable a la variable $variantsSelect.features.{{$index}}.id
                                    --}}

                                    <x-select class="w-full" wire:model="variantsSelect.features.{{$index}}.id"
                                    wire:change="feature_change({{$index}})">
                                        <option value="">
                                            Selecione un valor
                                        </option>
                                        @foreach($this->features as $featurBD)

                                            <option value="{{ $featurBD->id }}">
                                                {{$featurBD->description}}

                                            </option>
                                        @endforeach


                                    </x-select>

                                </div>


                            </li>
                        @endforeach


                    </ul>
                    <div class="flex justify-end">

                        <x-button wire:click="addFeature">
                            Valor +
                        </x-button>

                    </div>


                </x-slot>

                <x-slot name="footer">
                   <div>

                        <x-danger-button wire:click="$set('openModal',false)">
                            Cancelar
                        </x-danger-button>
                       <x-button wire:click="saveFeature" class="ml-2">
                           Guardar
                       </x-button>
                   </div>
                </x-slot>
            </x-dialog-modal>
        </div>

    </section>
</div>
