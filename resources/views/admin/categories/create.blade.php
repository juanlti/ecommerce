<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',
'route'=>route('admin.dashboard')


],
[
'name'=>'Categorias',
'route'=>route('admin.categories.index')
],
[
'name'=>'Nuevo'
]
]">

     <form action="{{route('admin.categories.store')}}" method="POST">
         @csrf

         <div class="card">
             <x-validation-errors class="mb-4">

             </x-validation-errors>
             <div class="mb-4">
                <x-label class="mb-2">
                    Selecione una Familia para crear una Categoria

                </x-label>
                 <label>
                     <x-select name="family_id" class="w-full">
                         @foreach($families as $family)
                             <!--solo mostramos la familia selecionada si existe un error al momento de crear una categoria -->

                             <option value="{{$family->id}}"
                                 @selected(old('family->id')== $family->id)>
                                 {{$family->name}}

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

</x-admin-layout>
