<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'ID_Productos',
        'Nombre',
        'Categoria',
        'Precio',
        'Stock'
    ];

    public function detalleCarrito(){
        return $this->hasMany(DetalleCarrito::class);
    }
}
