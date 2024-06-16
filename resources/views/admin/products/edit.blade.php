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

    {{-- RECOMENDACION PARA DOS O MAS COMPONENTES EN UNA MISMA VISTA, UTILIZAR UNA LLAVE PARA INDENTIFICAR CADA COMPONENTE--}}
    {{--Las llave es la concatenacion de un string con el id del producto--}}
    {{-- Componente de liveWire formulario editar producto --}}
   <div class="mb-12">
       @livewire('admin.products.product-edit',['product'=>$product], key('product-edit-'.$product->id))
   </div>

    {{-- Componente de livewire formulario, para agregar variantes--}}
    @livewire('admin.products.product-variants',['product'=>$product],key('product-variants-'.$product->id))

    </x-admin-layout>




