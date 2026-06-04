<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function productos(){
        $productos = Producto::all();
        $title = 'ZOE - Catálogo de productos';
        return view('Productos.productos', compact('title', 'productos'));
    }

    public function registro(){
        $title = 'ZOE - Nuevo producto';
        return view('Productos.productoregistro', compact('title'));
    }

    public function guardar(Request $request){
        $guardar = new Producto();
        $guardar->nombre = $request->nombre;
        $guardar->descripcion = $request->descripcion;
        if ($request->hasFile('imagen')){
            $guardar->imagen = file_get_contents(
                $request->file('imagen')->getRealPath()
            );
        }
        $guardar->categoria = $request->categoria;
        $guardar->precio = $request->precio;
        $guardar->stock = $request->stock;
        $guardar->save();
        return redirect()->route('productos');
    }

    public function mostrar($producto){
        $producto = Producto::find($producto);
        $title = 'ZOE - '.$producto->nombre;
        return view('Productos.producto', compact('title', 'producto'));
    }

    public function mostrarimagen($id){
        $producto = Producto::findorfail($id);
        return response()->make($producto->imagen, 200, [
            'content-type' => 'image/jpeg',
            'content-Disposition' => 'inline; filename="producto.jpg"',
        ]);
    }

    public function modificar($producto){
        $producto = Producto::find($producto);
        $title = 'ZOE - Modificar producto';
        return view('Productos.productomodificar', compact('title', 'producto'));
    }

    public function actualizar(Request $request, $producto){
        $producto = Producto::find($producto);

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        if ($request->hasFile('imagen')){
            $producto->imagen = file_get_contents(
                $request->file('imagen')->getRealPath()
            );
        }
        $producto->categoria = $request->categoria;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->save();
        return redirect()->route('productos.mostrar', $producto->id_productos);
    }

    public function eliminar($producto){
        $producto = Producto::find($producto);
        $producto->delete();
        return redirect()->route('productos');
    }
}
