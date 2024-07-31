<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <section class="bg-white rounded-lg shadow overflow-hidden">
        <header class="bg-gray-900 px-4 py-2">
            <h2 class="text-white text-lg">
                Direcciones de envio guardadas
            </h2>
        </header>
        <div class="p-4">
            @if($newAddress)
                {{-- si  $newAddress es true, entonces mostramos el formulario para crear una nueva dirreccion--}}
                <div>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <x-validation-errors class="mb-6"/>
                <div x-data="{
                    updating: false,
                    type: @entangle('createAddress.type')
                }">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-1">
                            <x-select x-model="type">
                                <option value="0">Tipo de direccion</option>
                                <option value="1">Domicilio</option>
                                <option value="2">Oficina</option>
                            </x-select>
                        </div>
                        <div class="col-span-3">
                            <x-input type="text" placeholder="Nombre de la direccion" class="w-full"
                                     wire:model="createAddress.description"/>
                        </div>
                        <div class="col-span-2">
                            <x-input wire:model="createAddress.district" type="text" class="w-full"
                                     placeholder="Ingrese la provincia">
                            </x-input>
                        </div>
                        <div class="col-span-2">
                            <x-input wire:model="createAddress.reference" type="text" class="w-full"
                                     placeholder="ejemplo: la segunda casa porton negro">
                            </x-input>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div x-data="{
                        receiver:@entangle('createAddress.receiver'),
                        receiver_info:@entangle('createAddress.receiver_info')
                    }" x-init="$watch('receiver', value => {
                        if(value==1){
                            receiver_info.name ='{{auth()->user()->name}}';
                            receiver_info.last_name ='{{auth()->user()->last_name}}';
                            receiver_info.document_type='{{auth()->user()->document_type}}';
                            receiver_info.document_number ='{{auth()->user()->document_number}}';
                            receiver_info.phone ='{{auth()->user()->phone}}';
                        } else {
                            receiver_info.name = '';
                            receiver_info.last_name ='';
                            receiver_info.document_number ='';
                            receiver_info.phone ='';
                        }
                    })">
                        <p class="font-semibold mb-2">Quien recibira el pedido</p>
                        <div class="flex space-x-4 mb-4">
                            <label class="flex items-center">
                                <input x-model="receiver" type="radio" value="1" class="mr-2"> Sere yo
                            </label>
                            <label items-center>
                                <input x-model="receiver" type="radio" value="0" class="mr-2"> Otra persona
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <x-input x-bind:disabled="receiver==1" x-model="receiver_info['name']" class="w-full"
                                         placeholder="nombres">
                                </x-input>
                            </div>
                            <div>
                                <x-input x-bind:disabled="receiver==1" x-model="receiver_info['last_name']"
                                         class="w-full" placeholder="apellidos">
                                </x-input>
                            </div>
                            <div class="flex space-x-2">
                                <x-select x-bind:disabled="receiver==1" x-model="receiver_info['document_type']">
                                    @foreach(\App\Enums\TypeOfDocuments::cases() as $unEnums)
                                        <option value="{{$unEnums->value}}">{{$unEnums->name}}</option>
                                    @endforeach
                                </x-select>
                                <x-input x-bind:disabled="receiver==1" x-model="receiver_info['document_number']"
                                         class="w-full" type="text"
                                         placeholder="ingrese el numero"/>
                            </div>
                            <div>
                                <x-input x-bind:disabled="receiver==1" x-model="receiver_info['phone']" type="text"
                                         placeholder="telefono"
                                         class="w-full"/>
                            </div>
                            <div class="btn btn-outline-gray w-full flex justify-center items-center"
                                 wire:click="$set('newAddress',false)">
                                <button class="center-items">Cancelar</button>
                            </div>
                            <div class="btn btn-outline-gray flex justify-center items-center">
                                <button wire:click="store" class="center-items" x-bind:disabled="type != 1 && type != 2"
                                        x-on:click="updating = true">Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- muestro formulario para editar una direccion --}}
                {{-- para mostrar el formulario de ediccion, verifico si el atributo id tiene un valor (distinto de nulo) del componente  EditAddress FormObjecto
                si  es correcto, automaticamente muestro el formulario para editar, caso contrario se mantiene oculto--}}
                @if($editAddress->id)
                    {{-- muestro  formulario de ediccion --}}
                    {{-- si  $newAddress es true, entonces mostramos el formulario para crear una nueva dirreccion--}}
                    <div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    <x-validation-errors class="mb-6"/>
                    <div x-data="{
                    updating: false,
                    type: @entangle('editAddress.type')}">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-1">
                                <x-select x-model="type">

                                    <option value="0">Tipo de direccion</option>
                                    <option value="1">Domicilio</option>
                                    <option value="2">Oficina</option>
                                </x-select>
                            </div>
                            <div class="col-span-3">
                                <x-input type="text" placeholder="Nombre de la direccion" class="w-full"
                                         wire:model="editAddress.description"/>


                            </div>
                            <div class="col-span-2">
                                <x-input wire:model="editAddress.district" type="text" class="w-full"
                                         placeholder="Ingrese la provincia">
                                </x-input>
                            </div>
                            <div class="col-span-2">
                                <x-input wire:model="editAddress.reference" type="text" class="w-full"
                                         placeholder="ejemplo: la segunda casa porton negro">
                                </x-input>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div x-data="{
                        receiver:@entangle('editAddress.receiver'),
                        receiver_info:@entangle('editAddress.receiver_info')
                    }" x-init="$watch('receiver', value => {
                        if(value==1){
                            receiver_info.name ='{{auth()->user()->name}}';
                            receiver_info.last_name ='{{auth()->user()->last_name}}';
                            receiver_info.document_type='{{auth()->user()->document_type}}';
                            receiver_info.document_number ='{{auth()->user()->document_number}}';
                            receiver_info.phone ='{{auth()->user()->phone}}';
                        } else {
                            receiver_info.name = '';
                            receiver_info.last_name ='';
                            receiver_info.document_number ='';
                            receiver_info.phone ='';
                        }
                    })">
                            <p class="font-semibold mb-2">Quien recibira el pedido</p>
                            <div class="flex space-x-4 mb-4">
                                <label class="flex items-center">
                                    <input x-model="receiver" type="radio" value="1" class="mr-2"> Sere yo
                                </label>
                                <label items-center>
                                    <input x-model="receiver" type="radio" value="0" class="mr-2"> Otra persona
                                </label>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <x-input x-bind:disabled="receiver==1" x-model="receiver_info['name']"
                                             class="w-full"
                                             placeholder="nombres">
                                    </x-input>
                                </div>
                                <div>
                                    <x-input x-bind:disabled="receiver==1" x-model="receiver_info['last_name']"
                                             class="w-full" placeholder="apellidos">
                                    </x-input>
                                </div>
                                <div class="flex space-x-2">
                                    <x-select x-bind:disabled="receiver==1" x-model="receiver_info['document_type']">
                                        @foreach(\App\Enums\TypeOfDocuments::cases() as $unEnums)
                                            <option value="{{$unEnums->value}}">{{$unEnums->name}}</option>
                                        @endforeach
                                    </x-select>
                                    <x-input x-bind:disabled="receiver==1" x-model="receiver_info['document_number']"
                                             class="w-full" type="text"
                                             placeholder="ingrese el numero"/>
                                </div>
                                <div>
                                    <x-input x-bind:disabled="receiver==1" x-model="receiver_info['phone']" type="text"
                                             placeholder="telefono"
                                             class="w-full"/>
                                </div>
                                <div class="btn btn-outline-gray w-full flex justify-center items-center"
                                     wire:click="$set('editAddress.id',null)">
                                    {{-- para cerrar el formulario de edicion le asigno null al id de la propiedad editAddress --}}
                                    <button class="center-items">Cancelar</button>
                                </div>
                                <div class="btn btn-outline-gray flex justify-center items-center">
                                    <button wire:click="update()" class="center-items"
                                            x-bind:disabled="type != 1 && type != 2"
                                            x-on:click="updating = true">Actualizar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                        {{-- fin formulario ediccion --}}
                @else

                    @if($addresses->count())

                        {{-- muestro las direcciones del usuario logeado --}}
                        {{-- creo una grid de 4 columnas con separacion de 1 rems entre columnas --}}
                        <ul class="grid grid-cols-3 gap-4">
                            @foreach($addresses as $address)

                                <li class="rounded-lg shadow {{$address->default?'bg-purple-200':'bg-white'}}">
                                    <div class="p-4 flex items-center">
                                        {{-- con flex padre, los hijos (total 3) se posicionan de manera horizontal uno al lado de de otro --}}
                                        {{-- h1 --}}
                                        <div class="text-purple-600">
                                            {{-- iconoc --}}
                                            <i class="fa-solid fa-house text-xl">
                                            </i>
                                        </div>

                                        <div class="flex-1 mx-4 text-xs">
                                            {{-- h2, ocupa el mayor espeacio disponible  con flex-1 y para tener un margin lado izquierda y lado derecho utilizo  mx-4 --}}
                                            {{-- diferencia las direcciones entre domicilio y officina --}}
                                            <p class="text-purple-600"> {{ $address->type==1 ?'Domicilio': 'Oficina' }}</p>
                                            <p class="text-gray-700 font-semibold">
                                                {{ $address->description }}
                                            </p>
                                            <p class="text-gray-700 font-semibold">
                                                {{ $address->reference }}
                                            </p>
                                            <p class="text-gray-700 font-semibold">
                                                {{ $address->reference }}
                                            </p>
                                            <p>
                                                {{-- muestro los datos de la persona a recibir el producto --}}
                                                @if($address->receiver)
                                                    {{-- lo recibe usuario logeado, receiver vale 1 --}}
                                                    {{ Auth::user()->name }}

                                                @else
                                                    {{-- lo recibe otra persona, receiver vale 0 --}}
                                                    {{ $address->receiver_info['name'] }}

                                                @endif
                                            </p>


                                        </div>


                                        {{-- h3 ---}}
                                        <div class="text-xs text-gray-800 flex flex-col space-y-4">
                                            {{-- cambiar la posicion de los hijos horizontal a vertical utilizo en la clase padre flex flex-col --}}
                                            {{-- cambiar el color de los iconos hijos utilizo text-gray-800 en la etiqueta padre ---}}

                                            <button wire:click="setDefaultAddress({{$address->id}})">
                                                <i class="fa-solid fa-star"></i>
                                            </button>
                                            <button wire:click="edit({{$address->id}})">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <button>
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>


                                        </div>


                                    </div>

                                </li>

                            @endforeach


                        </ul>
                    @else
                        <p>No se ha encontrado direcciones</p>
                    @endif

                    <button class="btn btn-outline-gray w-full flex items-center justify-center mt-4"
                            wire:click="$set('newAddress',true)">
                        Agregar
                        <i class="fa-solid fa-plus ml-2"></i>
                    </button>

                @endif
            @endif
        </div>
    </section>
    @push('js')
        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.hook('message.processed', (message, component) => {
                    if (component.fingerprint.name === 'shipping-addresses') {
                        document.querySelector('[x-data]').__x.$data.updating = false;
                    }
                });
            });
        </script>
    @endpush
</div>
