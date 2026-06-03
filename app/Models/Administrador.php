<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrador extends Authenticatable
{
    protected $primaryKey = 'id_admin';

    protected $table = 'admins';

    public $timestamps = false;

    protected $fillable =
    [
        'id_admin',
        'email',
        'contraseña'
    ];

    protected $hidden = 
    [
        'contraseña'
    ];

    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
