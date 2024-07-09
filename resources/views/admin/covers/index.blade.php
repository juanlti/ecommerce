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
    <a  href="{{route('admin.covers.create')}}" class="btn btn-blue">
        Nuevo
    </a>

</x-slot>

    <ul class="space-y-4">
        {{--space-y-4 obtener una separacion en vertical  --}}
       @foreach($allCovers as $cover)
               <li class="bg-white rounded-lg shadow-lg">
                      <div class="p-4"></div>
                   <img src="{{$cover->image}}" alt="">
               </li>

           @endforeach

    </ul>
    </x-admin-layout>
