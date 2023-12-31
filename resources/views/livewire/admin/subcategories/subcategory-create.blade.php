    {{-- Be like water. --}}
<div>
    <form>

        <div class="card">
            <x-validation-errors class="mb-4">


            </x-validation-errors>
            <div class="mb-4">
                <x-label class="mb-2">
                    Familias

                </x-label>
                <x-select class="w-full" wire:model.live="categorySelect.family_id">

                    <option value="" disabled>
                        Selecione una Familia
                    </option>
                    @foreach($families as $family)
                        <option value="{{$family->id}}">
                            {{$family->name}}
                        </option>

                    @endforeach


                </x-select>

            </div>
            {{--
            <div class="mb-4">
                <x-label class="mb-2">
                  Familias

                </x-label>
                --}}
            {{--
                <x-select class="w-full">
                            @foreach($families as $family)
                                <opction value="{{$family->id}}">
                                    {{$family->name}}
                                </opction>

                                @endforeach


                </x-select>

            </div>
            {{-- <div class="mb-4">

                  </div>


                <label>

                    <x-select name="category_id" class="w-full">
                        @foreach($categories as $categorie)
                            <!--solo mostramos la familia selecionada si existe un error al momento de crear una categoria -->


                            <!-- value $categorie->id  contiene el id del objeto de la categoria selecionada -->
                            <option value="{{$categorie->id}}">

                                <!-- metodos de recuperacion de datos por error de validacion -->
                                @selected(old('$categorie->id')== $categorie->id)
                                <!-- old mantiene el objeto de la categoria selecionada cuando se recargue la pagina id dado un error -->
                                {{$categorie->name}}
                                <!-- posterior el metodo old, se muestra el atributo del nombre objeto de la categoria selecioanda -->
                            </option>

                        @endforeach

                    </x-select>
                </label>
  --}}

            <div class="mb-4 mt-10">
                <x-label class="mb-2"> Nombre</x-label>

                <x-input class="w-full" placeholder="Ingrese el nombre de la categoria"></x-input>

            </div>
            <div  class="flex justify-end">
                <!-- MOVER BOTTON  A LA DERECHA ( O FINAL )-->
                <x-button> Guardar</x-button>
            </div>






        </div>

    </form>
       @dump($this->categories)
</div>
