<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Variant extends Model
{
    use HasFactory;
    protected $guarded=[];


    // relacion (inversa) Products (1) a Variants (m)
    public function product():BelongsTo{
        return $this->belongsTo(Product::class);
    }


//relacion Variants  (m) a Feature (m)
    public function features():HasMany{
        return $this->hasManyTo(Feature::class);
    }
}
