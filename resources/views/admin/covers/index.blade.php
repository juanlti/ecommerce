<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',
'route'=>route('admin.dashboard')


],
[
'name'=>'Covers',
]

]">

    {{-- botton--}}
    <x-slot name="action">
        <a href="{{route('admin.covers.create')}}" class="btn btn-blue">
            Nuevo
        </a>

    </x-slot>

    <ul class="space-y-4" id="covers1">
        {{-- id="covers" es el id del componente que contiene las colecciones a utilizar con sortable --}}
        {{--space-y-4 obtener una separacion en vertical respecto a las 2 tarjetas dentro del foreach  --}}
        @foreach($allCovers as $cover)

            {{-- overflow-hidden, oculta los objetos que sobre salgan de la tarjeta --}}
            <li class="bg-white rounded-lg shadow-lg overflow-hidden lg:flex cursor-move" data-id="{{$cover->id}}">
                {{-- tarjeta n: 1 --}}
                {{-- w-64 => 64 de ancho,  aspect-[3/1]=> toma el alto de la imagen y lo multiplica x3, resultado el ancho es 3 veces que su alto --}}
                {{-- object-cover => evitamos deformaciones en la imagen.  object-center => centramos la imagen--}}
                <img src="{{$cover->image}}" alt="" class="w-full lg:w-64 aspect-[3/1] object-cover object-center">

                {{-- tarjeta n: 2. Para que la tarjeta se posicione del lado derecho de la tarjeta n:1 en la clase padre (ambas tarjetas), utilizo flex--}}
                {{-- flex-1 ocupa el ancho disponible --}}
                <div class="p-4 lg:flex-1 lg:flex lg:justify-between lg:items-center space-y-3 lg:space-y-0">
                    <div class="max-w-full">

                        {{--div n:1 --}}
                        <div class="whitespace-normal">
                            <h1 class="font-semibold">  {{$cover->title}}</h1>
                        </div>

                        {{-- estado de la portada --}}
                        <p>
                            @if($cover->is_active)
                                <span
                                    class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Activo</span>

                            @else
                                <span
                                    class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Inactivo</span>
                            @endif
                        </p>

                    </div>
                    <div>
                        {{--div n:2 --}}
                        <p class="text-sm font-bold">Fecha de inicio </p>
                        <p> {{$cover->start_at->format('d/m/Y')}}</p>


                    </div>
                    <div>
                        {{--div n:3 --}}
                        <p class="text-sm font-bold">Fecha de finalizacion </p>
                        <p> {{$cover->end_at? $cover->end_at->format('d/m/Y'):'-'}}</p>

                    </div>
                    <div>
                        {{--div n:4 --}}
                        <a href="{{route('admin.covers.edit',$cover)}}" class="btn btn-blue">Editar</a>

                    </div>


                </div>
            </li>

        @endforeach

    </ul>
    @push('js')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', async function () {
                new Sortable(document.getElementById('covers1'), {
                    animation: 150,
                    ghostClass: 'bg-blue-100',
                    store: {
                        set: async (sortable) => {
                            const sortsCovers = sortable.toArray();
                            try {
                                const response = await axios.post("{{route('api.sort.covers')}}", {
                                    newOrderSortsCovers: sortsCovers
                                });
                                // Si el servidor responde correctamente, muestra un mensaje de éxito.
                                //alert('El orden ha sido guardado correctamente.');
                            } catch (error) {
                                // Verifica si el error proviene de una respuesta del servidor o es un error de red.
                                if (error.response) {
                                    // El servidor respondió con un código de estado fuera del rango 2xx.
                                    console.log('Error data:', error.response.data);
                                    console.log('Error status:', error.response.status);
                                    //alert(`Error al guardar el orden: ${error.response.status} ${error.response.data.message}`);
                                } else if (error.request) {
                                    // La solicitud fue hecha pero no se recibió respuesta.
                                    console.log('Error request:', error.request);
                                    alert('Error al guardar el orden: No se recibió respuesta del servidor.');
                                } else {
                                    // Algo más causó el error.
                                    console.log('Error', error.message);
                                    //alert('Error al guardar el orden: Error desconocido.');
                                }
                            }
                        }
                    }
                });
            });

        </script>

    @endpush

</x-admin-layout>
