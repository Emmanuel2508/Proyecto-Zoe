<?php

namespace App\Models;
//nya uwu
use Illuminate\Database\Eloquent\Model;

class DetalleCarrito extends Model
{
    protected $table='detalle_carrito';
    protected $fillable=[
        'ID_Detalle',
        'ID_Carrito',
        'ID_Producto',
        'Cantidad',
        'Subtotal'
    ];
    public function carrito(){
        return $this->belongsTo(Carrito::class, 'ID_Carrito');
    }
    public function producto(){
        return $this->belongsTo(Producto::class, 'ID_Productos');
    }
    
}
