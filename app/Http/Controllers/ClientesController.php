<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function clientes(){
        $clientes = Clientes::all();
        return view('clientes', compact('clientes'));
    }

    public function registro(){
        return view('clientesregistro');
    }
    
    public function guardar(Request $request){
        $guardar = new Clientes();

        $guardar->nombre = $request->nombre;
        $guardar->apellido = $request->apellido;
        $guardar->direccion = $request->direccion;
        $guardar->email = $request->email;
        $guardar->telefono = $request->telefono;
        $guardar->contraseña = $request->contraseña;
        $guardar->save();
        return redirect('/clientes');
    }

    public function mostrar($cliente){
        $cliente = Clientes::find($cliente);
        return view('cliente', compact('cliente'));
    }

    public function modificar($cliente){
        $cliente = Clientes::find($cliente);
        return view('clientemodificar', compact('cliente'));
    }

    public function actualizar(Request $request, $cliente){
        $cliente = Clientes::find($cliente);

        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->direccion = $request->direccion;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->contraseña = $request->contraseña;
        $cliente->save();
        return redirect('/clientes/' .$cliente->id_cliente);
    }

    public function eliminar($cliente){
        $cliente = Clientes::find($cliente);
        $cliente->delete();
        return "Aqui se redirigira al listado de clientes";
    }
}
