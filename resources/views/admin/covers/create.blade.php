<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',
'route'=>route('admin.dashboard')


],
[
'name'=>'Covers',
'route'=>route('admin.covers.index'),
],
[
'name'=>'Nuevo',
]


]">

    <form action="{{route('admin.covers.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Ingreso de imagen de tipo image --}}
        <figure class="relative mb-4">
            <div class="absolute top-8 right-8">

                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                    {{-- - <label class="flex items-center"> CENTRAR LOS HIJOS --}}
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar imagen

                    {{-- accion al boton --}}
                    <input type="file" class="hidden" accept="image/*" name="image"
                           onchange="previewImage(event,'#imgPreview')"/>
                </label>
            </div>
            <img class="w-full aspect-[3/1] object-cover object-center"
                 src="{{asset('img/no-image.png')}}"
                 alt="Nuevo"
                 id="imgPreview">
            </img>

        </figure>
        <x-validation-errors class="mb-4"/>

        <div class="mb-4">
            {{-- Ingreso de dato de tipo text --}}
            <x-label>

                Titulo

            </x-label>
            <input type="text" name="title" value="{{old('title')}}" placeholder="Ingrese el titulo de la portada"
                   class="w-full rounded-lg"/>


        </div>
        <div class="mb-4">
            {{-- Ingreso de dato de tipo text --}}
            <x-label>

                Fecha de inicio

            </x-label>
            <input type="date" name="start_at" value="{{old('start_at',now()->format('Y-m-d'))}}"
                   class="w-full rounded-lg"/>
            {{-- por defecto muestro la fecha actual, value="{{old('start_at',now()->format('Y-m-d'))}} en formato  --}}


        </div>
        <div class="mb-4">
            {{-- Ingreso de dato de tipo text --}}
            <x-label>

                Fecha fin (opcional)

            </x-label>
            <input type="date" name="end_at" value="{{old('end_at')}}"
                   class="w-full rounded-lg"/>
            {{-- por defecto muestro la fecha actual, value="{{old('start_at',now()->format('Y-m-d'))}} en formato  --}}


        </div>

        <div class="mb-4 flex space-x-2">
            <label>
                <x-input type="radio" name="is_active" value="1" checked/>
                {{-- checked indico que debe estar selecionado con ese valor en una primera instancia  --}}
                Activo
            </label>
            <label>
                <x-input type="radio" name="is_active" value="0"/>

                Inactivo
            </label>


        </div>

        {{-- creo un boton, para el envio de formulario --}}
        <div class="flex justify-end">
        <x-button>Crear portada </x-button>
        </div>


    </form>
    @push('js')
        <script>
            function previewImage(event, querySelector) {

                //alert('hola');
                //Recuperamos el input que desencadeno la acción
                const input = event.target;

                //Recuperamos la etiqueta img donde cargaremos la imagen
                $imgPreview = document.querySelector(querySelector);

                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return

                //Recuperamos el archivo subido
                file = input.files[0];

                //Creamos la url
                objectURL = URL.createObjectURL(file);

                //Modificamos el atributo src de la etiqueta img
                $imgPreview.src = objectURL;
            }

        </script>

    @endpush


</x-admin-layout>
