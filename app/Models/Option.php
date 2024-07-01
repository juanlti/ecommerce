<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type','id'];


    //Relacion (INVERSA) Opciones (m) a Productos (m)
    // MUCHOS A MUCHOS
    public function products(): BelongsToMany
    {
        //using(OptionProduct::class) => lo convierte a json al momento de guardarlo/consultarlo utilizando eloquent
        return $this->belongsToMany(Product::class)->using(OptionProduct::class)->whithPivot('features')->withTimestamps();


    }
    //Relacion de Opcion (1) a Feature (m)
    //ejemplo: si existe una campera, en la tabla Opcion, se guarda "talla" y en la tabla Feature se almacena los diferentes talles
    //opcion-> talle y feature -> numero de talle
    public function features(): HasMany
    {
        return $this->hasMany(Feature::class);

    }

    public function name():String
    {
        return $this->name;
    }


}
