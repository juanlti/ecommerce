<?php

namespace App\Livewire;

use App\Models\Family;
use App\Models\Option;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Filtrer extends Component
{

    //utilizo WithPagination para poder paginar los resultados
    use WithPagination;

    public $family_id;
    public $options;
    public $selected_features = [];
    public $orderBy = 1;
    public $searchTerm;
    public $category_id;

    public $subcategory_id;


    public function mount()
    {
        // scopeVerifyCategory  scopeVerifySubcategory  scopeVerifyFamily
        //si existe un valor en $this->family_id, entonces ejecuto la funcion scopeVerifyFamily
        $this->options = Option::VerifyFamily($this->family_id)
            ->VerifyCategory($this->category_id)
            ->VerifySubcategory($this->subcategory_id)
            ->get()->toArray();
    }

    /*
        ->when($this->category_id, function ($query) {
            $query->whereHas('products.subcategory', function ($query) {
                $query->where('category_id', $this->category_id);
                // realizo una busqueda con filtros en las relaciones (join), comenzado en la tabla products relacionado con .subcategories.
                // y en subcategories verifico que exista un category_id que sea igual al id de la categoria que estoy consultando
            })->with([
                'features' => function ($query) {
                    // comienza en la tabla features => variants (tabla) ===(relacion inversa)==> productos (tabla) ===(relacion inversa)===> subcategory (tabla) ===(relacion inversa)===> category (tabla) ===(relacion inversa)===> family (tabla)
                    $query->whereHas('variants.product.subcategory', function ($query) {
                        $query->where('category_id', $this->category_id);
                    });
                }
            ]);
        })
        ->when($this->subcategory_id, function ($query) {
            $query->whereHas('products', function ($query) {
                $query->where('subcategory_id', $this->category_id);
                // realizo una busqueda con filtros en las relaciones (join), comenzado en la tabla products relacionado con .subcategories.
                // y en subcategories verifico que exista un category_id que sea igual al id de la categoria que estoy consultando
            })->with([
                'features' => function ($query) {
                    // comienza en la tabla features => variants (tabla) ===(relacion inversa)==> productos (tabla) ===(relacion inversa)===> subcategory (tabla) ===(relacion inversa)===> category (tabla) ===(relacion inversa)===> family (tabla)
                    $query->whereHas('variants.product.subcategory', function ($query) {
                        $query->where('category_id', $this->category_id);
                    });
                }
            ]);
        })
        ->get()->toArray();

}
/*


->when($this->category_id, function ($query) {
    $query->whereHas('products.subcategory', function ($query) {
        $query->where('category_id', $this->category_id);
        // realizo una busqueda con filtros en las relaciones (join), comenzado en la tabla products relacionado con .subcategories.
        // y en subcategories verifico que exista un category_id que sea igual al id de la categoria que estoy consultando
    })->whith([
        'features' => function ($query) {
            // comienza en la tabla features => variants (tabla) ===(relacion inversa)==> productos (tabla) ===(relacion inversa)===> subcategory (tabla) ===(relacion inversa)===> category (tabla) ===(relacion inversa)===> family (tabla)
            $query->whereHas('variants.product.subcategory.category', function ($query) {
                $query->where('family_id', $this->family_id);
            });
        }
    ]);
})
    ->get()->toArray();
/*
//buscar las opciones de la familia en multiples tablas
$this->options = Option::whereHas('products.subcategory.category', function ($query) {
    // realizo una busqueda con filtros en las relaciones (join), comenzado en la tabla products relacionado con .subcategories y relacionado con .categories.
    // y en categories verifico que exista un family_id que sea igual al id de la familia que estoy consultando
    //hereHas('nombreDeLaTablaAconsultar',function($query){
    $query->where('family_id', $this->family_id);
})->with([
    'features' => function ($query) {
        // comienza en la tabla features => variants (tabla) ===(relacion inversa)==> productos (tabla) ===(relacion inversa)===> subcategory (tabla) ===(relacion inversa)===> category (tabla) ===(relacion inversa)===> family (tabla)
        $query->whereHas('variants.product.subcategory.category', function ($query) {
            $query->where('family_id', $this->family_id);
        });
    }
])->get()->toArray();
*/


    /*
    public function render(): \Illuminate\View\View

    {
        //LIVEWIRE SE ENCUENTRA LIMITADO A LA HORA DE OBTENER MUCHOS DATOS EN VARIABLES, POR LO QUE SE DEBE UTILIZAR  EN EL METODO RENDER() PARA EVITAR PERDIDA DE INFORMACION
        //buscar los productos que pertenezcan a una familia con familia_id
        $allProducts = Product::whereHas('subcategory.category', function ($query) {
            //inicio en products, hago la consulta de manera secuencial en: subcategory => category, y en category verifico que exista un family_id que sea igual al id de la familia que estoy consultando
            // function ($query) es una funcion anonima,y obtenemos en $query la consulta de la tabla category
            $query->where('family_id', $this->family_id);

            //creo una consulta  para obtener los productos que tengan las opciones selecionadas, y los features seleccionados
            //utilizo  el metodo when

        })->when($this->selected_features, function ($query) {
            // productsSelecions es un array que contiene los productos que tienen las opciones seleccionadas, y obtengo las variants
            $query->whereHas('variants.features', function ($query) {
                //comienzo en variants, y obtengo las features.
                //en features verifico que exista un id que sea igual a los features seleccionados
                $query->whereIn('features.id', $this->selected_features);
            });

        })->paginate(6);
        return view('livewire.filtrer', compact('allProducts'));
    }
    */
    public function render(): \Illuminate\View\View
    {
        // Limpiar $this->selected_features para eliminar valores duplicados y asegurar que solo contenga valores únicos
        $selectedFeaturesCleaned = array_unique(array_filter($this->selected_features));

        // Realizar la consulta principal con condiciones optimizadas
        $allProducts = Product::VerifyFamily($this->family_id)
            ->VerifyCategory($this->category_id)
            ->VerifySubcategory($this->subcategory_id)
            //scopeCustomOrder scopeSelectFeatures
            ->CustomOrder($this->orderBy)
            ->SelectFeatures($this->selected_features)
            ->when($this->searchTerm, function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->paginate(6);
//                // Ejecutar esta parte de la consulta solo si hay características seleccionadas después de la limpieza
        return view('livewire.filtrer', compact('allProducts'));
    }


    #[On('search')]
    public function search($search)
    {

        $this->searchTerm = $search;
        // Aquí puedes realizar la búsqueda basada en $this->searchTerm

    }


}
