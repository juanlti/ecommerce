@php
// links es on arreglo y en cada objeto de la posicion i, tiene un nombre,icon,enlace de cada pagina LATERAL
$links=[
    [
        //Escritorio
        'icon'=>'fa-solid fa-gauge',
        'name'=>'Dashboard',
        'route'=>route('admin.dashboard'),
        //verificamos si la ruta esta activa (Estamos sobra esa pagina) o no (pagina distinta)
        'active'=>request()->routeIs('admin.dashboard')
     ],
     [
         // Familias de productos
        'icon'=>'fa-solid fa-box-open',
        'name'=>'Familias',
        'route'=>route('admin.families.index'),
        //verificamos si la ruta esta activa (Estamos sobra esa pagina) o no (pagina distinta)
        'active'=>request()->routeIs('admin.families.*')

     ],
       [
         // Categorias de Familias
        'icon'=>'fa-solid fa-tags',
        'name'=>'Categorias',
        'route'=>route('admin.categories.index'),
        //verificamos si la ruta esta activa (Estamos sobra esa pagina) o no (pagina distinta)
        'active'=>request()->routeIs('admin.categories.*')

     ],
       [
         // Subcategoria  de Categorias
        'icon'=>'fa-solid fa-tag',
        'name'=>'Subcategories',
        'route'=>route('admin.subcategories.index'),
        //verificamos si la ruta esta activa (Estamos sobra esa pagina) o no (pagina distinta)
        'active'=>request()->routeIs('admin.subcategories.*')

     ],
       [
         // Productos de subcategorias
        'icon'=>'fa-solid fa-box',
        'name'=>'Productos',
        'route'=>route('admin.products.index'),
        //verificamos si la ruta esta activa (Estamos sobra esa pagina) o no (pagina distinta)
        'active'=>request()->routeIs('admin.products.*')

     ]







];

@endphp


<aside id="logo-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
       :class="{
       'translate-x-0 ease-out': sidebarOpen,
       '-translate-x-full ease-in': !sidebarOpen
       }"

       aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach($links as $unLink)
            <li>
                <!-- carga  dinamica de Enlace -->
                <a href="{{$unLink['route']}}"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{$unLink['active']? 'bg-gray-100': ''}}">
                    <!-- carga  dinamica de Icon -->
                    <span class="inline-flex w-6 h-6 justify-center items-center">

                       <i class="{{$unLink['icon']}} text-gray-500"></i>

                    </span>
                    <!-- carga  dinamica de Nombre -->
                    <span class="ml-2">{{$unLink['name']}}</span>
                </a>
            </li>
                @endforeach

        </ul>
    </div>
</aside>

