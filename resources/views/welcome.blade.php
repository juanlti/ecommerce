<x-app-layout>


    @push('css')
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    @endpush
    <!-- Slider main container -->
    <div class="swiper mb-12">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->

            @foreach($coversAllActive as $cover)

                <div class="swiper-slide">
                    <img src="{{$cover->image}}" class="w-full aspect-[3/1] object-cover object-center">
                </div>

            @endforeach

        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        <div class="swiper-scrollbar"></div>
    </div>

    <x-container>
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Ultimos productos </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            {{-- muestro los elementos en grilla.  --}}
            {{-- PANTALLA CHICA => UNA SOLA COLUMNA: grid-cols-1 --}}
            {{-- PANTALLA SMALL => DOS COLUMNAS:  sm:grid-cols-2 --}}
            {{-- PANTALLA MEDIANA => TRES COLUMNAS: md:grid-cols-3  --}}
            {{-- PANTALLA GRANDE => 4  COLUMNAS: lg:grid-cols-4 --}}
            {{-- y por cada columna una separacion de gap-6--}}
            @foreach($lastProducts as $product)
                <article class="bg-white shadow rounded overflow-hidden">

                    <img src="{{$product->image}}" alt="" class="w-full h-48 object-cover object-center">

                    <div class="p-4">
                        <h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px] mb-2">
                            {{-- para que el precio de cada tarjeta se encuentre alineaado con el resto, sin importar el tamanio del nombre, defino una altura minima de 56px
                            despuee, aparece el precio --}}
                            {{-- line-clamp-2 indica la cantidad maximas de lineas para mostrar un texto--}}
                            {{$product->name}}
                        </h1>

                            <p class="text-gray-600 mb-4">
                                ${{$product->price}}
                            </p>


                        <a href="" class="btn btn-blue block w-full text-center">
                            {{-- las referencias no ocupan el ancho disponible, para obtener ese resultado=>  block w-full --}}

                            Ver mas
                        </a>



                    </div>

                </article>

            @endforeach

        </div>
    </x-container>


    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <script>
            const swiper = new Swiper('.swiper', {
                // Optional parameters

                loop: true,
                //cambio de pagina automatico en 5 segundos
                autoplay: {
                    delay: 5000,
                },

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

                // And if we need scrollbar
                scrollbar: {
                    el: '.swiper-scrollbar',
                },
            });
        </script>

    @endpush

</x-app-layout>
