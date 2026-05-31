<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Hash;

class ClientesController extends Controller
{
    public function clientes(){
        $clientes = Clientes::all();
        return view('Clientes.clientes', compact('clientes'));
    }

    public function registro(){
        return view('Clientes.clientesregistro');
    }
    
    public function guardar(Request $request){
        $guardar = new Clientes();

        $guardar->nombre = $request->nombre;
        $guardar->apellido = $request->apellido;
        $guardar->direccion = $request->direccion;
        $guardar->email = $request->email;
        $guardar->telefono = $request->telefono;
        $guardar->contraseña = Hash::make($request->contraseña);
        $guardar->save();
        return redirect('/clientes');
    }

    public function mostrar($cliente){
        $cliente = Clientes::find($cliente);
        return view('Clientes.cliente', compact('cliente'));
    }

    public function modificar($cliente){
        $cliente = Clientes::find($cliente);
        return view('Clientes.clientemodificar', compact('cliente'));
    }

    public function actualizar(Request $request, $cliente){
        $cliente = Clientes::find($cliente);

        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->direccion = $request->direccion;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->contraseña = Hash::make($request->contraseña);
        $cliente->save();
        return redirect('/clientes/' .$cliente->id_cliente);
    }

    public function eliminar($cliente){
        $cliente = Clientes::find($cliente);
        $cliente->delete();
        return redirect('/clientes');
    }
}
