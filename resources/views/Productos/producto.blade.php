<x-plantilla>
    <h1>hola mundo desde el producto: {{$producto->nombre}}</h1>
    <img src="{{url('/productos/'. $producto->id_productos.'/imagen')}}" alt="Ya funcionan las imagenes, si ven esto algo hicieron">
    <!-- Estos botones de modificar y eliminar producto no necesariamente estaran
    en la vista que vea el usuario, mas bien estarian en una vista para el administrador-->
    @if(auth()->guard('admin')->check())
        <a href="{{ route('productos.modificar', $producto->id_productos) }}" class="border-2">Modificar producto</a>
        <form action="{{ route('productos.eliminar', $producto->id_productos) }}" method="POST">

            @csrf
            @method('DELETE')

            <button type="submit" onclick="return confirm('Seguro que desea eliminar este producto?')"
            class="border-2">Eliminar Producto</button>

        </form>
    @else
        <form action="{{ route('carrito.agregar') }}" method="post">
            @csrf
            @method('POST')

            <input type="hidden" name="id_productos" value="{{ $producto->id_productos }}">

            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="{{ $producto->stock }}">

            <button type="submit" class="border-2">Agregar al carrito</button>
        </form>
    @endif
</x-plantilla>