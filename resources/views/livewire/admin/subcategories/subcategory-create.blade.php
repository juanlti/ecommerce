{{-- Be like water. --}}
<div>
    <form wire:submit="save">

        <div class="card">
            <x-validation-errors class="mb-4">


            </x-validation-errors>
            <div class="mb-4">
                <x-label class="mb-2">
                    Familias

                </x-label>

                <x-select name="family_id" class="w-full" wire:model.live="categorySelect.family_id">
                    {{--Lista desplegable}}
                    {{--  <x-select class="w-full" wire:model.live="categorySelect.family_id"> LO VUELVO
              DEPENDIENTE DE "categorySelect.family_id" atributo del componente--}}
                    <option value="" disabled>
                        {{--    <option value="" disabled> ARREGLO LA CADENA VACIA --}}
                        Selecione una Familia
                    </option>
                    @foreach($families as $family)
                        <option value="{{$family->id}}">
                            {{--  LISTA DESPLEGABLE  --}}
                            {{$family->name}}
                        </option>

                    @endforeach


                </x-select>

            </div>

            <div class="mb-4">

                <x-label class="mb-2">
                    Categorias

                </x-label>


                {{--enlazo el renderizado --}}

                <x-select name="category_id" class="w-full" wire:model.live="categorySelect.category_id">


                    <option value="" disabled>
                        Selecione una categoria
                    </option>
                    @foreach($this->categories as $categorie)
                        <!--solo mostramos la familia selecionada si existe un error al momento de crear una categoria -->


                        <!-- value $categorie->id  contiene el id del objeto de la categoria selecionada -->
                        <option value="{{$categorie->id}}">
                            {{--  LISTA DESPLEGABLE  --}}
                            {{$categorie->name}}
                        </option>

                        <!-- metodos de recuperacion de datos por error de validacion -->
                        @selected(old('category_id')== $categorie->id)
                        <!-- old mantiene el objeto de la categoria selecionada cuando se recargue la pagina id dado un error -->
                        {{$categorie->name}}
                        </option>
                        <!-- posterior el metodo old, se muestra el atributo del nombre objeto de la categoria selecioanda -->

                    @endforeach

                </x-select>


            </div>


            <div class="mb-4 mt-10">
                <x-label class="mb-2"> Nombre</x-label>

                <x-input class="w-full" placeholder="Ingrese el nombre de la categoria"
                         wire:model="categorySelect.name">

                </x-input>

            </div>
            <div class="flex justify-end">
                <!-- MOVER BOTTON  A LA DERECHA ( O FINAL )-->
                <x-button> Guardar</x-button>
            </div>


    </form>
    {{-- @dump para mostrar un arreglo de String --}}
    {{-- @dump($categorySelect)  --}}
    {{-- $this->Accedo Variable computada--}}
    {{-- @dump($this->categories) --}}

</div>
