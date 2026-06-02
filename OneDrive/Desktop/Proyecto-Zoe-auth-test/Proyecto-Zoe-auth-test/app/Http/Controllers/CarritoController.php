<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    // Martin 01/06/2026: mostrar la vista del carrito con los productos
    public function mostrar()
    {
        $cliente = auth()->guard('web')->user();
        
        // Martin 01/06/2026:buscar el carrito pendiente y cargar sus detalles y el producto asociado
        $carrito = Carrito::where('id_cliente', $cliente->id_cliente)
                          ->where('status', 'pendiente')
                          ->with('detalles_carrito.producto') 
                          ->first();

        return view('Carrito.carrito', compact('carrito'));
    }

    // Martin 01/06/2026: agregar un producto al carrito
    public function agregar($producto_id)
    {
        $cliente = auth()->guard('web')->user();
        $producto = Producto::findOrFail($producto_id);

        // Martin 01/06/2026: buscar carrito activo o crear uno nuevo
        $carrito = Carrito::firstOrCreate(
            ['id_cliente' => $cliente->id_cliente, 'status' => 'pendiente'],
            ['fecha_Compra' => now(), 'subtotal' => 0]
        );

        // Martin 01/06/2026: verificar si el producto ya está en el detalle del carrito
        $detalle = DetalleCarrito::where('id_carrito', $carrito->id_carrito)
                                 ->where('ID_Productos', $producto->id_productos) //mayúsculas
                                 ->first();

        if ($detalle) {
            // Martin 01/06/2026: si ya existe, sumar 1 a la cantidad y actualizar el subtotal
            $detalle->cantidad += 1;
            $detalle->subototal = $detalle->cantidad * $producto->precio; //
            $detalle->save();
        } else {
            // Martin 01/06/2026: si no existe, crear un nuevo detalle
            DetalleCarrito::create([
                'id_carrito' => $carrito->id_carrito,
                'ID_Productos' => $producto->id_productos,
                'cantidad' => 1,
                'subototal' => $producto->precio
            ]);
        }

        // Martin 01/06/2026: recalcular el total general del carrito
        $carrito->subtotal = DetalleCarrito::where('id_carrito', $carrito->id_carrito)->sum('subototal');
        $carrito->save();

        return redirect()->route('carrito.mostrar');
    }
}