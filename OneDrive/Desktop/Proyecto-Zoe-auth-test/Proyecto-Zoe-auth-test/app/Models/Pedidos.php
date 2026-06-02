<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table = "pedidos";

    protected $fillable = 
    [
        "id_pedido",
        "id_carrito",
        "fecha_compra",
        "total",
        "status"
    ];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, "id_carrito");
    }

    public function detalle_pedido() 
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido');
    }
}
