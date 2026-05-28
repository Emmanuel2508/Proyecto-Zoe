<?php

use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
route::get('/clientes', [ClientesController:: class, 'clientes']);
route::get('/clientes/registro', [ClientesController::class, 'registro']);
route::post('/clientes', [ClientesController:: class, 'guardar']);
route::get('/clientes/{cliente}', [ClientesController:: class, 'mostrar']);
route::get('/clientes/{cliente}/modificar', [ClientesController:: class, 'modificar']);
route::put('/clientes/{cliente}', [ClientesController:: class, 'actualizar']);
