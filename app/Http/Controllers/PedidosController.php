<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Pedidos;
use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    public function confirmarPedido(Request $request)
    {
        // Martin 01/06/2026: obtener el cliente autenticado
        $cliente = auth()->guard('web')->user();

        // Martin 01/06/2026: buscar el carrito activo *pendiente* del cliente
        $carrito = Carrito::where('id_cliente', $cliente->id_cliente)
                          ->where('status', 'pendiente')
                          ->with('detalles_carrito')
                          ->first();
        // Martin 01/06/2026: por si el carrito está vacío
        if (!$carrito || $carrito->detalles_carrito->isEmpty()) {
            return redirect()->back()->with('error', 'Tu carrito está vacío.');
        }

        // Martin 01/06/2026: transacción para asegurar que si algo falla, no se guarde incompleto
        DB::beginTransaction();

        try {
            // Martin 01/06/2026: crear el nuevo Pedido
            $pedido = new Pedidos();
            $pedido->id_carrito = $carrito->id_carrito;
            $pedido->fecha_compra = now();
            $pedido->total = $carrito->subtotal; // Martin 01/06/2026: subtotal del carrito = total
            $pedido->status = 'pendiente'; // Martin 01/06/2026: esto se cambiará después con el admin
            $pedido->save();

            // Martin 01/06/2026: pasar los detalles del carrito al detalle del pedido y descontar stock
            foreach ($carrito->detalles_carrito as $detalle) {
                // Martin 01/06/2026: crear detalle del pedido
                DetallePedido::create([
                    'id_pedido' => $pedido->id_pedido,
                    'id_productos' => $detalle->ID_Productos,
                    'cantidad' => $detalle->cantidad,
                    'subtotal' => $detalle->subtotal // Martin 01/06/2026: cambio por -subototal-
                ]);

                // Martin 01/06/2026: descontar stock del producto
                $producto = Producto::find($detalle->ID_Productos);
                if ($producto->stock >= $detalle->cantidad) {
                    $producto->stock -= $detalle->cantidad;
                    $producto->save();
                } else {
                    // Martin 01/06/2026: si no hay stock suficiente, lanza error y se revierte todo
                    throw new \Exception('No hay stock suficiente para el producto: ' . $producto->nombre);
                }
            }

            // Martin 01/06/2026: cambiar el status del carrito para cerrarlo
            $carrito->status = 'completado';
            $carrito->save();

            DB::commit(); // Martin 01/06/2026: guarda en la base de datos

            return redirect()->route('productos')->with('success', '¡Pedido confirmado!');

        // Martin 01/06/2026: si algo falló, deshace los cambios
        } catch (\Exception $e) {
            DB::rollBack(); 
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}