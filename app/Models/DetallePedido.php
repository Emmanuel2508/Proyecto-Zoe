<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = "detalle_pedido";

    protected $primaryKey = "id_detalle_pedido";

    protected $fillable = [
        "id_pedido",
        "id_productos",
        "cantidad", 
        "subtotal"
    ];

    public function pedido(){
        return $this->belongsTo(Pedidos::class, "id_pedido");
    }

    public function producto(){
        return $this->belongsTo(Producto::class, "id_productos");
    }
}
