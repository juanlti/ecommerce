<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <section class="rounded-lg bg-white shadow-lg">

        <header class="border-b border-gray-200 px-6 py-2 border-gray-200">
            <h1 class="text-lg font-semibold text-gray-700">Opciones</h1>
        </header>


        <div class="p-6">
            <div class="space-y-6">
                @foreach($options as $option)

                    <div class="p-6 rounded-lg border border-gray-600 relative">
                        <div class="absolute -top-3 bg-white px-4">
                            <spam>
                                {{$option->name}}
                            </spam>

                        </div>
                        {{--valores, inversa --}}
                        <div class="flex">
                            @foreach($option->features as $feature)
                                {{$feature->value}}
                                @switch($option->type)
                                    @case(1)

                                        @break
                                    @case(2)

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
