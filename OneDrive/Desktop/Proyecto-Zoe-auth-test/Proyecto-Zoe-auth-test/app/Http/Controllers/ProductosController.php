<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function productos(){
        $productos = Producto::all();
        return view('Productos.productos', compact('productos'));
    }

    public function registro(){
        return view('Productos.productoregistro');
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
        return redirect('/productos');
    }

    public function mostrar($producto){
        $producto = Producto::find($producto);
        return view('Productos.producto', compact('producto'));
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
        return view('Productos.productomodificar', compact('producto'));
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
        return redirect('/productos/'. $producto->id_productos);
    }

    public function eliminar($producto){
        $producto = Producto::find($producto);
        $producto->delete();
        return redirect('/productos');
    }
}
