<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <section class="bg-white rounded-lg shadow overflow-hidden">
        {{--- overflow-hidden recorta los hijos que sobresalgan al elemento padre ---}}
        <header class="bg-gray-900 px-4 py-2">
            <h2 class="text-white text-lg">
                Direcciones de envio guardadas
            </h2>

        </header>
        <div class="p-4">

            @if($newAddress)
                {{-- aca se muestra el formulario para crear una nueva instancia de dirreccion --}}
                <div class="grid grid-cols-4 gap-4">
                    {{-- grid  de un ancho de 4 columnas con una separacion de 4 entre ellas --}}

                    <div class="col-span-1">
                        {{-- ocupa una 1 columna, tipo de domicilio --}}
                        <x-select wire:model="createAddress.type">
                            {{-- accedo a la instancia de CreateAddressForm y a su valor type con la sentencia createAddress.type--}}
                            {{-- con el objetivo de mostrar en la lista, los valores de 'option', segun el valor seleciondo por el usuario en x-select --}}
                            {{-- ejemplo: si  createAddress.type es 1 entonces se muestra la option de 2 con el valor de Oficina --}}
                            {{--  segui en -09: 49 --}}
                            <option value="">
                                Tipo de direccion

                            </option>
                            <option value="1">
                                Domicilio

                            </option>
                            <option value="2">
                                Oficina
                            </option>
                        </x-select>

                    </div>

                    <div class="col-span-3">
                        {{-- ocupa 3 columnas, domicilio  (descripcion)--}}
                        <x-input type="text" placeholder="Nombre de la direccion" class="w-full"
                                 wire:model="createAddress.description"/>

                    </div>

                    <div class="col-span-2">
                        {{-- ocupa 2 columnas, distrito o provincia--}}

                        <x-input wire:model="createAddress.district" type="text" class="w-full"
                                 placeholder="Ingrese la provincia">
                        </x-input>

                    </div>
                    <div class="col-span-2">
                        {{-- ocupa 2 columnas, referencia del domicilio--}}

                        <x-input wire:model="createAddress.reference" type="text" class="w-full"
                                 placeholder="ejemplo: la segunda casa porton negro">
                        </x-input>

                    </div>


                </div>
                {{--  fin de la grid de 4 cols--}}
                <hr class="my-4">
                <div class="font-semibold mb-2">
                    <p>
                        Quien recibira el pedido
                    </p>
                    <div class="flex space-x-4 mb-4">
                        <label class="flex items-center">
                            <input type="radio" value="1" class="mr-2">
                            Sere yo </label>
                        <label items-center>
                            <input type="radio" value="0" class="mr-2">
                            Otra persona</label>
                    </div>
                    {{-- grid de 2 columnas --}}
                    <div class="grid grid-cols-2 gap-2">
                        {{-- nombres --}}
                        <div>
                            <x-input class="w-full" placeholder="nombres">

                            </x-input>
                        </div>
                        {{-- apellidos --}}
                        <div>
                            <x-input class="w-full" placeholder="apellidos">

                            </x-input>
                        </div>
                        {{-- Selecionar un tipo de documento --}}
                        <div class="flex space-x-2">
                            <x-select name="" id="">
                                @foreach(\App\Enums\TypeOfDocuments::cases() as $unEnums)
                                    {{-- para mostrar $unEnum, utlizo <option> --}}
                                    <option value="{{$unEnums->value}}">{{$unEnums->name}}</option>
                                @endforeach
                                {{-- numero de documento --}}

                            </x-select>
                            <x-input class="w-full" type="text" placeholder="ingrese el numero"/>


                        </div>
                        {{-- numero de telefono --}}
                        <div>
                            <x-input type="text" placeholder="telefono" class="w-full"/>
                        </div>
                        {{-- botton para cancelar direccion --}}
                        <div class="btn btn-outline-gray w-full">
                                <button>
                                    Cancelar
                                </button>
                        </div>

                        {{-- botton para guardar direccion --}}
                        <div class="btn btn-purple w-full">
                            <button>
                                Guardar
                            </button>
                        </div>


                    </div>

                </div>

            @else
                {{-- aca se muestra las dirrecciones --}}
                @if($addresses->count())

                @else

                @endif
                <p>No se ha encontrado direcciones</p>




                <button class="btn btn-outline-gray w-full flex items-center justify-center mt-4"
                        wire:click="$set('newAddress',true)">
                    Agregar
                    <i class="fa-solid fa-plus ml-2"></i>

                </button>

            @endif


        </div>
    </section>


</div>
