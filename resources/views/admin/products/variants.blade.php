<x-admin-layout :breadcrumbs="[
[ 'name'=>'Dashboard',
'route'=>route('admin.dashboard')


],
[
'name'=>'Productos',
'route'=>route('admin.products.index'),
],
[
    'name'=>$product->name,
    'route'=>route('admin.products.edit',$product),
],[
'name'=> $variant->features->pluck('description')->implode(' , '),
]
    ]">
    {{-- el metodo pluck retorna una nueva coleccion de una columna en particular, para este ej: obtuve una collDescription--}}
    {{-- y el metodo implode hace una separacion por cada objeto de la nueva coleccion --}}


    {{--creo un Form para enviar la imagen selecionada por el usuario --}}
    <form action="{{route('admin.products.variantsUpadate',['products'=>$product,'variant'=>$variant])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- el metodo PUT, es para actualizar un recurso en especifico --}}



        <div class="relative mb-6">
            <figure>
                <img class="aspect-[0.5/0.75] w-full object-cover object-center" src="{{$variant->image}}" alt=""
                     id="imgPreview">
                {{--  aspect-[16/9] obtengo un ancho de 16 pixles por 9 de alto--}}
                {{-- object-cover  quito las imperfecciones de la imagen --}}
                {{-- object-center centro la imagen  --}}
            </figure>
            <div class="absolute top-12 right-12">
                {{-- absolute  se posiciona en la esquina inferior izquierda, y este sale del flujo del disenio, permitiendo una ubicacion libre dentro del padre --}}
                {{-- Siempre que se utiize un absolute, su padre debe ser relatve --}}

                <label class="flex item-center bg-gray-100 px-4 py-2 rounded-lg cursor-pointer">
                    {{-- flex  permite que los elementos hijos se alineen en una fila --}}
                    {{-- item-center  alinea los elementos hijos en el centro --}}
                    <i class="fas fa-camera mr-2">

                    </i>
                    Actualizar imagen

                    <input class="hidden" type="file" class="hidden" wire:model="image" accept="image/*" name="image"
                           onchange="previewImage(event,'#imgPreview')"/>
                    {{-- el componente de la class="hidden", se encuentra oculto, basta con hacer click del componente padre--}}
                </label>
            </div>
        </div>

        <div class="card">
            <div class="mb-4">
                <x-label class="mb-2">
                    Codigo (SKU)
                </x-label>
                <x-input name="sku" value="{{old('sku',$variant->sku)}}" placeholder="Ingrese el codigo sku"
                         class="w-full">


                </x-input>

            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Stock
                </x-label>
                <x-input type="number" name="stock" value="{{old('stock',$variant->stock)}}"
                         placeholder="Ingrese el stock" class="w-full">


                </x-input>

            </div>
            {{-- todos los de flex, libertard de posicion, con  justify-end lo posicion esquina infererior derecha --}}
            <div class="flex justify-end">
                <x-button>Actualizar</x-button>
            </div>

        </div>
    </form>
    @push('js')
        <script>

            function previewImage(event, querySelector) {

                //Recuperamos el input que desencadeno la acción
                const input = event.target;

                //Recuperamos la etiqueta img donde cargaremos la imagen
                $imgPreview = document.querySelector(querySelector);

                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return

                //Recuperamos el archivo subido
                file = input.files[0];

                //Creamos la url
                objectURL = URL.createObjectURL(file);

                //Modificamos el atributo src de la etiqueta img
                $imgPreview.src = objectURL;

            }
        </script>
    @endpush
</x-admin-layout>
