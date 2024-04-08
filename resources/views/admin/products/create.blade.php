<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',
'route'=>route('admin.dashboard')


],
[
'name'=>'Productos',
'route'=>route('admin.products.index'),
],
[
    'name'=>'Nuevo',
]
]">

    {{-- Componente de liveWire formulario producto --}}
    @livewire('admin.products.product-create')



   </x-admin-layout>


