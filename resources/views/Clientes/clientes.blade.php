<x-plantilla :title="$title">
    <div class="max-w-5xl mx-auto px-4 py-10">
        
        <!-- Encabezado de la Vista de Administrador (Sin contador) -->
        <div class="mb-8 border-b border-pink-100/60 pb-4">
            <h1 class="text-3xl font-light tracking-[0.15em] text-[#3a3a3a] uppercase">
                Clientes Registrados
            </h1>
            <p class="text-xs text-[#8e7f84] mt-1">Lista completa de usuarios en la plataforma ZÖE</p>
        </div>

        <!-- Contenedor del Listado Estilizado -->
        <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 list-none p-0">
            @foreach ($clientes as $cliente)
                <li>
                    <a href="/clientes/{{$cliente->id_cliente}}" class="block group">
                        <!-- Tarjeta de Cliente Minimalista -->
                        <div class="p-5 bg-white border border-pink-100/70 rounded-2xl shadow-sm hover:shadow-md hover:border-pink-300 transition-all text-center sm:text-left bg-gradient-to-br hover:from-white hover:to-[#fff5f8]/40">
                            
                            <!-- Información del Cliente Únicamente -->
                            <p class="font-medium text-[#3a3a3a] group-hover:text-[#f381ab] transition-colors text-base truncate">
                                {{$cliente->nombre}} {{$cliente->apellido}}
                            </p>

                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

    </div>
</x-plantilla>