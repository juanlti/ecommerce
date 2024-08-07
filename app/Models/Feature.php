<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    use HasFactory;
    protected $fillable=['value','description','option_id','id'];
    public $timestamps=false;
    //protected $primaryKey='id';



// relacion (inversa) Options (1) a  Features(m)
public function options():BelongsToMany{
    return $this->belongsToMany(Option::class);

}

//relacion (inversa) Variants  (m) a Feature (m)
public function variants():belongsToMany{
return $this->belongsToMany(Variant::class)->withTimestamps();
}
}
