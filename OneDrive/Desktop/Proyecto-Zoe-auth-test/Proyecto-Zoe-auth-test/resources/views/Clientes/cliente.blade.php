<x-plantilla>
    <h1 class="text-4xl">Hola mundo desde el perfil del cliente: {{$cliente->nombre}}</h1>
    <a href="/clientes/{{$cliente->id_cliente}}/modificar" class="border-2">Modificar Perfil</a>
    <form action="/clientes/{{$cliente->id_cliente}}" method="POST">

        @csrf
        @method('DELETE')

        <button type="submit" onclick="return confirm('Seguro que desea eliminar su cuenta?')"
        class="border-2">Eliminar Cuenta</button>

    </form>
</x-plantilla>