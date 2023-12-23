<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded=['id','timestamps'];


    //relacion (inversa)  Subcategory (1) a Category (m)
    public function subcategory():BelongsTo{
        return $this->belongsTo(Subcategory::class);
    }


    // relacion de Products (1) a Feature (m)
    public function variant():HasMany{
        return $this->hasMany(Variant::class);
    }

    // relacion de Products (m) a Opciones (m)
    public function options(){
        return $this->belongsToMony(Option::class)->withPivot('value')->withTimestamps();
        // con el metodo ->withPivot('value'); obtengo el valor de "value" al momento de realizar
        // con el metodo -> withTimestamps(), actualizo a la ultima fecha
    }


}
