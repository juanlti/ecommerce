<?php

namespace App\Livewire\Admin\Products;

use App\Models\Subcategory;
use App\Models\Category;
use Livewire\Component;
use App\Models\Family;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;


class ProductEdit extends Component

{
    use WithFileUploads;

    //cargar imagenes en livewire
    //recibo el objeto  producto por parametro a editar
    //para recibir un objeto desde una vista al componente view de livewire, es necesario definir en el compponente una variable con el mismo nombre.
    public $product;
    public $productEdit;
    public $families;
    public $family_id = '';
    public $category_id = '';
    public $subcategory_id = '';
    public $image = null;
    public $imageEdit = '';


    /*
    public $productSelect = [
        'name' => $this->product->name,
        'sku' =>  $this->product->sku,
        'description' =>  $this->description,
        'image_path' =>  $this->image_path,
        'price' =>  $this->price,
        'subcategory_id' =>  $product->subcategory_id,

    ];
    */

    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }

    public function mount($product)
    {

        //RECUPERA LOS DATOS A EDITAR Y LOS MUESTRA

       // dump($this->product->only('id', 'name', 'subcategory_id'));
        //$this->imageEdit=$product->image_path;
        //obtener informacio anterior subcategoria, es decir la relacion de SubCategoria --> product
        //dd($product->subcategory->toArray());
        //luego, puedo obtenrr la informacion  categoria, es decir la relacion de Categoria a Subcategoria
        //dd($product->subcategory->category->toArray());
        //luego, puedo obtener la informacion familia, es decir la relacion de categoria a categoria
        //dd($product->subcategory->category->family->toArray());

        //dd('estoy en el metodo mount');
        //para obtener algunos atributos del objeto $product, utilizo la funcion:
        //only('llave del campos'), y devuelve un arreglo
        $this->productEdit = $product->only('sku', 'name', 'description', 'image_path', 'price', 'subcategory_id');
        //$productEdit termina siendo un arreglo con los atributos solicitados
        //dd($this->productEdit);

        //dd($this->productEdit['image_path']);

        //dd($productEdit);

        //cargo las listas desplegables en orden de procedencia
        //todas las familias
        //dd($product['subcategory_id']);
        $this->families = Family::all();
        //familia que pertecene

        $this->family_id = $product->subcategory->category->family->id;
        //dd($this->family_id);
        // categoria que pertecene
        $this->category_id = $product->subcategory->category->id;
        $this->subcategory_id = $product->subcategory->id;


        //dd( $this->category_id);
        //dd($family_id);
        //dd($category_id);
        // dd($this->category_id);


    }

    #[Computed()]
    public function categories()
    {
        //si $family_id cambia,  automaticamente se realiza la busqueda de la categoria a la cual pertecene la nueva familia selecionada
        return Category::where('family_id', $this->family_id)->get();


    }

    #[Computed()]
    public function subcategories()
    {
        //si $category_id cambia,  automaticamente se realiza la busqueda de la subcategoria a la cual pertecene la nueva categoria selecionada
        return Subcategory::where('category_id', $this->category_id)->get();


    }


    public function updatedFamilyId()
    {
        //detecta si $family_id cambio de valor y automatcamente pone en blanco las siguientes propiedades
        $this->category_id = '';
        $this->subcategory_id = '';


    }

    public function updatedCategoryId()
    {
        $this->subcategory_id = '';
    }


    public function boot()

    {



        //este metodo se ejecuta cada vez que la vista se renderiza
        //lo utilizo para mostrar los mensajes de errores
        $this->withValidator(function ($validator) {

            //si alguna regla fallo, es decir no cumple con las condiciones
            if ($validator->fails()) {
                //dd('existe algun errro');
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => '!Error',
                    'text' => 'El formulario contiene errores, revise las indicaciones',

                ]);


            }
        });


    }

    public function store()
    {
        // validacion y almacenamiento
        //       'productEdit.sku' => 'required|unique:products,sku,'$this->product->id
        // con la ultima sentencia, declaro que  se verique a todos los demas sku menos el que tiene como argumento
        $this->validate([
            'image' => 'nullable|image|max:1024',
            'productEdit.name' => 'required|min:1|max:255',
            'productEdit.sku' => 'required|unique:products,sku,'.$this->product->id,
            'productEdit.description' => 'nullable',
            'productEdit.price' => 'required|numeric|min:0',
            'productEdit.subcategory_id' => 'required|exists:subcategories,id',

            'family_id' => 'required|exists:families,id',
            'category_id' => 'required|exists:categories,id',


        ]);
        //si todo sale bien, ejecuto la proxima linea de codigo

        //si existe una imagen, porque el usuario lo actualizo
        if($this->image){
            //borro la imagen original
            Storage::delete($this->productEdit['image_path']);
            // guardo la imagen actualizada
            $this->productEdit['image_path']=$this->image-store('products');

        }
        $this->product->update($this->productEdit);
        /*
        $this->dispatch('swal', [
            'icon' => 'error',
            'title' => '!Error',
            'text' => 'El producto se actualizo correctamente'.$this->productEdit['name'],

        ]);
        */
        session()->flash('swal', [
            'icon' => 'succes',
            'title' => 'Bien hecho',
            'text' => 'Producto se ha actualizado correctamente :' . $this->product['sku'],

        ]);

        return redirect()->route('admin.products.edit',$this->product);



    }
}
