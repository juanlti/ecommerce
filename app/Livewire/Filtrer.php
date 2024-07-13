<?php

namespace App\Livewire;

use App\Models\Family;
use App\Models\Option;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Filtrer extends Component
{

    //utilizo WithPagination para poder paginar los resultados
    use WithPagination;
    public $family;
    public $options;


    public function mount()
    {
        //buscar las opciones de la familia en multiples tablas
        $this->options = Option::whereHas('products.subcategory.category', function ($query) {
            // realizo una busqueda con filtros en las relaciones (join), comenzado en la tabla products relacionado con .subcategories y relacionado con .categories.
            // y en categories verifico que exista un family_id que sea igual al id de la familia que estoy consultando
            //hereHas('nombreDeLaTablaAconsultar',function($query){
            $query->where('family_id', $this->family->id);
        })->with([
            'features' => function ($query) {
                // comienza en la tabla features => variants (tabla) ===(relacion inversa)==> productos (tabla) ===(relacion inversa)===> subcategory (tabla) ===(relacion inversa)===> category (tabla) ===(relacion inversa)===> family (tabla)
                $query->whereHas('variants.product.subcategory.category', function ($query) {
                    $query->where('family_id', $this->family->id);
                });
            }
        ])->get();


    }

    public function render()

    {
        //LIVEWIRE SE ENCUENTRA LIMITADO A LA HORA DE OBTENER MUCHOS DATOS EN VARIABLES, POR LO QUE SE DEBE UTILIZAR  EN EL METODO RENDER() PARA EVITAR PERDIDA DE INFORMACION
        //buscar los productos que pertenezcan a una familia con familia_id
        $allProducts = Product::whereHas('subcategory.category', function ($query) {
            //inicio en products, hago la consulta de manera secuencial en: subcategory => category, y en category verifico que exista un family_id que sea igual al id de la familia que estoy consultando
            // function ($query) es una funcion anonima,y obtenemos en $query la consulta de la tabla category
            $query->where('family_id', $this->family->id);


        })->paginate(6);
        return view('livewire.filtrer', compact('allProducts'));
    }
}
