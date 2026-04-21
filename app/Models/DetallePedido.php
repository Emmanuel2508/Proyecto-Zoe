<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = "detalle_pedido";

    protected $fillable = [
        "ID_Detalle_Pedido", "ID_Pedido", "ID_Productos", "Cantidad", "Subtotal"
    ];

    public function pedido(){
        return $this->belongsTo(Pedidos::class, "ID_Pedido");
    }

    public function producto(){
        return $this->belongsTo(Producto::class, "ID_Productos");
    }
}
