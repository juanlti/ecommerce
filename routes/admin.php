<?php
use Illuminate\Support\Facades\Route;

//RUTAS DEL ADMIN


Route::get('/',function(){
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/otro',function(){
    return view('admin.otro');
})->name('otro');

