<?php


use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShippingController;
use Gloudemans\Shoppingcart\Facades\Cart;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class,'index'])->name('welcome.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('prueba', function () {
    /*
    $combinacion1 = ['a', 'b', 'c'];
    $combinacion2 = ['a', 'b', 'c'];
    $combinacion3 = ['a', 'b', 'c'];

    $todasLasCombionaciones = [$combinacion1, $combinacion2, $combinacion3];
    $todasLasCombionaciones = generarCombinaciones($todasLasCombionaciones,);
    return $todasLasCombionaciones;
    */

        $productoSelecionado = Product::find(100);
        //dd($productoSelecionado);
        $featureProductoSelecionado = $productoSelecionado->options->pluck('pivot.features');
    //dd($featureProductoSelecionado);
        // variantas de un producto seleccionado
        //dd( ($featureProductoSelecionado->toArray()));
        $todasLasCombinaciones = generarCombinaciones($featureProductoSelecionado);
        // elimino las variantes anteriores, y las vuelvo a crear sumando las actuales
        $productoSelecionado->variant()->delete();
        foreach ($todasLasCombinaciones as $unaCombinacion) {
            $unaVarianteDelProductoSelecionado = Variant::create([
                'product_id' => $productoSelecionado->id,
            ]);

            // Uso correcto del método attach
            $unaVarianteDelProductoSelecionado->features()->attach($unaCombinacion);
        }

        return "Variante creada con exito";
    });

function generarCombinaciones($arrays, $indice = 0, $combinacion = [])
{

    if ($indice == count($arrays)) {
        return [$combinacion];
    }
    $resultado = [];
    foreach ($arrays[$indice] as $item) {
        $combinacionesTemporal = $combinacion;//['a','a']
        // @var_dump($item);
        $combinacionesTemporal[] = $item['id']; //['a','a','a']
       // var_dump($combinacionesTemporal);
        //  @var_dump($combinacionesTemporal);
        //combinacion de un solo array en un resultado final
        $resultado = array_merge($resultado, generarCombinaciones($arrays, $indice + 1, $combinacionesTemporal));


    }
    return $resultado;

}
Route::get('families/{family}',[FamilyController::class,'show'])->name('famiy.show');
Route::get('categories/{category}',[CategoryController::class,'show'])->name('categories.show');
Route::get('subcategories/{subcategory}',[SubcategoryController::class,'show'])->name('subcategories.show');
Route::get('products/{product}',[ProductController::class,'show'])->name('products.show');
Route::get('pruebaCarritoShoppingCart',function(){
    // Duggear contenido
    //declaro la instnacia, en este caso es la instancia shopping y solicito que retorne su contenido
    Cart::instance('shopping');
    return Cart::content();
});
Route::get('cart',[CartController::class,'index'])->name('cart.index');
Route::get('shipping',[ShippingController::class,'index'])->name('shipping.index');

