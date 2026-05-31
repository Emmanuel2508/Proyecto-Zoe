<x-plantilla>
    <form action="/clientes/{{$cliente->id_cliente}}" id="modificar" method="POST">

        @csrf
        @method('PUT')

        Nombres:
        <input type="text" name="nombre" id="nombre" required value="{{$cliente->nombre}}" 
        class="border-1">
        Apellidos:
        <input type="text" name="apellido" id="apellido" required value="{{$cliente->apellido}}"
        class="border-1">
        Direccion:
        <input type="text" name="direccion" id="direccion" required value="{{$cliente->direccion}}"
        class="border-1">
        email:
        <input type="email" name="email" id="email" required value="{{$cliente->email}}"
        class="border-1">
        Telefono:
        <input type="number" name="telefono" id="telefono" required value="{{$cliente->telefono}}"
        class="border-1">
        Contraseña:
        <input type="text" name="contraseña" id="contraseña" required
        class="border-1">
        <button type="submit" class="border-2">Modificar perfil</button>
    </form>
</x-plantilla>