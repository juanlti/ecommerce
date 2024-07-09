<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CoverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $allCovers = Cover::orderBy('order')->get();
        return view('admin.covers.index',compact('allCovers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.covers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();

        $data = $request->validate([
            'title' => 'required|min:3|max:50',
            'image' => 'required|image|max:2048',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'is_active' => 'required|boolean',
        ]);
        // con el metodo store, se almacena la imagen en la carpeta covers.
        // y $data se agrega la asociacion de la ruta de la imagen, $data['image_path']
        $data['image_path'] = Storage::put('public/covers', $data['image']);


        // si la validacion es correcta, se procede a almacenar la informacion en la base de datos.
        $coverCreate = Cover::create($data);
        //dump($coverCreate);
        //mensaje e session

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '!Bien hecho!',
            'text' => ' La portada  se  ha creado correctamente.',

        ]);

        return redirect()->route('admin.covers.edit', $coverCreate);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cover $cover)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cover $cover)
    {

        return view('admin.covers.edit', compact('cover'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cover $cover)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:50',
            'image' => 'nullable|image|max:2048',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'is_active' => 'required|boolean',
        ]);

        if (isset($data['image'])) {
            //verifico que exista una imagen
            // eliminamos  la imgagen anterior
            Storage::delete($cover->image_path);
            // almacenamos la nueva imagen con su nueva ruta
            $data['image_path'] = Storage::put('public/covers', $data['image']);
        }
        //actualizamos  la portada  $instanciaAnterior->update($instanciaNueva);

        $cover->update($data);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '!Bien hecho!',
            'text' => ' La portada  se  ha actualizado correctamente.',

        ]);
        //dd($data);
        return redirect()->route('admin.covers.edit', $cover);


    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cover $cover)
    {
        //
    }
}
