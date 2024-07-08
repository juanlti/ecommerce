<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Cover extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'title', 'start_at', 'end_at', 'is_active'];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_active' => 'boolean',];

    //acceso para obtener la url de la imagen
    protected function image(): Attribute{
        return Attribute::make(get: fn() => Storage::url($this->image_path));}
}
