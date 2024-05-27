<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',
'route'=>route('admin.dashboard')


],
[
'name'=>'Opciones',

]
]">

    {{--  redirecciono a la vista del componente de livewireOptions --}}
    @livewire('admin.options.manege-options')
</x-admin-layout>
