<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FamilyRequest;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //OBTENGO LOS ULTIMOS 10 OBJETOS RECIEN CREADOS
        $families=Family::orderBy('id','desc')->paginate(10);

        return view('admin.families.index',compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        return view('admin.families.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FamilyRequest $unFamiliaRequest)
    {
        //muestro los datos recibidos
        //return $request->all();

        Family::create(['name'=>$unFamiliaRequest['name']]);
        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'!Bien hecho!',
            'text'=>' Familia '.$unFamiliaRequest['name'].' creada correctamente.'
        ]);
        return redirect()->route('admin.families.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        //
        return view('admin.families.edit', compact('family'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FamilyRequest $unFamiliaRequest, Family $family)
    {
        //verifico los datos y almaceno
      //  return "estoy en familia".$request->name();

        $family->update($unFamiliaRequest->all());
        //session()-> es la accion (o ejecucion) de @if (session('swal')) en admin.blade.php
        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'!Bien hecho!',
            'text'=>' Familia '.$family->name().' actualizada correctamente.'
        ]);
        return redirect()->route('admin.families.index',$family);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        if($family->categories()->count()>0){
            session()->flash('swal',[
                'icon'=>'error',
                'title'=>'Ups!',
                'text'=>'No se puede eliminar la familia: '.$family->name().' porque tiene al menos una categoria asociada, para borrar una familia, debe eliminar todas las categorias de esa familia',

            ]);
            return redirect()->route('admin.families.edit',$family);


        }else{

            $family->delete();
            session()->flash('swal',[
                'icon'=>'success',
                'title'=>'!Bien hecho!',
                'text'=>' Familia '.$family->name().' eliminada correctamente.'
            ]);
            return redirect()->route('admin.families.index');
        }






    }
}
