<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
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
        'telefono'
    ];
    public function Carrito(){
        return $this->hasMany(Carrito::class);
    }
}
