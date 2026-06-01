<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home');
})->name('Inicio');

Route::get('/login', [AuthController::class, 'loginClienteForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginCliente'])->name('loginCliente');

Route::get('/admin/login', [AuthController::class, 'loginAdminForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('loginAdmin');

Route::get('/clientes/registro', [ClientesController::class, 'registro'])->name('clientes.registro');
Route::post('/clientes', [ClientesController:: class, 'guardar']);

Route::middleware(['auth', 'cliente'])->group(function (){
    Route::get('/clientes/{cliente}', [ClientesController:: class, 'mostrar'])->name('clientes.mostrar');
    Route::get('/clientes/{cliente}/modificar', [ClientesController:: class, 'modificar']);
    Route::put('/clientes/{cliente}', [ClientesController:: class, 'actualizar']);
    Route::delete('/clientes/{cliente}', [ClientesController:: class, 'eliminar']);

    Route::get('/productos/{producto}/agregar', [CarritoController:: class, 'agregar']);

    Route::post('/logout', [AuthController::class, 'logoutCliente'])->name('logout');
});

Route::middleware(['auth:admin', 'admin'])->group(function (){
    Route::get('/admin/clientes', [ClientesController:: class, 'clientes'])->name('clientes');

    Route::get('/admin/productos/registro', [ProductosController::class, 'registro'])->name('productos.registro');
    Route::post('/admin/productos', [ProductosController:: class, 'guardar'])->name('productos.guardar');
    Route::get('/admin/productos/{producto}/modificar', [ProductosController:: class, 'modificar'])->name('productos.modificar');
    Route::put('/admin/productos/{producto}', [ProductosController:: class, 'actualizar'])->name('productos.actualizar');
    Route::delete('/admin/productos/{producto}', [ProductosController:: class, 'eliminar'])->name('productos.eliminar');

    Route::post('/admin/logout', [AuthController::class, 'logoutAdmin'])->name('admin.logout');
});

Route::get('/productos', [ProductosController:: class, 'productos'])->name('productos');
Route::get('/productos/{producto}', [ProductosController:: class, 'mostrar'])->name('productos.mostrar');
Route::get('/productos/{producto}/imagen', [ProductosController::class, 'mostrarimagen']);
