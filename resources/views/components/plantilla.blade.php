<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class=" bg-pink-300"> <!-- Aqui se quita este bg, solo es para ver si se aplico la plantilla bien-->
    <nav class="flex">
        <div class="mr-15">
            <a href="{{ route('Inicio') }}">
                ZOE
            </a>
        </div>

        <div class="flex">
            @if(auth()->guard('admin')->check())
                <span class="mr-10">Admin: {{ auth()->guard('admin')->user()->email }}</span>
                <form action="{{ route('admin.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="hover:cursor-pointer">
                        Cerrar Sesión
                    </button>
                </form>
            @elseif(auth()->guard('web')->check())
                <span>Hola {{ auth()->guard('web')->user()->nombre }}</span>
                <a href="{{ route('clientes.mostrar', auth()->guard('web')->user()->id_cliente) }}">Mi Perfil</a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="hover:cursor-pointer">
                        Cerrar Sesión
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">Iniciar Sesión</a>
                <a href="{{ route('clientes.registro') }}">Registrarse</a>
                <a href="{{ route('admin.login') }}">Administrar</a>
            @endif
        </div>
    </nav>
    {{ $slot }}
</body>
</html>