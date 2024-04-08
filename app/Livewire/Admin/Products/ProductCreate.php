<?php

namespace App\Livewire\Admin\Products;


use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;

use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\WithFileUploads;


class ProductCreate extends Component
{

    use WithFileUploads;

    //importacion de WithFileUploads para subir imagenes en livewire
    public $image = '';
    //$image contiene la imagen selecionada

    public $value = 'juan';
    public $families;
    public $family_id = '';
    public $category_id = '';
    public $subcategory_id = '';


    public function store()
    {
        //almacenar los atributos para crear un objeto nuevo
        // validacion de los mismos

        $this->validate([

            //$this->image => 'required|image|max:1024',
            'image' => 'required|image|max:1024',
            'product.name' => 'required|max:255|min:2',
            'product.sku' => 'required|unique:products,sku',
            'product.description' => 'nullable',

            'product.price' => 'required|numeric|min:0',
            'family_id' => 'required|exists:families,id',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',


        ], ['product.name.required' => 'Debe ingresar un nombre']);
        // verificacion es correcta, le asigno el valor de la propiedad $this->category_id al arreglo que contiene todos los atributos para crear un objeto Product
        $this->product['subcategory_id'] = $this->category_id;
        //Cargo la imagen en la carpeta producto y nos devuelve el path de su nueva ubicacion
        $pathImage = $this->image->store('products');
        $this->product['image_path'] = $pathImage;
        // creo el producto, con todos los atributos necesarios, por esa razon estoy utilizando un ORM de asignacion masiva
        $newProduct = Product::create($this->product);

        //session flash (mensajes)
        session()->flash('swal', [
            'icon' => 'succes',
            'title' => 'Bien hecho',
            'text' => 'Producto creado correctamente :' . $this->product['sku'],

        ]);

        // return redirect()->route('admin.products.edit',$newProduct);


        //dd($this->product);
    }

    public function mount()
    {
        $this->families = Family::all();

    }

    public function boot()
    {
        //este metodo se ejecuta cada vez que la vista se renderiza
        //lo utilizo para mostrar los mensajes de errores
        $this->withValidator(function ($validator) {

            //si alguna regla fallo, es decir no cumple con las condiciones
            if ($validator->fails()) {
                //dd('existe algun errro');
                $this->dispatch('swal',[
                    'icon'=>'error',
                    'title'=>'!Error',
                    'text'=>'El formulario contiene errores, revise las indicaciones',

                ]);


            }
        });


    }


    //arreglo con los atributos de un producto (valores que llegan del cliente
    public $product = [
        'name' => '',
        'sku' => '',
        'description' => '',
        'image_path' => '',
        'price' => '',
        'subcategory_id' => '',

    ];
    public $valueSelect = [
        'name' => '',
        'sku' => '',
        'description' => '',
        'image_path' => '',
        'price' => '',
        'subcategory_id' => '',

    ];

    public function updatedFamilyId()
    {
        //dd('Cambio');
        // si $family_id cambia de valor pq el usuario selecino otra familia,  automaticamente resetea los valores en blanco
        $this->category_id = '';
        $this->subcategory_id = '';

    }

    public function updatedCategoryId()
    {
        //dd('categoria cambio');
        $this->subcategory_id = '';
    }

    #[Computed()]
    public function categories()
    {


        return Category::where('family_id', $this->family_id)->get();


    }

    #[Computed()]
    public function subcategories()
    {
        return Subcategory::where('category_id', $this->category_id)->get();
    }


    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
