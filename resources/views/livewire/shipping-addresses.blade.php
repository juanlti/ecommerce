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
                            <x-input type="text" placeholder="Nombre de la direccion" class="w-full" wire:model="createAddress.description"/>
                        </div>
                        <div class="col-span-2">
                            <x-input wire:model="createAddress.district" type="text" class="w-full" placeholder="Ingrese la provincia">
                            </x-input>
                        </div>
                        <div class="col-span-2">
                            <x-input wire:model="createAddress.reference" type="text" class="w-full" placeholder="ejemplo: la segunda casa porton negro">
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
                                <x-input x-bind:disabled="receiver==1" x-model="receiver_info['name']" class="w-full" placeholder="nombres">
                                </x-input>
                            </div>
                            <div>
                                <x-input x-bind:disabled="receiver==1" x-model="receiver_info['last_name']" class="w-full" placeholder="apellidos">
                                </x-input>
                            </div>
                            <div class="flex space-x-2">
                                <x-select x-bind:disabled="receiver==1" x-model="receiver_info['document_type']">
                                    @foreach(\App\Enums\TypeOfDocuments::cases() as $unEnums)
                                        <option value="{{$unEnums->value}}">{{$unEnums->name}}</option>
                                    @endforeach
                                </x-select>
                                <x-input x-bind:disabled="receiver==1" x-model="receiver_info['document_number']" class="w-full" type="text"
                                         placeholder="ingrese el numero"/>
                            </div>
                            <div>
                                <x-input x-bind:disabled="receiver==1" x-model="receiver_info['phone']" type="text" placeholder="telefono"
                                         class="w-full"/>
                            </div>
                            <div class="btn btn-outline-gray w-full flex justify-center items-center" wire:click="$set('newAddress',false)">
                                <button class="center-items">Cancelar</button>
                            </div>
                            <div class="btn btn-outline-gray flex justify-center items-center">
                                <button wire:click="store" class="center-items" x-bind:disabled="type != 1 && type != 2" x-on:click="updating = true">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @if($addresses->count())
                @else
                @endif
                <p>No se ha encontrado direcciones</p>
                <button class="btn btn-outline-gray w-full flex items-center justify-center mt-4" wire:click="$set('newAddress',true)">
                    Agregar
                    <i class="fa-solid fa-plus ml-2"></i>
                </button>
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
