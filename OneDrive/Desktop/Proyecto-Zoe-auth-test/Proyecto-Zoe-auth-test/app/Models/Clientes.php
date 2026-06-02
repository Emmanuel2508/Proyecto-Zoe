<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Clientes extends Authenticatable
{
    protected $primaryKey = 'id_cliente';
    protected $table = 'clientes';
    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'nombre',
        'apellido',
        'direccion',
        'email',
        'telefono',
        'contraseña'
    ];

    protected $hidden = [
        'contraseña',    
    ];

    public function getAuthPassword(){
        return $this->contraseña;
    }

    public function Carrito(){
        return $this->hasMany(Carrito::class);
    }
}
