<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carrito extends Model
{
    protected $table='carrito';
    protected $fillable=[
        'id_carrito', 
        'id_cliente',
        'subtotal',
        'fecha_compra',
        'status'
  ];
    public function clientes(){
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }
    public function detalles_carrito(){
        return $this->hasMany(DetalleCarrito::class);
    }
    public function pedidos(){
        return $this->hasMany(Pedidos::class);
    }    
}

