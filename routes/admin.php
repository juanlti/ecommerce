<?php
use Illuminate\Support\Facades\Route;

//RUTAS DEL ADMIN


Route::get('/directo',function(){
    return "Hola desde una ruta admin";
})->name('dashboard');
