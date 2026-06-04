@props(['title' => 'ZOE'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#faf8f9]">
    <nav class="flex items-center justify-between px-12 py-4 bg-gradient-to-r from-[#fff5f8] via-[#f3e8f4] to-[#ffedf5] border-b border-pink-100/50 shadow-sm">
        
        <div class="flex-shrink-0">
            <a href="{{ route('Inicio') }}" class="text-4xl font-light tracking-[0.25em] text-[#3a3a3a] hover:opacity-80 transition-opacity">
                ZÖE
            </a>
        </div>

        <div class="flex items-center gap-8 text-[#5c5457] font-normal text-[15px]">
            @if(auth()->guard('admin')->check())
                <span class="text-sm bg-purple-50 text-purple-700 px-3 py-1 rounded-md border border-purple-200">
                    Admin: {{ auth()->guard('admin')->user()->email }}
                </span>
                <form action="{{ route('admin.logout') }}" method="post" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-pink-600 hover:cursor-pointer transition-colors py-1">
                        Cerrar Sesión
                    </button>
                </form>
            @elseif(auth()->guard('web')->check())
                <span class="text-[#8e7f84]">Hola, {{ auth()->guard('web')->user()->nombre }}</span>
                <a href="{{ route('clientes.mostrar', auth()->guard('web')->user()->id_cliente) }}" class="hover:text-pink-600 transition-colors py-1">
                    Mi Perfil
                </a>
                <form action="{{ route('logout') }}" method="post" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-pink-600 hover:cursor-pointer transition-colors py-1">
                        Cerrar Sesión
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-pink-600 transition-colors py-1">
                    Iniciar Sesión
                </a>
                <a href="{{ route('clientes.registro') }}" class="hover:text-pink-600 transition-colors py-1">
                    Registrarse
                </a>
                <a href="{{ route('admin.login') }}" class="hover:text-purple-600 transition-colors py-1">
                    Administrar
                </a>
            @endif
        </div>
    </nav>
    {{ $slot }}
</body>
</html>