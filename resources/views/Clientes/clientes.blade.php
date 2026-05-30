<x-plantilla>
    
    @foreach ($clientes as $cliente)
        <li>
            <a href="/clientes/{{$cliente->id_cliente}}">
                <p>
                    {{$cliente->nombre}}
                    {{$cliente->apellido}}
                </p>
            </a>
        </li>
    @endforeach
</x-plantilla>