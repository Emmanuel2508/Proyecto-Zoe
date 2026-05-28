<x-plantilla>
    <h1 class="text-4xl">Hola mundo desde el perfil del cliente: {{$cliente->nombre}}</h1>
    <a href="/clientes/{{$cliente->id_cliente}}/modificar" class="border-2">Modificar Perfil</a>
</x-plantilla>