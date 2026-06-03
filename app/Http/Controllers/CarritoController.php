<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function mostrar($id_cliente)
    {
        $carrito = Carrito::with('detalles_carrito.producto')
                            ->where('id_cliente', $id_cliente)
                            ->first();
        
        return view('Carrito.carrito', compact('carrito'));
    }

    public function agregar(Request $request)
    {
        $request->validate([
            'id_productos' => 'required',
            'cantidad' => 'required|integer|min:1'
        ]);

        $id_cliente = auth()->guard('web')->user()->id_cliente;

        $carrito = Carrito::firstOrCreate(
            [
                'id_cliente' => $id_cliente,
            ],
            [
                'subtotal' => 0,
            ]
        );

        $producto = Producto::findOrFail($request->id_productos);
        $precioUnitario = $producto->precio;
        $cantidadNueva = $request->cantidad;

        $detalle = DetalleCarrito::where('id_carrito', $carrito->id_carrito)
                                    ->where('id_productos', $request->id_productos)
                                    ->first();

        if($detalle)
        {
            $detalle->cantidad += $cantidadNueva;
            $detalle->subtotal = $detalle->cantidad * $precioUnitario;
            $detalle->save();
        }
        else
        {
            DetalleCarrito::create([
                'id_carrito' => $carrito->id_carrito,
                'id_productos' => $request->id_productos,
                'cantidad' => $cantidadNueva,
                'subtotal' => $cantidadNueva * $precioUnitario
            ]);
        }

        $subtotalGeneral = DetalleCarrito::where('id_carrito', $carrito->id_carrito)->sum('subtotal');

        $carrito->update(['subtotal' => $subtotalGeneral]);

        return redirect()->route('productos')->with('success', 'Producto agregado al carrito');
    }

    public function agregarUno(Request $request, $id_carrito)
    {
        $detalle = DetalleCarrito::where('id_carrito', $id_carrito)
                                    ->where('id_productos', $request->id_productos)
                                    ->first();

        $producto = Producto::findOrFail($request->id_productos);

        $detalle->cantidad++;
        $detalle->subtotal += $producto->precio;
        $detalle->save();

        $subtotalGeneral = DetalleCarrito::where('id_carrito', $id_carrito)->sum('subtotal');

        $carrito = Carrito::findOrFail($id_carrito);
        $carrito->update(['subtotal' => $subtotalGeneral]);

        return redirect()->back();
    }

    public function quitarUno(Request $request, $id_carrito)
    {
        $detalle = DetalleCarrito::where('id_carrito', $id_carrito)
                                    ->where('id_productos', $request->id_productos)
                                    ->first();

        $producto = Producto::findOrFail($request->id_productos);

        $detalle->cantidad--;
        $detalle->subtotal -= $producto->precio;
        $detalle->save();

        $subtotalGeneral = DetalleCarrito::where('id_carrito', $id_carrito)->sum('subtotal');

        $carrito = Carrito::findOrFail($id_carrito);
        $carrito->update(['subtotal' => $subtotalGeneral]);

        return redirect()->back();
    }

    public function eliminarDetalle(Request $request, $detalle)
    {
        $detalleCarrito = DetalleCarrito::findOrFail($detalle);
        $detalleCarrito->delete();

        $subtotalGeneral = DetalleCarrito::where('id_carrito', $request->id_carrito)->sum('subtotal');

        $carrito = Carrito::findOrFail($request->id_carrito);
        $carrito->update(['subtotal' => $subtotalGeneral]);

        return redirect()->back();
    }
}
