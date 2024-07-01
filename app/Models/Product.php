<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable=['name','slug','description','price','subcategory_id','image','option_id','id'];



    //relacion (inversa)  Subcategory (1) a Category (m)
    public function subcategory():BelongsTo{
        return $this->belongsTo(Subcategory::class);
    }


    // relacion de Products (1) a Feature (m)
    public function variants():HasMany{
        return $this->hasMany(Variant::class);
    }

    // relacion de Products (m) a Opciones (m)
    public function options():BelongsToMany{
        //using(OptionProduct::class) => lo convierte a json al momento de guardarlo/consultarlo utilizando eloquent
        return $this->belongsToMany(Option::class)->using(OptionProduct::class)->withPivot('features')->withTimestamps();
        // con el metodo ->withPivot('value'); obtengo el valor de "value" al momento de realizar
        // con el metodo -> withTimestamps(), actualizo a la ultima fecha
    }


}
