<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\Pedidos;
use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    public function mostrarPedidos()
    {
        $id_cliente = auth()->guard('web')->user()->id_cliente;
        $carrito = Carrito::where('id_cliente', $id_cliente)->first();
        $pedidos_pendientes = Pedidos::with('detalle_pedido.producto')
                                    ->where('id_carrito', $carrito->id_carrito)
                                    ->where('status', 'pendiente')
                                    ->get();

        $pedidos_completados = Pedidos::with('detalle_pedido.producto')
                                    ->where('id_carrito', $carrito->id_carrito)
                                    ->where('status', 'completado')
                                    ->get();

        return view('Pedidos.pedidos', compact('pedidos_pendientes', 'pedidos_completados'));
    }

    public function confirmarPedido(Request $request)
    {
        // Martin 01/06/2026: obtener el cliente autenticado
        $cliente = auth()->guard('web')->user();

        // Martin 01/06/2026: buscar el carrito activo *pendiente* del cliente
        $carrito = Carrito::where('id_cliente', $cliente->id_cliente)
                          ->with('detalles_carrito')
                          ->first();
        // Martin 01/06/2026: por si el carrito está vacío
        if (!$carrito || $carrito->detalles_carrito->isEmpty()) {
            return redirect()->back()->with('error', 'Tu carrito está vacío.');
        }

        // Martin 01/06/2026: transacción para asegurar que si algo falla, no se guarde incompleto
        DB::beginTransaction();
        $hecho = true;

        try {
            // Martin 01/06/2026: crear el nuevo Pedido
            $fecha_compra = now();
            $pedido = Pedidos::create([
                'id_carrito' => $carrito->id_carrito,
                'fecha_compra' => $fecha_compra,
                'total' => $carrito->subtotal, // Martin 01/06/2026: subtotal del carrito = total
                'status' => 'pendiente', // Martin 01/06/2026: esto se aprobará después en la vista de pedidos
            ]);

            // Martin 01/06/2026: pasar los detalles del carrito al detalle del pedido y descontar stock
            foreach ($carrito->detalles_carrito as $detalle) {
                // Martin 01/06/2026: crear detalle del pedido
                DetallePedido::create([
                    'id_pedido' => $pedido->id_pedido,
                    'id_productos' => $detalle->id_productos,
                    'cantidad' => $detalle->cantidad,
                    'subtotal' => $detalle->subtotal // Martin 01/06/2026: cambio por -subototal-
                ]);

                $producto = Producto::find($detalle->id_productos);
                if ($producto->stock < $detalle->cantidad) {
                    // Martin 01/06/2026: si no hay stock suficiente, se revierte todo y se detiene el ciclo
                    DB::rollBack();
                    $hecho = false;
                    break;
                }

                // Martin 01/06/2026: descontar stock del producto
                $producto->stock -= $detalle->cantidad;
                $producto->save();
            }

            if($hecho){
                // Martin 01/06/2026: cambiar el status del carrito para cerrarlo
                $carrito->update(['subtotal' => 0]);
                $carrito->detalles_carrito()->delete();

                DB::commit(); // Martin 01/06/2026: guarda en la base de datos

                return redirect()->route('productos')->with('success', '¡Pedido confirmado!');
            } else {
                return redirect()->back()->with('error', 'No hay stock suficiente para el producto '.$producto->nombre);
            }

        // Martin 01/06/2026: si algo falló, deshace los cambios
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pagarPedido($id_pedido)
    {
        $pedido = Pedidos::findOrFail($id_pedido);
        $pedido->status = 'completado';
        $pedido->save();

        return redirect()->route('clientes.mostrar', auth()->guard('web')->user()->id_cliente)->with('success', 'Pedido completado correctamente');
    }

    public function cancelarPedido($id_pedido)
    {
        $detalles = DetallePedido::where('id_pedido', $id_pedido)->get();
        foreach($detalles as $detalle)
        {
            $producto = Producto::where('id_productos', $detalle->id_productos)->first();
            $cantidadOriginal = $producto->stock + $detalle->cantidad;
            $producto->update([
                'stock' => $cantidadOriginal
            ]);
        }
        DetallePedido::where('id_pedido', $id_pedido)->delete();
        Pedidos::where('id_pedido', $id_pedido)->delete();

        return redirect()->route('clientes.mostrar', auth()->guard('web')->user()->id_cliente)->with('success', 'Pedido cancelado correctamente');
    }
}