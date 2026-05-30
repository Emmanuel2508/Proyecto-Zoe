<x-plantilla>
    <h1>Hola mundo desde el listado de productos</h1>
    <a href="/productos/registro">Registro</a>
    @foreach ($productos as $producto)
    <li>
        <a href="/productos/{{$producto->id_productos}}">
            <p>
                {{$producto->nombre}}
            </p>
        </a>
    </li>
    @endforeach
</x-plantilla>