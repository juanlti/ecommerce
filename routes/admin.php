<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\admin\SubcategoryController;
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
Route::resource('families',FamilyController::class);
Route::resource('categories',CategoryController::class);
Route::resource('subcategories',SubcategoryController::class);
Route::resource('products',ProductController::class);
