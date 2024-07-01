<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\admin\SubcategoryController;
use App\Http\Controllers\admin\OptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
//RUTAS DEL ADMIN


Route::get('/',function(){
    return view('admin.dashboard');
})->name('dashboard');
/*
Route::get('/',function(){
    return view('admin.otro');
})->name('otro');
*/

Route::get('/options',[OptionController::class,'index'])->name('options.index');

Route::resource('families',FamilyController::class);
Route::resource('categories',CategoryController::class);
Route::resource('subcategories',SubcategoryController::class);
Route::resource('products',ProductController::class);
Route::get('products/{product}/variants/{variant}',[ProductController::class,'variants'])
    ->name('products.variants')
    ->scopeBindings();
// el idProducto=100. y la relacion idVariant=81 (correcto).
//para evitar el problema de un producto con un id diferente.
// ejemplo del problema: http://127.0.0.1:8000/admin/products/100/variants/55 -> utilizo la siguiente funcion
//->scopeBindings(); al final de la ruta, garantizando de que exista una relacion previa entre unProducto y su variante.
