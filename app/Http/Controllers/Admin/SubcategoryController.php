<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subcategories=Subcategory::orderBy('id','desc')
            ->with('category.family')
            ->paginate(10);

        //            ->with('category.family') OBTENGO EN EL OBJETO CATEGORIA, Y OBJETO FAMILIA POR CADA SUBCATEGORIA CORRESPONDIENTE
        // POR CADA CONSULTA DE SUBCATEGORIA, ES DECIR : 1 CONSULTA EQUIVALE A 3 CONSULTAS
       // return $subcategories->all();
        return view('admin.subcategories.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $categories=Category::all();

        return view('admin.subcategories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubcategoryRequest $requestSubcategory)
    {
        //
        Subcategory::create($requestSubcategory->all());

        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'!Bien hecho!',
            'text'=>' Subcategoria '.$requestSubcategory['name'].' creada correctamente.'
        ]);

        return redirect()->route('admin.subcategories.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        //
    }
}
