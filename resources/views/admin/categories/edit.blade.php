<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',
'route'=>route('admin.dashboard')


],
[
'name'=>'Categorias',
'route'=>route('admin.categories.index')
],
[
'name'=>'Editar'
]
]">

    <form action="{{route('admin.categories.update',$category)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <x-validation-errors class="mb-4">

            </x-validation-errors>
            <div class="mb-4">
                <x-label class="mb-2">
                    Selecione una Familia para crear una Categoria
                    'category','families'
                </x-label>
                <label>
                    <x-select name="family_id" class="w-full">
                        @foreach($families as $family)
                            <option value="{{$family->id}}"
                            @selected(old('family_id',$category->family_id) == $family->id)>
                                               {{$family->name}}

                            </option>
                        @endforeach


                    </x-select>
                </label>

            </div>
            <div class="mb-4">
                <x-label class="mb-2"> Nombre</x-label>

                <x-input class="w-full" placeholder="Ingrese el nombre de la categoria" name="name" value="{{old('name',$category->name)}}"></x-input>

            </div>
            <div  class="flex justify-end">
                <!-- MOVER BOTTON  A LA DERECHA ( O FINAL )-->
                <x-button> Actualizar</x-button>
            </div>


        </div>





    </form>

</x-admin-layout>
