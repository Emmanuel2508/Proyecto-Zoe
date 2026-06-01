<x-plantilla>
    <h1>Hola mundo desde el listado de productos</h1>
    @if(auth()->guard('admin')->check())
        <a href="{{ route('productos.registro') }}">Registro</a>
    @endif
    @if(session('success'))
        {{ session('success') }}
    @endif
    @foreach ($productos as $producto)
    <li>
        <a href="{{ route('productos.mostrar', $producto->id_productos) }}">
            <p>
                {{$producto->nombre}}
            </p>
        </a>
    </li>
    @endforeach
</x-plantilla>