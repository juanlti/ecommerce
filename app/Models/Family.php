<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    use HasFactory;

    protected $guarded=['timestamps'];

//relacion de Familia (1)  a Categorias (m)
public function categories():HasMany{
    return $this->hasMany(Category::class);
}

    public function name()
    {
        return $this->name;
    }
}
