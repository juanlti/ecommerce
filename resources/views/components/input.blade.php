@props(['disabled' => false])
{{-- si el input esta desabilitado, automaticamente cambia de color con disabled:bg-gray-100  --}}
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm disabled:bg-gray-100']) !!}>
