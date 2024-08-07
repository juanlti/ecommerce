<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'family_id',
        'id'
    ];

    public function name(){
        return $this->name;
    }

    //relacion (inversa) de Familia (1)  a Categorias (m)
    //una/s categoria pertenece a una familia
    public function family():BelongsTo{
        return $this->belongsTo(Family::class);
    }

    //relacion de Category (1) a SubCategory (m)
    public function subcategory():HasMany{

        return $this->hasMany(Subcategory::class);
    }

}
