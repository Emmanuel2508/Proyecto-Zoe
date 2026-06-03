<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table='carrito';

    protected $primaryKey = 'id_carrito';

    public $timestamps = false;

    protected $fillable=[
        'id_cliente',
        'subtotal',
        'fecha_compra'
  ];
    public function clientes(){
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }
    public function detalles_carrito(){
        return $this->hasMany(DetalleCarrito::class, 'id_carrito', 'id_carrito');
    }
    public function pedidos(){
        return $this->hasMany(Pedidos::class);
    }    
}

