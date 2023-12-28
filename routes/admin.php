<?php

use App\Http\Controllers\Admin\FamilyController;
use Illuminate\Support\Facades\Route;

//RUTAS DEL ADMIN


Route::get('/',function(){
    return view('admin.dashboard');
})->name('dashboard');
/*
Route::get('/',function(){
    return view('admin.otro');
})->name('otro');
*/
Route::resource('families',FamilyController::class);
