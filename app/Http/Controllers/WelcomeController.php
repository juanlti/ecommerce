<?php

namespace App\Http\Controllers;
use App\Models\Cover;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //

    public function index(){
        //obtener todas las portas que esten activas
        $coversAllActive=Cover::where('is_active',true)->get();

        //obtener las portadas que estan activas y que la fecha de inicio sea menor o igual a la fecha actual.
        //obtener la zona horaria de Argentina/buenos aires de UTC, realizo la siguiente configuracion:
        //config/app.php 'timezone' => 'America/Argentina/Buenos_Aires',
        //$coversAllActive=Cover::where('is_active',true)->whereDate('start_at','<=',now())->get();

        //obtener todas las portdas activas, la fecha de inicio sea menor o igual a la actual, y que la fecha de fin sea mayor, o igual que la fecha actual, o null
        $coversAllActive=Cover::where('is_active',true)->whereDate('start_at','<=',now())->where(function ($query){
            $query->whereDate('end_at','>=',now())->orWhereNull('end_at');
        })->get();

        $lastProducts=Product::orderBy('created_at','desc')->take(12)->get();

       return view('welcome',compact('coversAllActive','lastProducts'));
    }
}
