<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todasCategorias=Category::orderBy('id','desc')->paginate(10);

        return view('admin.categories.index',compact('todasCategorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $families=Family::all();

        return view('admin.categories.create',compact('families'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $unaCategoria)
    {
        // verifoco todo los parametros recibidos de Category Create
            //        return $unaCategoria->all();


        Category::create($unaCategoria->all());
        Family::create(['name'=>$unaCategoria['name']]);
        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'!Bien hecho!',
                'text'=>' Categoria '.$unaCategoria['name'].' creada correctamente.'
        ]);
    return redirect()->route('admin.categories.index');
        //verifo antes de guardar
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        $families=Family::all();

        return view('admin.categories.edit',compact('category','families'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $categoryRequest, Category $category)
    {


        $category->update($categoryRequest->all());
        //session()-> es la accion (o ejecucion) de @if (session('swal')) en admin.blade.php
        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'!Bien hecho!',
            'text'=>' Categoria '.$category->name().' actualizada correctamente.'
        ]);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
