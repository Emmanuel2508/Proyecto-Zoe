<?php

namespace App\Models;
//nya uwu
use Illuminate\Database\Eloquent\Model;

class DetalleCarrito extends Model
{
    protected $table='detalle_carrito';
    protected $fillable=[
        'id_detalle',
        'id_carrito',
        'id_producto',
        'cantidad',
        'subtotal'
    ];
    public function carrito(){
        return $this->belongsTo(Carrito::class, 'id_carrito');
    }
    public function producto(){
        return $this->belongsTo(Producto::class, 'id_productos');
    }
    
}
