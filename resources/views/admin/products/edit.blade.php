<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',
'route'=>route('admin.dashboard')


],
[
'name'=>'Productos',
'route'=>route('admin.products.index'),
],
[
    'name'=> $product->name,
]
]">
    {{-- Componente de liveWire formulario editar producto --}}
    @livewire('admin.products.product-edit',['product'=>$product])
    </x-admin-layout>




