<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',
'route'=>route('admin.dashboard')


],
[
'name'=>'Subcategorias',
'route'=>route('admin.subcategories.create')
],
[
'name'=>'Nuevo'
]
]">

  {{--  <form action="{{route('admin.subcategories.store')}}" method="POST">
        @csrf

        <div class="card">
            <x-validation-errors class="mb-4">

            </x-validation-errors>
            <div class="mb-4">
                <x-label class="mb-2">
                    Selecione una Familia para crear una Categoria

                </x-label>
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

            </div>
            <div class="mb-4">
                <x-label class="mb-2"> Nombre</x-label>

                <x-input class="w-full" placeholder="Ingrese el nombre de la categoria" name="name" value="{{old('name')}}"></x-input>

            </div>
            <div  class="flex justify-end">
                <!-- MOVER BOTTON  A LA DERECHA ( O FINAL )-->
                <x-button> Guardar</x-button>
            </div>


        </div>





    </form>
--}}
    @livewire('admin.subcategories.subcategory-create')
    {{-- incorporo el page create de subcategori en el componente de livewire de subcategory-create--}}
</x-admin-layout>
