<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table = "pedidos";

    protected $fillable = 
    [
        "ID_Pedido",
        "ID_Carrito",
        "Fecha_Compra",
        "Total",
        "Status"
    ];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, "ID_Carrito");
    }

    public function detalle_pedido()
    {
        return $this->hasMany(DetalleCarrito::class);
    }
}
