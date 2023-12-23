<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Option extends Model
{
    use HasFactory;
    protected $guarded=['id','timestamps'];



    //Relacion (INVERSA) Opciones (m) a Productos (m)
    // MUCHOS A MUCHOS
    public function products():BelongsToMany{

    return $this->belongsToMany(Product::class)->whithPivot('value')->withTimestamps();



    }
    //Relacion de Opcion (1) a Feature (m)
    //ejemplo: si existen una campera, en la tabla Opcion, se guarda "talla" y en la tabla Feature se almcena el talle
    //opcion-> talle y feature -> numero de talle
    public function features():HasMany{
        return $this->hasMany(Feature::class);

    }




}
