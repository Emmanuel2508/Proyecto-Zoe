<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProductosController;
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
route::delete('/clientes/{cliente}', [ClientesController:: class, 'eliminar']);

route::get('/productos', [ProductosController:: class, 'productos']);
route::get('/productos/registro', [ProductosController::class, 'registro']);
route::post('/productos', [ProductosController:: class, 'guardar']);
route::get('/productos/{producto}', [ProductosController:: class, 'mostrar']);
route::get('/productos/{producto}/imagen', [ProductosController::class, 'mostrarimagen']);
route::get('/productos/{producto}/modificar', [ProductosController:: class, 'modificar']);
route::put('/productos/{producto}', [ProductosController:: class, 'actualizar']);
route::delete('/productos/{producto}', [ProductosController:: class, 'eliminar']);

route::get('/productos/{producto}/agregar', [CarritoController:: class, 'agregar']);
