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
                        {{-- ocupa una 1 columna --}}
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
                        {{-- ocupa 3 columnas --}}
                        <x-input type="text" placeholder="Nombre de la direccion" class="w-full"/>

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
