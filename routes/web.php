<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProductosController;
use App\Models\Pedidos;
use Illuminate\Support\Facades\Route;

// inicio y autenticación
Route::get('/', function () {
    $title = 'ZOE - Inicio';
    return view('Home', compact('title'));
})->name('Inicio');

// login clientes
Route::get('/login', [AuthController::class, 'loginClienteForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginCliente'])->name('loginCliente');

// login administradores
Route::get('/admin/login', [AuthController::class, 'loginAdminForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('loginAdmin');

// registro público de clientes
Route::get('/clientes/registro', [ClientesController::class, 'registro'])->name('clientes.registro');
Route::post('/clientes', [ClientesController::class, 'guardar'])->name('clientes.guardar');


// rutas protegidas para cliente
Route::middleware(['auth', 'cliente'])->group(function (){
    // perfil del cliente
    Route::get('/clientes/{cliente}', [ClientesController::class, 'mostrar'])->name('clientes.mostrar');
    Route::get('/clientes/{cliente}/modificar', [ClientesController::class, 'modificar']);
    Route::put('/clientes/{cliente}', [ClientesController::class, 'actualizar']);
    Route::delete('/clientes/{cliente}', [ClientesController::class, 'eliminar']);

    // carrito de compras
    // Martin 02/06/2026:{cliente} por {id_cliente} para coincidir con el controlador
    Route::get('/carrito/{id_cliente}', [CarritoController::class, 'mostrar'])->name('carrito.mostrar');
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    
    // controles de cantidad del carrito
    Route::put('/carrito/{id_carrito}/agregarUno', [CarritoController::class, 'agregarUno'])->name('carrito.agregarUno');
    Route::put('/carrito/{id_carrito}/quitarUno', [CarritoController::class, 'quitarUno'])->name('carrito.quitarUno');
    
    // eliminar un artículo por completo del carrito
    Route::delete('/carrito/{detalle}/eliminar', [CarritoController::class, 'eliminarDetalle'])->name('carrito.eliminarDetalle');

    Route::get('/pedidos', [PedidosController::class, 'mostrarPedidos'])->name('pedidos.mostrar');
    Route::post('/pedidos/confirmar', [PedidosController::class, 'confirmarPedido'])->name('pedidos.confirmar');
    Route::put('/pedido/{id_pedido}/pagar', [PedidosController::class, 'pagarPedido'])->name('pedidos.pagar');
    Route::delete('/pedido/{id_pedido}/cancelar', [PedidosController::class, 'cancelarPedido'])->name('pedidos.cancelar');

    // cerrar sesión cliente
    Route::post('/logout', [AuthController::class, 'logoutCliente'])->name('logout');
});


// rutas protegidas para administrador
Route::middleware(['auth:admin', 'admin'])->group(function (){
    // panel de clientes para admin
    Route::get('/admin/clientes', [ClientesController::class, 'clientes'])->name('clientes');

    // gestión de productos CRUD Completo
    Route::get('/admin/productos/registro', [ProductosController::class, 'registro'])->name('productos.registro');
    Route::post('/admin/productos', [ProductosController::class, 'guardar'])->name('productos.guardar');
    Route::get('/admin/productos/{producto}/modificar', [ProductosController::class, 'modificar'])->name('productos.modificar');
    Route::put('/admin/productos/{producto}', [ProductosController::class, 'actualizar'])->name('productos.actualizar');
    Route::delete('/admin/productos/{producto}', [ProductosController::class, 'eliminar'])->name('productos.eliminar');

    // cerrar sesión admin
    Route::post('/admin/logout', [AuthController::class, 'logoutAdmin'])->name('admin.logout');
});


// rutas de consulta de productos publicas
Route::get('/productos', [ProductosController::class, 'productos'])->name('productos');
Route::get('/productos/{producto}', [ProductosController::class, 'mostrar'])->name('productos.mostrar');
Route::get('/productos/{producto}/imagen', [ProductosController::class, 'mostrarimagen']);