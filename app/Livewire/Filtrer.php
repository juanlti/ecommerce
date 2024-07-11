<?php

namespace App\Livewire;

use App\Models\Family;
use App\Models\Option;
use Livewire\Component;

class Filtrer extends Component
{

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
            'features' => function ($query){
                // comienza en la tabla features => variants (tabla) ===(relacion inversa)==> productos (tabla) ===(relacion inversa)===> subcategory (tabla) ===(relacion inversa)===> category (tabla) ===(relacion inversa)===> family (tabla)
                $query->whereHas('variants.product.subcategory.category', function ($query) {
                    $query->where('family_id', $this->family->id);
                });
            }
        ])->get();





    }

    public function render()
    {
        return view('livewire.filtrer');
    }
}
