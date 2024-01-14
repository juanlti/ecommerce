
@if(count($breadcrumbs))
    <!-- $breadcrumbs es un arreglo de subPaginas desde la inicial hasta la actual ejemplo: Home -> Tecnologias -> Computadoras -> Acer -->
<nav class="mb-4">
    <ol class="flex flex-wrap">
            @foreach($breadcrumbs as $unBreadCrums)
        <!-- recorrdo el areglo de $breadcrumbs (subcategorias) -->
        <li class="text-sm leading-normal text-slate-700 {{!$loop->first ? "pl-2 before:float-left before:pr-2 before:content-['/']" :''}}">
            <!-- si es el primero de todos no muestro  / -->

            <!-- es un enlace: muestro enlace + nombre -->
            @isset($unBreadCrums['route'])
                <a href="{{$unBreadCrums['route']}}" class="opacity-50">
                {{$unBreadCrums['name']}}
                </a>
                @else
                <!-- no es enlace : muestro  nombre -->
                {{$unBreadCrums['name']}}

                @endisset

        </li>
        @endforeach


    </ol>

<h6 class="font-bold">
    <!--  ultima pagina (subcategoria) -->
    @if(count($breadcrumbs)>1)
    {{end($breadcrumbs)['name']}}
        @endif
</h6>
</nav>
@endif
