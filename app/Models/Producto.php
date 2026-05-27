<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'id_productos',
        'nombre',
        'categoria',
        'precio',
        'stock'
    ];

    public function detalleCarrito(){
        return $this->hasMany(DetalleCarrito::class);
    }

    public function detallePedido(){
        return $this->hasMany(DetallePedido::class);
    }
}
