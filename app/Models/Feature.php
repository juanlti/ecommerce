<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feature extends Model
{
    use HasFactory;
protected $guarded=[];


// relacion (inversa) Options (1) a  Features(m)
public function feature():BelongsTo{
    return $this->belongsTo(Option::class);

}
}
