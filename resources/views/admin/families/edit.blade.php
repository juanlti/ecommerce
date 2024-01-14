<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',
'route'=>route('admin.dashboard')


],
[
'name'=>'Editar Familias',
'route'=>route('admin.families.index'),
],
[
'name'=>'Editar : '.$family->name
]

]">
<h3>estoy en edit</h3>

    <div class="card">

        <!-- llamo (o utilizo) el componente de Inputs (entrada de datos) de JetStram -->
        <!-- action => redirige a otra ruta -->

        <form action="{{route('admin.families.update',$family)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-label class="mb-2"> Nombre</x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la familia" name="name" value="{{old('name',$family->name)}}"></x-input>
                    <!-- value="{{old('name',$family->name)}}"  name => mantiene el nombre ingresado si hay un error / ,$family->name muestra el valor a editar -->
            </div>
            <div  class="flex justify-end">
                <!-- MOVER BOTTON  A LA DERECHA ( O FINAL )-->

                <x-danger-button onclick="confirmDelete()">
                    <!-- 1 PASO: ACCION DEL BOTON -->
                    Eliminar
                </x-danger-button>



                <x-button class="ml-2"> Actualizar </x-button>
            </div>

        </form>


    </div>

    <form action="{{route('admin.families.destroy',$family)}}" method="POST" id="delete-form">
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

    </x-admin-layout>
