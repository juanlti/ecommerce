<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\Product;
use App\Models\Option;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Subcategory;

class FamilyController extends Controller
{
    //

    public function show(Family $family)
    {
        /*
        //buscar las opciones de la familia en multiples tablas
        $options = Option::whereHas('products.subcategory.category', function ($query) use ($family) {
            // realizo una busqueda con filtros en las relaciones (join), comenzado en la tabla products relacionado con .subcategories y relacionado con .categories.
            // y en categories verifico que exista un family_id que sea igual al id de la familia que estoy consultando
            //hereHas('nombreDeLaTablaAconsultar',function($query){
            $query->where('family_id', $family->id);
        })->with([
            'features' => function ($query) use ($family) {
                // comienza en la tabla features => variants (tabla) ===(relacion inversa)==> productos (tabla) ===(relacion inversa)===> subcategory (tabla) ===(relacion inversa)===> category (tabla) ===(relacion inversa)===> family (tabla)
                $query->whereHas('variants.product.subcategory.category', function ($query) use ($family) {
                    $query->where('family_id', $family->id);
                });
            }
        ])->get();

        return $options;

        $family = Family::find($family);
        */
        return view('families.show', compact('family'));

    }
}
