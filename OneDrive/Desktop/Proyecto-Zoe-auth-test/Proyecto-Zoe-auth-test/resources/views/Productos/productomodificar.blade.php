<x-plantilla>
    <h1>hola mundo desde el formulario para modificar productos</h1>

    <form action="{{ route('productos.actualizar', $producto->id_productos) }}" id="modificar" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        Nombre:
        <input type="text" name="nombre" id="nombre" required value="{{$producto->nombre}}"
        class="border-2">
        Descripcion:
        <input type="text" name="descripcion" id="descripcion" required value="{{$producto->descripcion}}"
        class="border-2">
        Imagen: |No subir nada si no se quiere cambiar la imagen|
        <input type="file" name="imagen" id="imagen" accept="image/jpeg" 
        class="border-2">
        Categoria:
        <input type="text" name="categoria" id="categoria" required value="{{$producto->categoria}}"
        class="border-2">
        Precio:
        <input type="number" name="precio" id="precio" required value="{{$producto->precio}}"
        class="border-2">
        Stock:
        <input type="number" name="stock" id="stock" required value="{{$producto->stock}}"
        class="border-2">
        <button type="submit">Actualizar Producto</button>
    </form>
</x-plantilla>