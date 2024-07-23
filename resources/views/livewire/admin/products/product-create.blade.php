<div>
    <form wire:submit="store">
        @csrf
        {{-- store es un metodo, y este se ejecuta con el boton de nuevo --}}
        <figure class="mb-4 relative">
            {{-- absolute superpone un objeto sobre el objeto padre (figure) --}}
            <div class="absolute top-8 right-8">

                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                    {{-- - <label class="flex items-center"> CENTRAR LOS HIJOS --}}
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar imagen

                    {{-- accion al boton --}}
                    <input type="file" class="hidden" wire:model="image" accept="image/*">
                </label>
            </div>

            <img class="aspect-[16/9] object-cover object-center w-full"
                 src="{{ $image ? $image->temporaryUrl() :asset('img/no-image.png')}}"
                 alt="">
            </img>
            {{--  $image ? si es distinton de nulo ejecuta :
              $image->temporaryUrl() obtengo la url provista por el sistema (es una url de almacenamiento)
              si es nulo ejecuta :  :asset('img/no-image.png') imagen por defecto
                --}}
            {{-- object-cover permite que el objeto interno e la img cubra todo su espacio y con objecter-center centro ese mismo objeto--}}
        </figure>
        {{-- Componente encargado de mostrar los mensajes de validaciones--}}
        <x-validation-errors class="mb-4"/>

        <div class="card">

            <div class="mb-4">
                <x-label class="mb-1">

                    Codigo

                </x-label>


                <x-input wire:model="product.sku" class="w-full"
                         placeholder="Por favor ingrese el codigo (sku) del producto"/>


            </div>
            <div class="mb-4">
                <x-label class="mb-1">

                    Nombre

                </x-label>


                <x-input wire:model="product.name" class="w-full"
                         placeholder="Por favor ingrese el nombre del producto"/>




            </div>

            <div class="mb-4">

                <x-label class="mb-1">

                    Descripcion

                </x-label>


                <x-textarea wire:model="product.description" class="w-full"
                            placeholder="Por favor ingrese una descripcion">

                </x-textarea>


            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Familia

                </x-label>
                <x-select wire:model.live="family_id" class="w-full">

                    <option value="" disabled>
                        Selecione una categoria
                    </option>

                    @foreach($families as $family)

                        <option value="{{$family->id}}">

                            {{$family->name}}
                        </option>

                    @endforeach

                </x-select>


            </div>
            <div class="mb-4">
                <x-label class="mb-1">
                    Categorias

                </x-label>
                <x-select wire:model.live="category_id" class="w-full">

                    <option value="" disabled>
                        Selecione una categoria
                    </option>

                    @foreach($this->categories as $category)

                        <option value="{{$category->id}}">

                            {{$category->name}}
                        </option>

                    @endforeach

                </x-select>


            </div>
            <div class="mb-4">
                <x-label class="mb-1">
                    Subcategoria

                </x-label>
                <x-select wire:model.live="subcategory_id" class="w-full">

                    <option value="" disabled>
                        Selecione una subcategoria
                    </option>

                    @foreach($this->subcategories as $subcategory)

                        <option value="{{$subcategory->id}}">

                            {{$subcategory->name}}
                        </option>

                    @endforeach

                </x-select>


            </div>
            {{--
            @dump($this->family_id)
            @dump($this->categories->all())
             --}}


            <div class="mb-4">

                <x-label class="mb-1">
                    Precio
                </x-label>
                <x-input
                    type="number"
                    step="0.01"
                    wire:model="product.price"
                    class="w-full"
                    placeholder="Porfavor ingrese un precio">
                </x-input>

            </div>

            <div class="mt-4 flex justify-end">
                <x-button>
                    Crear producto

                </x-button>

            </div>


    </form>

</div>


