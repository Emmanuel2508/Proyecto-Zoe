<x-plantilla :title="$title">
    <div class="max-w-4xl mx-auto px-4 py-12">
        
        <div class="bg-gradient-to-r from-[#fff5f8] via-[#f3e8f4] to-[#ffedf5] rounded-2xl p-8 border border-pink-100/50 shadow-sm text-center md:text-left md:flex md:items-center md:justify-between gap-6 mb-8">
            <div>
                <span class="text-xs uppercase tracking-widest text-[#7c7275] font-semibold">Panel de Usuario</span>
                <h1 class="text-2xl md:text-3xl font-light tracking-wide text-[#3a3a3a] mt-1">
                    <span class="font-normal text-[#f381ab]">{{$cliente->nombre}}</span>
                </h1>
            </div>
            
            <div class="mt-4 md:mt-0 shrink-0">
                <a href="/clientes/{{$cliente->id_cliente}}/modificar" 
                   class="inline-block px-5 py-2.5 bg-white border border-pink-200 hover:border-pink-400 text-[#7c7275] hover:text-pink-600 rounded-xl text-sm font-medium transition-all shadow-sm active:scale-95 cursor-pointer">
                    Modificar Perfil
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
            
            <a href="{{ route('carrito.mostrar', $cliente->id_cliente) }}" 
               class="group p-6 bg-white border border-pink-100 rounded-2xl shadow-md shadow-pink-100/20 hover:shadow-xl hover:shadow-pink-100/30 transition-all flex flex-col justify-between h-36 border-l-4 border-l-[#f381ab]">
                <div>
                    <h2 class="text-lg font-medium text-[#3a3a3a] group-hover:text-[#f381ab] transition-colors">Carrito</h2>
                    <p class="text-xs text-[#8e7f84] mt-1">Revisa los productos que tienes listos para comprar.</p>
                </div>
                <span class="text-xs text-[#f381ab] font-medium tracking-wider uppercase group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                    Ver mi carrito
                </span>
            </a>

            <a href="{{ route('pedidos.mostrar') }}" 
               class="group p-6 bg-white border border-purple-100 rounded-2xl shadow-md shadow-purple-100/10 hover:shadow-xl hover:shadow-purple-100/20 transition-all flex flex-col justify-between h-36 border-l-4 border-l-[#a29bb8]">
                <div>
                    <h2 class="text-lg font-medium text-[#3a3a3a] group-hover:text-[#a29bb8] transition-colors">Mis Pedidos</h2>
                    <p class="text-xs text-[#8e7f84] mt-1">Consulta el historial y estado de tus compras anteriores.</p>
                </div>
                <span class="text-xs text-[#a29bb8] font-medium tracking-wider uppercase group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                    Ver mis pedidos
                </span>
            </a>

        </div>

        <div class="border-t border-red-100/80 pt-6 flex justify-center sm:justify-end">
            <form action="/clientes/{{$cliente->id_cliente}}" method="POST" class="inline">
                @csrf
                @method('DELETE')

                <button type="submit" onclick="return confirm('Seguro que desea eliminar su cuenta?')"
                        class="px-4 py-2 text-xs font-medium text-red-500 bg-red-50/50 hover:bg-red-50 border border-red-100 rounded-xl transition-all cursor-pointer active:scale-95">
                    Eliminar Cuenta
                </button>
            </form>
        </div>

    </div>
</x-plantilla>