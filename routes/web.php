<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

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
    $combinacion1 = ['a', 'b', 'c'];
    $combinacion2 = ['a', 'b', 'c'];
    $combinacion3 = ['a', 'b', 'c'];

    $todasLasCombionaciones = [$combinacion1, $combinacion2, $combinacion3];
    $todasLasCombionaciones = generarCombinaciones($todasLasCombionaciones,);
    return $todasLasCombionaciones;


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
        $combinacionesTemporal[] = $item; //['a','a','a']
      //  @var_dump($combinacionesTemporal);
        //combinacion de un solo array en un resultado final
        $resultado=array_merge($resultado,generarCombinaciones($arrays, $indice + 1, $combinacionesTemporal));



    }
    return $resultado;

}

