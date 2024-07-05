{{-- {{$attributes->merge([
    defino las clases que se utilizan en el componente container
])}}--}}
<div {{$attributes->merge([
    'class'=>'max-w-7x1 mx-auto sm:px-6 lg:px-8'

])}}>
{{$slot}}
</div>
