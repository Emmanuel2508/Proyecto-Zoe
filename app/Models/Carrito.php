<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carrito extends Model
{
    protected $table='carrito';
    protected $fillable=[
        'ID_Carrito', 
        'ID_Cliente',
        'Subtotal',
        'Fecha_Compra',
        'Status'
  ];
    public function clientes(){
        return $this->belongsTo(Clientes::class, 'ID_Cliente');
    }
    public function detalles_carrito(){
        return $this->hasMany(DetalleCarrito::class);
    }
    public function pedidos(){
        return $this->hasMany(Pedidos::class);
    }    
}

