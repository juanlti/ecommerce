<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryEdit extends Component
{
    //creo una variable $subcategory y esta almacena el valor que recibimos del  metodo edit (controller)
    //$subcategory contiene el objeto a editar
    public $subcategory;


    public $families;

    public $subCategorySelectEdit = [
        'family_id' => '',
        'category_id' => '',
        'name' => '',

    ];

    public function mount($subcategory)
    {

        //con esto, dejamos en la vista el objeto recibido por parametro

        //carga inicial con los datos de familia
        $this->families = Family::all();

        $this->subCategorySelectEdit = [


            //presenta un inconveniente porque Subcategory no tiene el id de familia (family_id)
            //para conocer a que familia pertecene la subcategoria, realizo una conexion entre
            //subcategory(idCategoria) a categoria(idFamilia), porque  categoria tiene un campo llamado family_id.
            //Por lo tanto no es necesario la conexion con Familia,
            'family_id' => $subcategory->category->family_id,

           // dd($subcategory->category->family_id),

            //relleno los compos con el objeto recibido por parametro $subcategory
            'category_id' => $subcategory->category_id,
            'name' => $subcategory->name,
        ];
       // $this->subCategorySelectEdit['family_id']=$subcategory->category->family_id;

    }

    public function updatedSubcategorySelectEditFamilyId()
    {
        //esta a la escucha si family_id se modifico, borra los demas campos
        $categorySelectEdit['category_id'] ='';
        $categorySelectEdit['name'] = '';
    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-edit');
    }


    #[Computed()]
    public function categories()
    {
        //retorna todas las categorias que tenga el mismo idFamily, y si family_id de $this->categorySelectEdit['family_id'])
        //es modifico, entonces genera la consulta, retornando nuevos valores
        //categories() es un metodo, pero tiene un comportamiento de variable computada, se actualiza si hay cambios
        return Category::where('family_id', $this->subCategorySelectEdit['family_id'])->get();

    }
    public function save(){

        //validacion
        //el metodo validate actua sobre la instancia (this), por lo tanto accede a las variables
        // de esa misma instancia y aplica las validaciones
        $this->validate([
            'subCategorySelectEdit.family_id' => 'required|exists:families,id',
            'subCategorySelectEdit.category_id' => 'required|exists:categories,id',
            'subCategorySelectEdit.name' => 'required',
        ]);
            // obtengo el objeto a modificar (no estoy haciendo uso)
        // $subcategoriaEditar = Subcategory::find($this->subcategory->id);
        // dd($subcategoriaEditar);
        // utilizo el objeto recibido por parametro (no el de la bd)
        $this->subcategory->update($this->subCategorySelectEdit);

       //session() funciona con redireccionamiento
        /*
        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'!Bien hecho!',
            'text'=>' Subcategoria  creada correctamente.'
        ]);
        */
        //disparo un evento para la session de tipo livewire se  encuentra en layouts.partials.admin
            $this->dispatch('swal',[
                'icon'=>'success',
                'title'=>'!Bien hecho!',
                'text'=>' Subcategoria  creada correctamente.']);

    }
}
