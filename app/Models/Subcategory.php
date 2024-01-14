<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Subcategory extends Model
{
    use HasFactory;
    protected $guarded=[];


    //relacion (inversa) de  Categoria (1) a SubCategorias (m)
    public function category():BelongsTo{
        return $this->belongsTo(Category::class);

    }

    // relacion de Subcategory (1) a Productos (m)
    public function product():HasMany{
        return $this->hasMany(Product::class);

    }
}
