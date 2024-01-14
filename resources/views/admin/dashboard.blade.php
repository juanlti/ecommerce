<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',

],

]">

<!-- Creo dos tarjetas -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <!--  Primera  tarjeta -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center">

        <!-- elemento numero 1: Imagen perfil usuario-->
        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            <div class="ml-4 flex-1 text-xl font-semibold">
                <!-- elemento numero 2: Nombre perfil usuario -->
                <h2> Bienvenido, {{auth()->user()->name}}</h2>
                <!-- elemento numero 3: Cerrar Seccion -->
                <!-- el form apunta a la siguiente ruta, jetStream creo las rutas de registro, la utilizamos -->
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="text-sm hover:text-blue-500">
                                Cerrar session

                    </button>



                </form>

            </div>

        </div>

        </div>

    <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-center">
        <!--  Segunda    tarjeta -->
        <h2 class="text-xl font-semibold">
            Multi Ventas
        </h2>

    </div>

    </div>

</x-admin-layout>

