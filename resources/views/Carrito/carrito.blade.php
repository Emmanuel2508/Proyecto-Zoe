<x-plantilla :title="$title">
    <div class="max-w-6xl mx-auto px-4 py-10">
        
        <div class="mb-8 border-b border-pink-100/60 pb-4">
            <h1 class="text-3xl font-light tracking-[0.15em] text-[#3a3a3a] uppercase">
                Mi Carrito
            </h1>
        </div>

        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm font-medium">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl shadow-pink-100/20 border border-pink-100/40 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gradient-to-r from-[#fff5f8] via-[#f3e8f4] to-[#ffedf5] border-b border-pink-100/40 text-[#7c7275] text-xs uppercase tracking-wider font-semibold">
                                <th class="py-4 px-6">Producto</th>
                                <th class="py-4 px-4 text-center">Precio</th>
                                <th class="py-4 px-4 text-center">Cantidad</th>
                                <th class="py-4 px-4 text-center">Subtotal</th>
                                <th class="py-4 px-6 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pink-50/60 text-[#4a4a4a] text-sm">
                            @forelse ($carrito->detalles_carrito as $detalle)
                                <tr class="hover:bg-[#faf8f9]/50 transition-colors">
                                    <td class="py-5 px-6 font-medium text-[#3a3a3a]">
                                        {{ $detalle->producto->nombre }}
                                    </td>
                                    <td class="py-5 px-4 text-center text-[#6e6669]">
                                        ${{ $detalle->producto->precio }}
                                    </td>
                                    <td class="py-5 px-4 text-center font-semibold">
                                        {{ $detalle->cantidad }}
                                    </td>
                                    <td class="py-5 px-4 text-center font-medium text-[#f381ab]">
                                        ${{ $detalle->subtotal }}
                                    </td>
                                    <td class="py-5 px-6">
                                        <div class="flex items-center justify-end gap-2">
                                            
                                            <form action="{{ route('carrito.agregarUno', $carrito->id_carrito) }}" method="post" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id_productos" value="{{ $detalle->producto->id_productos }}">
                                                <button type="submit" class="w-8 h-8 flex items-center justify-center bg-white border border-pink-200 text-[#7c7275] rounded-lg hover:border-pink-400 hover:text-pink-600 font-medium transition-all cursor-pointer shadow-sm active:scale-95">
                                                    +
                                                </button>
                                            </form>

                                            @if ($detalle->cantidad > 1)
                                                <form action="{{ route('carrito.quitarUno', $carrito->id_carrito) }}" method="post" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id_productos" value="{{ $detalle->producto->id_productos }}">
                                                    <button type="submit" class="w-8 h-8 flex items-center justify-center bg-white border border-pink-200 text-[#7c7275] rounded-lg hover:border-pink-400 hover:text-pink-600 font-medium transition-all cursor-pointer shadow-sm active:scale-95">
                                                        -
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('carrito.eliminarDetalle', $detalle->id_detalle) }}" method="post" class="inline ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id_carrito" value="{{ $carrito->id_carrito }}">
                                                <button type="submit" class="px-3 py-1.5 text-xs text-red-500 bg-red-50/60 hover:bg-red-50 border border-red-100 rounded-lg font-medium transition-all cursor-pointer active:scale-95">
                                                    Eliminar
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-[#8e7f84] italic bg-[#faf8f9]/30">
                                        El carrito está vacío
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl shadow-pink-100/20 border border-pink-100/40 p-6 space-y-6">
                <h2 class="text-lg font-medium text-[#3a3a3a] border-b border-pink-50 pb-3">
                    Resumen de Pedido
                </h2>
                
                <div class="flex justify-between items-center">
                    <span class="text-[#7c7275] text-sm">Total de compras</span>
                    <span class="text-2xl font-light text-[#3a3a3a] font-semibold">
                        ${{ $carrito->subtotal }}
                    </span>
                </div>

                <div class="pt-2">
                    <form action="{{ route('pedidos.confirmar') }}" method="post">
                        @csrf
                        <button type="submit" class="w-full py-3 bg-[#f381ab] hover:bg-[#ef6b9d] text-white font-medium rounded-xl shadow-md shadow-pink-200/50 hover:shadow-lg transition-all transform active:scale-[0.98] tracking-wide text-sm text-center cursor-pointer">
                            Confirmar Pedido
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-plantilla>