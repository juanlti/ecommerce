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
            {{-- opciones correspondientes a un producto --}}
            @if($product->options->count()>0)
                {{-- existe al menos una opcion asociada al producto  --}}

                <div class="space-y-6">
                    {{-- $product->options relacion--}}
                    @foreach($product->options as $option)

                        {{-- Comentario: Muestra las opciones de un producto --}}
                        <div wire:key="product-option-{{$option->id}}"
                             class="p-6 rounded-lg border border-gray-200 relative">
                            <div class="absolute -top-3 px-4 bg-white">
                                <button onclick="confirmDeleteOption({{$option->id}})">
                                    <i class="fa-solid fa-trash-can text-red-500 hover:text-red-700"></i>

                                </button>
                                <span class="ml-2">
                                          {{$option->name}}
                            </span>
                            </div>

                            <div class="flex flex-wrap">

                                {{--   <div class="flex flex-wrap"> Me aseguro que las diferentes opciones (talle, color, sexo), se vayan agregando al lado
                                 pero al completar el limite por linea, los siguientes aparezcan a bajo--}}
                                {{--features de cada option--}}

                                @foreach($option->pivot->features as $feature)
                                    {{--$option->pivot => acceso a la tabla pivote , pivot->features=> obtengo el json (todos los features en array) pertenecientes a un producto --}}


                                    @switch($option->type)
                                        @case(1)
                                            {{-- Talla --}}
                                            {{-- si el usuario seleciona la opcion uno (talla), sus correspondencia (Relaciones), van a estar dentro del badge Dark --}}



                                            <span
                                                class="mb-2 bg-gray-100 text-gray-800 text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                           {{$feature['description']}}
                                           <button type="button" class="ml-0.5"
                                                   onclick="confirmDeleteFeature({{$option->id}},{{$feature['id']}})">
                                                <i class="fa-solid fa-xmark hover:text-red-500"></i>
                                           </button>

                                            </span>





                                            @break
                                        @case(2)
                                            {{-- Color --}}
                                            <div class="relative">
                                            <span
                                                class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4"
                                                style="background-color: {{$feature['value']}}">

                                    </span>
                                                <button

                                                    class="absolute z-10 left-3 -top-2 rounded-full bg-red-500 hover:bg-red-600 h-4 w-4 flex justify-center item-center"
                                                    {{-- item-center mantengo la x en el centro del circulo --}}
                                                    onclick=confirmDeleteFeature({{$option->id}},{{$feature['id']}})"
                                                //confirmDeleteFeature({{$option->id}},{{$feature['id']}})
                                                {{-- wire:click="deleteFeature({{$feature->id}})" --}}>
                                                <i class="fa-solid fa-xmark text-white text-xs"></i>

                                                </button>

                                            </div>
                                            @break
                                        @default

                                    @endswitch

                                @endforeach

                            </div>

                        </div>
                    @endforeach

                    @else
                        {{-- No existen opciones asociadas al producto --}}
                        <div
                            class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Info alert!</span> No hay opciones para este producto.
                            </div>
                        </div>

                    @endif


                </div>

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

    @push('js')
        <script>
            function confirmDeleteFeature(option_id, feature_id) {

                //muesto el id del elemento a eliminar -> alert(featureId);
                Swal.fire({
                    title: "Esta seguro ?",
                    text: "No  podras revertir la operacion!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, borralo!",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        //alert(featureId);
                        //utilizo la directiva o referencia ar@bathis.call('nombreDelMetodoComponenteLiveWire',featureId);
                        @this.
                        call('deleteFeature', option_id, feature_id);

                    }

                });


            }

            function confirmDeleteOption(option_id) {

                //muesto el id del elemento a eliminar -> alert(featureId);
                Swal.fire({
                    title: "Esta seguro ?",
                    text: "No  podras revertir la operacion!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, borralo!",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.
                        call('deleteOption', option_id);
                    }
                });
            };
        </script>

    @endpush

</div>
