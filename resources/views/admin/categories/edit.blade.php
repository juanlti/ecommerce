<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',
'route'=>route('admin.dashboard')


],
[
'name'=>'Categorias',
'route'=>route('admin.categories.index')
],
[
'name'=>$category->name,
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


                <x-danger-button onclick="confirmDelete()">
                    <!-- 1 PASO: ACCION DEL BOTON -->
                    Eliminar
                </x-danger-button>
                <x-button class="ml-2"> Actualizar</x-button>
            </div>


        </div>





    </form>
    <form action="{{route('admin.categories.destroy',$category)}}" method="POST" id="delete-form">
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
