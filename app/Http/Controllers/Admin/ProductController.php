<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // retorna una vista con los productos

        //$products=Product::paginate();
        $products = Product::orderBy('id', 'desc')->paginate();
        // $products=null;
        return view('admin.products.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //retorna la vista para crear un objeto de tipo producto
        return view('admin.products.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // retorna a la vista
        return view('admin.products.edit', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        //dd('estoy en destroy'.$product);

        // 1 elimino la imagen
        \Illuminate\Support\Facades\Storage::delete($product['image_path']);
        //elimino el producto de la bd
        $product->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho',
            'text' => 'El producto se elimino correctamente']);
        return redirect()->route('admin.products.index');


    }

    public function variants(Product $product, Variant $variant)
    {
        // retorna la vista con las variantes de un producto
        //return "Producto : .$product. y sus variantes .$variant";
        if ($variant == null) {
            return "no hay informacion de variantes";
        } else {

            return view('admin.products.variants', compact('product', 'variant'));
        }

    }

    //Request obtengo la informacion del front (usuario)
    public function variantsUpadate(Request $request, Product $products, Variant $variant)
    {
        //return $request->all();

        $data = $request->validate([
            'image' => 'nullable|image|max:1024',
            'sku' => 'required',
            'stock' => 'required|min:0|numeric'


        ]);
        //dd($request->all());
        // si llega una imagen, borro la anterior para guardar la nueva (ultima)
        if ($request->image) {
            //dd($this->productEdit['image_path']);
            // Borra la imagen original
            if ($variant->image_path) {
                Storage::delete($variant->image_path);

            }
            $rutaImagenUltima = $request->image->store('public/products');
            $data['image_path'] = $rutaImagenUltima;

            //dd('despues de borrar');
            // Guarda la imagen actualizada
            $rutaImagenUltima = $request->image->store('public/products');
            //$data['image_path'] = le agrego un campo extra, llamado 'image_path' para guardar la imagen

            $data['image_path'] = $rutaImagenUltima;
        }
        $variant->update($data);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho',
            'text' => 'La variante se actualizo correctamente'
        ]);


        return redirect()->route('admin.products.variants', ['product' => $products, 'variant' => $variant]);
    }
}
