<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $primaryKey = 'id_productos';
    protected $table = 'productos';
    public $timestamps = false;
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
