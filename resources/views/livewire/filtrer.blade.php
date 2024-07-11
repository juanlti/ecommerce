<div class="bg-white -py-12">
    {{-- Nothing in the world is as soft and yielding as water. --}}


    <x-container class="flex px-4">

        <aside class="w-52 flex-shrink-0 mr-8">
            {{-- la clase padre flex, contiene varios hijos, y uno de estos, ocupa mas espeacio que el resto, la clase padre flex, automaticamente achica al hijo  mas chico para dar especio al otro --}}
            {{-- con la clase flex-shrink-0, declaro que este hijo no puede ser reducido por la clase padre --}}
            {{-- mr-8 separacion entre y el siguiente componente --}}
            <ul class="space-y-4">
                {{-- separacion entre li de manera vertical --}}
                @foreach($options as $option)

                    <li>
                        <button
                            class="px-4 py-2 bg-gray-200 w-full text-left text-gray-700 flex justify-between items-center">
                            {{-- text-left para posicionar el texto a la izquierda --}}
                            {{$option->name}}

                            <i class="fa-solid fa-angle-down"></i>
                        </button>

                        <ul class="mt-2 space-y-2">
                            @foreach($option->features as $feature)
                                <li>
                                    <label class="inline-flex items-center">
                                        {{--  inline-flex mantiene el mismo reglon, permite utilizar las propiedades de flex --}}
                                        <x-checkbox class="mr-4">


                                        </x-checkbox>
                                        {{$feature->description}}
                                    </label>
                                </li>
                            @endforeach

                        </ul>


                    </li>

                @endforeach
            </ul>

        </aside>
        <div class="flex-1">
            {{-- ocupa todo el espacio --}}

        </div>


    </x-container>
</div>
