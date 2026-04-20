<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'ID_Cliente',
        'Nombre',
        'Apellido',
        'Direccion',
        'Email',
        'Telefono'
    ];
    public function Carrito(){
        return $this->hasMany(Carrito::class);
    }
}
