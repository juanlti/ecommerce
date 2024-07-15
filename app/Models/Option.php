<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Option extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'id'];


    // optiones de la familia

    public function scopeVerifyFamily($query, $family_id)
    {
        //$query contiene la consulta que se esta realizando
        //$family_id es el valor que recibo por parametro, a ese mismo lo vuelvo a pasar como parametro para que sea usando en la consutta
        $query->when($family_id, function ($query, $family_id) {
            $query->whereHas('products.subcategory.category', function ($query) use ($family_id) {
                // realizo una busqueda con filtros en las relaciones (join), comenzado en la tabla products relacionado con .subcategories y relacionado con .categories.
                // y en categories verifico que exista un family_id que sea igual al id de la familia que estoy consultando
                //hereHas('nombreDeLaTablaAconsultar',function($query){
                $query->where('family_id', $family_id);
            })->with([
                'features' => function ($query) use ($family_id) {
                    // comienza en la tabla features => variants (tabla) ===(relacion inversa)==> productos (tabla) ===(relacion inversa)===> subcategory (tabla) ===(relacion inversa)===> category (tabla) ===(relacion inversa)===> family (tabla)
                    $query->whereHas('variants.product.subcategory.category', function ($query) use ($family_id) {
                        $query->where('family_id', $family_id);
                    });
                }
            ]);
        });

    }

    public function scopeVerifyCategory($query, $category_id)
    {
        //$query contiene la consulta que se esta realizando
        //$category_id es el valor que recibo por parametro, a ese mismo lo vuelvo a pasar como parametro para que sea usando en la consutta
        // y verifica que el valor de $category_id sea no nulo
        $query->when($category_id, function ($query, $category_id) {
            $query->whereHas('products.subcategory', function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
                // realizo una busqueda con filtros en las relaciones (join), comenzado en la tabla products relacionado con .subcategories.
                // y en subcategories verifico que exista un category_id que sea igual al id de la categoria que estoy consultando
            })->with([
                'features' => function ($query) use ($category_id) {
                    // comienza en la tabla features => variants (tabla) ===(relacion inversa)==> productos (tabla) ===(relacion inversa)===> subcategory (tabla) ===(relacion inversa)===> category (tabla) ===(relacion inversa)===> family (tabla)
                    $query->whereHas('variants.product.subcategory', function ($query) use ($category_id) {
                        $query->where('category_id', $category_id);
                    });
                }
            ]);
        });
    }


    public function scopeVerifySubcategory($query, $subcategory_id)
    {
        $query->when($subcategory_id, function ($query) use ($subcategory_id) { // Corregido: Añadido paréntesis de cierre
            $query->whereHas('products', function ($query) use ($subcategory_id) { // Corregido: Añadido "use ($subcategory_id)"
                $query->where('subcategory_id', $subcategory_id);
                // realizo una busqueda con filtros en las relaciones (join), comenzado en la tabla products relacionado con .subcategories.
                // y en subcategories verifico que exista un category_id que sea igual al id de la categoria que estoy consultando
            })->with([
                'features' => function ($query) use ($subcategory_id) {
                    // comienza en la tabla features => variants (tabla) ===(relacion inversa)==> productos (tabla) ===(relacion inversa)===> subcategory (tabla) ===(relacion inversa)===> category (tabla) ===(relacion inversa)===> family (tabla)

                    $query->whereHas('variants.product.subcategory', function ($query) use ($subcategory_id) {
                        $query->where('subcategory_id', $subcategory_id); // Corregido: Cambiado 'category_id' por 'subcategory_id'
                    });
                }
            ]);
        });
    }
    // fin de las opciones de familia


    //Relacion (INVERSA) Opciones (m) a Productos (m)
    // MUCHOS A MUCHOS
    public function products(): BelongsToMany
    {
        //using(OptionProduct::class) => lo convierte a json al momento de guardarlo/consultarlo utilizando eloquent
        return $this->belongsToMany(Product::class)->using(OptionProduct::class)->withPivot('features')->withTimestamps();


    }
    //Relacion de Opcion (1) a Feature (m)
    //ejemplo: si existe una campera, en la tabla Opcion, se guarda "talla" y en la tabla Feature se almacena los diferentes talles
    //opcion-> talle y feature -> numero de talle
    public function features(): HasMany
    {
        return $this->hasMany(Feature::class);

    }

    public function name(): string
    {
        return $this->name;
    }


}
