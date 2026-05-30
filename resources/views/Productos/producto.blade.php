<x-plantilla>
    <h1>hola mundo desde el producto: {{$producto->nombre}}</h1>
    <img src="{{url('/productos/'. $producto->id_productos.'/imagen')}}" alt="Ya funcionan las imagenes, si ven esto algo hicieron">
    <!-- Estos botones de modificar y eliminar producto no necesariamente estaran
    en la vista que vea el usuario, mas bien estarian en una vista para el administrador-->
    <a href="/productos/{{$producto->id_productos}}/modificar" class="border-2">Modificar producto</a>
    <form action="/productos/{{$producto->id_productos}}" method="POST">

        @csrf
        @method('DELETE')

        <button type="submit" onclick="return confirm('Seguro que desea eliminar este producto?')"
        class="border-2">Eliminar Producto</button>

    </form>
    <form action="/productos/{{$producto->id_productos}}/agregar">


        <button type="submit" class="border-2">Agregar al carrito</button>
    </form>    
</x-plantilla>