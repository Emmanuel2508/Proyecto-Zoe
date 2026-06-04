<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientesController extends Controller
{
    public function clientes(){
        $clientes = Clientes::all();
        $title = 'ZOE - Lista de clientes';
        return view('Clientes.clientes', compact('title', 'clientes'));
    }

    public function registro(){
        $title = 'ZOE - Registrarse';
        return view('Clientes.clientesregistro', compact('title'));
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
        return redirect()->route('login');
    }

    public function mostrar($cliente){
        $cliente = Clientes::find($cliente);
        $title = 'ZOE - Mi perfil';
        return view('Clientes.cliente', compact('title', 'cliente'));
    }

    public function modificar($cliente){
        $cliente = Clientes::find($cliente);
        $title = 'ZOE - Modificar mis datos';
        return view('Clientes.clientemodificar', compact('title', 'cliente'));
    }

    public function actualizar(Request $request, $cliente){
        $cliente = Clientes::find($cliente);

        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->direccion = $request->direccion;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        if ($request->filled('contraseña')){
            $cliente->contraseña = Hash::make($request->contraseña);
        }
        $cliente->save();
        return redirect()->route('clientes.mostrar', $cliente->id_cliente);
    }

    public function eliminar(Request $request, $cliente){
        $cliente = Clientes::find($cliente);
        $cliente->delete();

        auth()->guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('Inicio');
    }
}
