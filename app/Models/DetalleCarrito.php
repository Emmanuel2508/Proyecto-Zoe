<?php

namespace App\Models;
//nya uwu
use Illuminate\Database\Eloquent\Model;

class DetalleCarrito extends Model
{
    protected $table='detalle_carrito';

    protected $primaryKey = 'id_detalle';

    public $timestamps = false;

    protected $fillable=[
        'id_carrito',
        'id_productos',
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
