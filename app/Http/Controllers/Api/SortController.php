<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cover;

class SortController extends Controller
{
    public function covers(Request $request)
    {
        //almacena el nuevo orden en la base de datos.

        $sortsCovers = $request->get('newOrderSortsCovers');

        if (is_array($sortsCovers)) {
            $order = 1;
            foreach ($sortsCovers as $sortCover) {
                $cover = Cover::find($sortCover);
                if ($cover) {


                    $cover->order = $order;
                    $cover->save();
                    $order++;
                }
            }
            //mensaje de respuesta
            return response()->json(['message' => 'actualizacion de orden exitosa'], 200);

        } else {
            return response()->json(['error' => 'Error de entrada'], 400);
        }

    }
}
