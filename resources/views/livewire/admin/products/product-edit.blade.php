<div>
    <form wire:submit="store">

        @csrf
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
        {{-- store es un metodo, y este se ejecuta con el boton de nuevo --}} <img
            class="aspect-[16/9] object-cover object-center w-full"


            src="{{ $image ? $image->temporaryUrl():Storage::url($productEdit['image_path'])}}"
            {{-- APP_URL=http://localhost-- }}
         {{-- Storage recupera la imagen a traves del path_imagen de $imagen --}}
            {{--   src="{{ $image ? $image->temporaryUrl()  :asset('img/no-image.png')}}" --}}
            alt="">

        {{--  $image ? si es distintono de nulo ejecuta :
          $image->temporaryUrl() obtengo la url provista por el sistema (es una url de almacenamiento)
          si es nulo ejecuta :  :asset('img/no-image.png') imagen por defecto
            --}}
        {{-- object-cover permite que el objeto interno e la img cubra todo su espacio y con objecter-center centro ese mismo objeto--}}
        </figure>
        {{--
        @dump($productEdit['image_path'])
        @dump(Storage::url($productEdit['image_path']))
        @dump('http://localhost/storage/app/public/'.$productEdit['image_path'])
        {{Storage::url($productEdit['image_path'])}}

        @dump('storage/products/Jj2Yw9ItyY5WrQNrMmEnCDiqCUba9D7ho2iUI0je.jpg')
        {{ Storage::url('http://localhost/storage/'.$productEdit['image_path']) }}
         --}}

        {{-- Componente encargado de mostrar los mensajes de validaciones--}}
        <x-validation-errors class="mb-4"/>

        <div class="card">

            <div class="mb-4">
                <x-label class="mb-1">

                    Codigo

                </x-label>


                <x-input wire:model="productEdit.sku" class="w-full"
                         placeholder="Por favor ingrese el codigo (sku) del producto"/>


            </div>
            <div class="mb-4">
                <x-label class="mb-1">

                    Nombre

                </x-label>


                <x-input wire:model="productEdit.name" class="w-full"
                         placeholder="Por favor ingrese el nombre del producto"/>


            </div>

            <div class="mb-4">

                <x-label class="mb-1">

                    Descripcion

                </x-label>


                <x-textarea wire:model="productEdit.description" class="w-full"
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
                <x-select wire:model.live="productEdit.subcategory_id" class="w-full">

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
                    wire:model="productEdit.price"
                    class="w-full"
                    placeholder="Porfavor ingrese un precio">
                </x-input>

            </div>

            <div class="mt-4 flex justify-end">


                    <x-danger-button onclick="confirmDelete()">
                        <!-- 1 PASO: ACCION DEL BOTON -->
                        Eliminar
                    </x-danger-button>
                <x-button class="ml-2">
                    Actualizar

                </x-button>





                {{--
                @dump($this->subcategory_id)
                @dump($this->productEdit)
                    --}}
            </div>


    </form>
    <form action="{{route('admin.products.destroy',$product)}}" method="POST" id="delete-form">
        <!-- 3 (ULTIMO)  PASO: PETEICION DE ELIMINAR -->
        @csrf
        @method('DELETE')


    </form>
    @push('js')
        <!-- 2 PASO: RECEPCION DE LA  ACCION -->
        <!-- codigo de js -->
        <script>
            function confirmDelete(){

                <!--    alert("hola")s TEST -->

                Swal.fire({
                    title: "Esta seguro ?",
                    text: "No  podras revertir la operacion!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, borralo!",
                    cancelButtonText:"Cancelar",
                }).then((result) => {
                    document.getElementById('delete-form').submit();

                });
            }

        </script>
    @endpush

</div>


