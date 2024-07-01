<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Variant extends Model
{
    use HasFactory;
    protected $fillable=['name','price','stock','product_id','image_path','id'];



    //defino un metodo anonimo para retornar la instancia de una imagen
    public function image():Attribute{
        return Attribute::make(
            get: fn()=>$this->image_path ? Storage::url($this->image_path) : asset('img/imagen.jpg')
        );
    }
    // relacion (inversa) Products (1) a Variants (m)
    public function product():BelongsTo{
        return $this->belongsTo(Product::class);
    }


//relacion Variants  (m) a Feature (m)
    public function features():BelongsToMany{
        return $this->belongsToMany(Feature::class);
    }
}
