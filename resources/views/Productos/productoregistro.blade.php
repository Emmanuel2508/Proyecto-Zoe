<x-plantilla>
    <h1>Hola mundo desde el forulario de registro de productos</h1>
    <form action="/productos" id="registro" method="POST" enctype="multipart/form-data">
        
        @csrf

        Nombre:
        <input type="text" name="nombre" id="nombre" required
        class="border-2">
        Descripcion:
        <input type="text" name="descripcion" id="descripcion" required
        class="border-2">
        Imagen:
        <input type="file" name="imagen" id="imagen" accept="image/jpeg" required
        class="border-2">
        Categoria:
        <input type="text" name="categoria" id="categoria" required
        class="border-2">
        Precio:
        <input type="number" name="precio" id="precio" required
        class="border-2">
        Stock:
        <input type="number" name="stock" id="stock" required
        class="border-2">
        <button type="submit">Agregar Producto</button>
    </form>
</x-plantilla>