<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'city',
        'state',
        'type',
        'country',
        'phone',
        'default',
        'description',
        'district',
        'reference',
        'receiver',
        'receiver_info',];


    // para guardar/obtener el valor del registro receiver_info de tipo json, es necesario, castearlo, evitando las conversiones de json
    protected $casts = [
        // el valor de receiver_info se almacena en json pero se obtiene como array
        'receiver_info' => 'array',
        // default almacena valores enteros en la bd:
        // default == true => 1 (dirreccion establecida) en bd, caso contrario default == false => 0 (direccion no establecida)
        // pero se obtiene como boolean
        'default' => 'boolean',
    ];


}
