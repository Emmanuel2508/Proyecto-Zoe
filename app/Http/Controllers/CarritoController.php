<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregar($producto){
        $producto = Producto::find($producto);
        return response()->json([
            'id' => $producto->id_productos
        ]);
    }
}
