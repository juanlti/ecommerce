<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',
'route'=>route('admin.dashboard')


],
[
'name'=>'Familias',
'route'=>route('admin.families.index')
],
[
'name'=>'Nuevo'
]
]">

<div class="card">

        <!-- llamo (o utilizo) el componente de Inputs (entrada de datos) de JetStram -->
    <!-- action => redirige a otra ruta -->

    <form action="{{route('admin.families.store')}}" method="POST">
            @csrf
        <x-validation-errors class="mb-4">

        </x-validation-errors>
        <div class="mb-4">

            <x-label class="mb-2"> Nombre</x-label>
            <x-input class="w-full" placeholder="Ingrese el nombre de la familia" name="name" value="{{old('name')}}"></x-input>

        </div>
        <div  class="flex justify-end">
            <!-- MOVER BOTTON  A LA DERECHA ( O FINAL )-->
          <x-button> Guardar</x-button>
        </div>

    </form>


</div>

</x-admin-layout>
