<div>

    <section class="rounded-lg bg-white shadow-lg">

        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                {{--justify-between, un elemento ext. izquierdo y el otro ext. derecho --}}

                <h1 class="text-lg font-semibold text-gray-700">Opciones</h1>
                {{-- generar una accion con click--}}
                {{-- $set() es un metodo magico, permite cambiar el valor de una variable--}}
                <x-button wire:click="$set('openModal',true)">Nuevo</x-button>
            </div>


        </header>


        <div class="p-6">
            {{-- con space-y-6 genero un espacio entre las sub tarjetas--}}
            <div class="space-y-6">
                {{-- si  solo declaramos atributos a una clase pero esa clase no esta definida, entonces los cambios declarados no surgen efecto
                ejemplo: border, es necesario los border-gray--}}
                @foreach($options as $option)

                    <div class="p-6 rounded-lg border border-gray-600 relative" wire:key="option-{{$option->id}}">


                        <div class="absolute -top-3 bg-white px-4">
                            <button onclick="confirmDelete({{$option->id}},'option')"><i
                                    class="pr-2 fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                            </button>

                            <spam>
                                {{$option->name}}
                            </spam>

                        </div>
                        {{--valores, inversa --}}
                        {{-- Muestro por cada  $option las relaciones --}}
                        {{--  1 option  --> m features --}}
                        <div class="flex flex-wrap mb-4">

                            {{--   <div class="flex flex-wrap"> Me aseguro que las diferentes opciones (talle, color, sexo), se vayan agregando al lado
                             pero al completar el limite por linea, los siguientes aparezcan a bajo--}}
                            {{--features de cada option--}}

                            @foreach($option->features as $feature)

                                @switch($option->type)
                                    @case(1)
                                        {{-- Talla --}}
                                        {{-- si el usuario seleciona la opcion uno (talla), sus correspondencia (Relaciones), van a estar dentro del badge Dark --}}



                                        <span
                                            class="mb-2 bg-gray-100 text-gray-800 text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                           {{$feature->description}}
                                           <button type="button" class="ml-0.5"
                                                   onclick="confirmDelete({{$feature->id}},'feature')"
                                                  {{--wire:click="deleteFeature({{$feature->id}}) --}}>
                                                <i class="fa-solid fa-xmark hover:text-red-500"></i>
                                           </button>

                                            </span>





                                        @break
                                    @case(2)
                                        {{-- Color --}}
                                        <div class="relative">
                                            <span
                                                class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4"
                                                style="background-color: {{$feature->value}}">

                                    </span>
                                            <button
                                                class="absolute z-10 left-3 -top-2 rounded-full bg-red-500 hover:bg-red-600 h-4 w-4 flex justify-center item-center"
                                                {{-- item-center mantengo la x en el centro del circulo --}}
                                                onclick="confirmDelete({{$feature->id}},'feature')"
                                                {{-- wire:click="deleteFeature({{$feature->id}})" --}}>
                                                <i class="fa-solid fa-xmark text-white text-xs"></i>
                                            </button>

                                        </div>
                                        @break
                                    @default

                                @endswitch

                            @endforeach

                        </div>
                        {{-- debajo de las features --}}
                        <div>
                            {{--  redirecciono a la vista del componente del compoente add-new-feature  --}}
                            {{-- @dump($option) --}}
                            @livewire('admin.options.add-new-feature',['option'=>$option], key('add-new-feature-'.$option->id))


                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>

    {{-- Utilizo un componentes de jetStream  --}}
    {{-- llamo al componente x-dialog-modal, utiliza 3 parametros, se los paso como slot --}}

    <x-dialog-modal wire:model="openModal">
        {{--Defino el primer slot, hace referencia al slot con el nombre 'title' --}}

        <x-slot name="title"> Crear nueva Opcion</x-slot>

        {{--Defino el segundo slot, hace referencia al slot con el nombre 'content' --}}
        <x-slot name="content">
            <x-validation-errors class="mb-4"/>
            <div class="grid grid-cols-2 gap-6 mb-4">
                {{-- Creo una grilla con dos columnas y con una separacion de 6 --}}
                <div>
                    <x-label class="mb-1">Nombre</x-label>
                    {{-- newOption.name es una referencia al atributo public $newOption['name'], se envia data al backend--}}
                    <x-input class="w-full" wire:model="newOptionForm.name"
                             placeholder="Por ejemplo: Tamanio, Color.."/>


                </div>
                <div>
                    <x-label class="mb-1"> Tipo</x-label>
                    {{-- utiizo el componente x-select propio. lista desplegable --}}
                    <x-select class="w-full" wire:model.live="newOptionForm.type">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </x-select>
                </div>
            </div>
            <div class="flex items-center mb-4">

                {{-- flex permite que se expanda--}}
                {{-- items-center, centra todos los componentes --}}
                {{-- flex-1 ocupa el mayor espacio disponible --}}
                <hr class="flex-1">
                <span class="mx-4">
                        Valores
                    </span>

                <hr class="flex-1">
            </div>

            {{-- space (espaciador en altura y distancia 4 --}}
            <div class="mb-4 space-y-4">

                @foreach($newOptionForm->features as $index => $aFeature)
                    {{--@dump($index)--}}

                    {{-- utilizo el index, porque un index[0]= inputValue + inputDescription --}}
                    {{-- se iterado por la cantidad de Features que tiene un producto. ejemplo: bolsos, tiene color celeste de tipo texto
                    y ademas una 3 descripciones
                    index[0]= value=> 3500 y description=> Celeste cielo.
                     index[1]= value=> 7000 y description=> cuero y color celeste.
                      index[0]= value=> 2000 y description=> Marron.
                    --}}
                    <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="features-{{$index}}">
                        {{-- agrego una llave al elemento que es iterado por foreach en livewire--}}
                        {{-- dentro de la caja, agrego dos inputs, utlizando un grid --}}

                        <div class="absolute -top-3 px-4 bg-white">
                            <button wire:click="removeFeature({{$index}})">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-2 gap-6">

                            <div>

                                <x-label class="mb-1">
                                    Valor
                                </x-label>


                                {{-- inputs n1, corresponde a la columna n1  --}}



                                {{-- inputs n2, corresponde a la columna n2  --}}


                                @switch($newOptionForm->type)

                                    @case(1)
                                        {{-- si case es 1, se muestra el input de texto- --}}
                                        <x-input class="w-full" wire:model="newOptionForm.features.{{$index}}.value"
                                                 placeholder="Tamanio: ejemplo 3LLL"/>
                                        @break
                                    @case(2)
                                        {{-- obtuve el 42 pixeles de la inspeccion, agrego esa misma configuracion con h-[42px]--}}
                                        {{-- flex items-center, centro los objetos y con padding p-3 una separacion con la caja y el objeto --}}
                                        <div
                                            class="border border-gray-300 h-[42px] rounded-md flex items-center p-3 flex justify-between">
                                            {{-- si case es 2, se muestra el input de color- --}}
                                            {{$newOptionForm->features[$index]['value'] ?: 'Selecione un color'}}
                                            {{-- ?: --}}
                                            {{-- objeto ?(verifica que la variable este definida) :(verifica que tenga valor no nulo) 'una sentencia '  --}}
                                            <x-input type="color"
                                                     wire:model.live="newOptionForm.features.{{$index}}.value"
                                                     placeholder="Color: lila3000"/>

                                        </div>
                                        @break

                                    @default
                                @endswitch


                            </div>
                            <div>

                                <x-label class="mb-1">
                                    Descripcion
                                </x-label>

                                <x-input class="w-full" wire:model="newOptionForm.features.{{$index}}.description"
                                         placeholder="Tamanio: ejemplo 3LLL"/>

                            </div>


                        </div>

                    </div>

                @endforeach

            </div>
            <div class="flex justify-end">
                {{-- posiciono el contenido a la derecha --}}
                {{-- addFeature es un metodo que va ser llamado (o ejecutado), cuando se haga uso del boton--}}
                <x-button wire:click="addFeature" class="me-2">Agregar +

                </x-button>


            </div>
        </x-slot>
        {{--Defino el tercer slot, hace referencia al slot con el nombre 'footer' --}}
        <x-slot name="footer">

            <button class="btn btn-blue" wire:click="addOpt">
                Registrar Nuevo
            </button>


        </x-slot>

    </x-dialog-modal>
    {{--@dump($newOption)--}}

    @push('js')
        <script>
            function confirmDelete(id, type) {

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

                        switch (type) {
                            case'feature': {
                                //alert(id);
                                @this.
                                call('deleteFeature', id);

                            }
                                break;
                            case'option': {
                                //alert(id);
                                @this.
                                call('deleteOption', id);

                            }
                                break;


                        }


                    }

                });


            }
        </script>

    @endpush
</div>
