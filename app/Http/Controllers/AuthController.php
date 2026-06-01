<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginClienteForm()
    {
        return view('auth.login');
    }

    public function loginCliente(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'contraseña' => 'required'
        ]);

        $credenciales = 
        [
            'email' => $request->email,
            'password' => $request->contraseña
        ];

        if(auth()->guard('web')->attempt($credenciales))
        {
            $request->session()->regenerate();
            return redirect()->route('productos');
        }

        return redirect()->back()->with('error', 'Credenciales incorrectas');
    }

    public function logoutCliente(Request $request)
    {
        auth()->guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('productos');
    }

    public function loginAdminForm()
    {
        return view('auth.admin-login');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'contraseña' => 'required'
        ]);

        $credenciales =
        [
            'email' => $request->email,
            'password' => $request->contraseña
        ];

        if(auth()->guard('admin')->attempt($credenciales))
        {
            $request->session()->regenerate();
            return redirect()->route('productos');
        }

        return redirect()->back()->with('error', 'Credenciales incorrectas');
    }

    public function logoutAdmin(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('Inicio');
    }
}
