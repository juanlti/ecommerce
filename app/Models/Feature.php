<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    use HasFactory;
    protected $guarded=['id','timestamps'];


// relacion (inversa) Options (1) a  Features(m)
public function feature():BelongsTo{
    return $this->belongsTo(Option::class);

}

//relacion (inversa) Variants  (m) a Feature (m)
public function variants():BelongsToMany{
return $this->belongsToMany(Variant::class)->withTimestamps();
}
}
