<div>

    <section class="rounded-lg bg-white shadow-lg">

        <header class="border-b border-gray-200 px-6 py-2">
            <h1 class="text-lg font-semibold text-gray-700">Opciones</h1>
        </header>


        <div class="p-6">
            {{-- con space-y-6 genero un espacio entre las sub tarjetas--}}
            <div class="space-y-6">
                {{-- si  solo declaramos atributos a una clase pero esa clase no esta definida, entonces los cambios declarados no surgen efecto
                ejemplo: border, es necesario los border-gray--}}
                @foreach($options as $option)

                    <div class="p-6 rounded-lg border border-gray-600 relative">
                        <div class="absolute -top-3 bg-white px-4">
                            <spam>
                                {{$option->name}}
                            </spam>

                        </div>
                        {{--valores, inversa --}}
                        {{-- Muestro por cada  $option las relaciones --}}
                        {{--  1 option  --> m features --}}
                        <div class="flex flex-wrap">
                            {{--   <div class="flex flex-wrap"> Me aseguro que las diferentes opciones (talle, color, sexo), se vayan agregando al lado
                             pero al completar el limite por linea, los siguientes aparezcan a bajo--}}
                            @foreach($option->features as $feature)

                                @switch($option->type)
                                    @case(1)
                                        {{-- Talla --}}
                                        {{-- si el usuario seleciona la opcion uno (talla), sus correspondencia (Relaciones), van a estar dentro del badge Dark --}}
                                        <span
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                           {{$feature->description}}
                                            </span>



                                        @break
                                    @case(2)
                                        {{-- Color --}}
                                    <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4" style="background-color: {{$feature->value}}">



                                    </span>
                                        @break
                                    @default

                                @endswitch

                            @endforeach

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


</div>
