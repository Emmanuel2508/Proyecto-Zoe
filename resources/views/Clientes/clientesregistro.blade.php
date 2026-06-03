<x-plantilla>
    <form action="{{ route('clientes.guardar') }}" id="registro" method="POST">

        @csrf

        Nombres:
        <input type="text" name="nombre" id="nombre" required
        class="border-1">
        Apellidos:
        <input type="text" name="apellido" id="apellido" required
        class="border-1">
        Direccion:
        <input type="text" name="direccion" id="direccion" required
        class="border-1">
        email:
        <input type="email" name="email" id="email" required
        class="border-1">
        Telefono:
        <input type="number" name="telefono" id="telefono" required
        class="border-1">
        Contraseña:
        <input type="text" name="contraseña" id="contraseña" required
        class="border-1">
        <button type="submit">Registrarme</button>
    </form>
</x-plantilla>