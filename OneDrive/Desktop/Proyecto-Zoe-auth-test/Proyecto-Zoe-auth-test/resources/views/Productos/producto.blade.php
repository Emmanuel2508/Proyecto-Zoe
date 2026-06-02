<x-plantilla>
    <h1>hola mundo desde el producto: {{$producto->nombre}}</h1>
    <img src="{{url('/productos/'. $producto->id_productos.'/imagen')}}" alt="Ya funcionan las imagenes, si ven esto algo hicieron">
    <!-- los botones de modificar y eliminar producto estarian en una vista para el administrador-->
    @if(auth()->guard('admin')->check())
        <a href="{{ route('productos.modificar', $producto->id_productos) }}" class="border-2">Modificar producto</a>
        <form action="{{ route('productos.eliminar', $producto->id_productos) }}" method="POST">

            @csrf
            @method('DELETE')

            <button type="submit" onclick="return confirm('Seguro que desea eliminar este producto?')"
            class="border-2">Eliminar Producto</button>

        </form>
    @else
        <form action="/productos/{{$producto->id_productos}}/agregar">
            <button type="submit" class="border-2">Agregar al carrito</button>
        </form>
    @endif
</x-plantilla>