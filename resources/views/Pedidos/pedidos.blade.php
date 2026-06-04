<x-plantilla>
    <div class="max-w-6xl mx-auto px-4 py-10 space-y-12">
        
        <!-- Título Principal de la Sección -->
        <div class="border-b border-pink-100/60 pb-4">
            <h1 class="text-3xl font-light tracking-[0.15em] text-[#3a3a3a] uppercase">
                Mis Pedidos
            </h1>
        </div>

        <!-- SECCIÓN 1: Pedidos Pendientes -->
        <div class="bg-white rounded-2xl shadow-xl shadow-pink-100/10 border border-pink-100/40 overflow-hidden">
            <div class="bg-gradient-to-r from-[#fff5f8] via-[#f3e8f4] to-[#ffedf5] px-6 py-4 border-b border-pink-100/40">
                <h3 class="text-lg font-medium text-[#3a3a3a] tracking-wide">Pedidos Pendientes</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#faf8f9] border-b border-pink-50 text-[#7c7275] text-xs uppercase tracking-wider font-semibold">
                            <th class="py-3 px-6">ID de Pedido</th>
                            <th class="py-3 px-4">Fecha de Compra</th>
                            <th class="py-3 px-4">Productos Pedidos</th>
                            <th class="py-3 px-4 text-center">Total</th>
                            <th class="py-3 px-6 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-pink-50/60 text-[#4a4a4a] text-sm">
                        @forelse ($pedidos_pendientes as $pedido)
                            <tr class="hover:bg-[#faf8f9]/30 transition-colors">
                                <!-- ID -->
                                <td class="py-4 px-6 font-semibold text-[#3a3a3a]">
                                    #{{ $pedido->id_pedido }}
                                </td>
                                <!-- Fecha -->
                                <td class="py-4 px-4 text-[#6e6669]">
                                    {{ $pedido->fecha_compra }}
                                </td>
                                <!-- Productos (Lista interna estilizada) -->
                                <td class="py-4 px-4">
                                    <ul class="space-y-1 text-xs text-[#5c5457]">
                                        @foreach ($pedido->detalle_pedido as $detalle)
                                            <li class="flex items-center gap-1.5">
                                                <span class="inline-flex items-center justify-center px-1.5 py-0.5 bg-purple-50 text-purple-700 rounded-md font-bold text-[10px] border border-purple-100">{{ $detalle->cantidad }}</span>
                                                <span>{{ $detalle->producto->nombre }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <!-- Total -->
                                <td class="py-4 px-4 text-center font-semibold text-[#f381ab] text-base">
                                    ${{ $pedido->total }}
                                </td>
                                <!-- Acciones -->
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-end gap-3">
                                        <!-- Formulario Pagar (Estilo Rosa Cosméticos) -->
                                        <form action="{{ route('pedidos.pagar', $pedido->id_pedido) }}" method="post" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="px-4 py-2 bg-[#f381ab] hover:bg-[#ef6b9d] text-white font-medium text-xs rounded-xl shadow-sm transition-all transform active:scale-95 cursor-pointer">
                                                Pagar
                                            </button>
                                        </form>
                                        <!-- Formulario Cancelar (Estilo Neutral/Suave) -->
                                        <form action="{{ route('pedidos.cancelar', $pedido->id_pedido) }}" method="post" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 text-xs text-[#7c7275] bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-xl font-medium transition-all transform active:scale-95 cursor-pointer">
                                                Cancelar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-10 text-center text-[#8e7f84] italic bg-[#faf8f9]/20">
                                    No tienes pedidos pendientes
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SECCIÓN 2: Pedidos Completados -->
        <div class="bg-white rounded-2xl shadow-xl shadow-pink-100/5 border border-pink-100/40 overflow-hidden">
            <div class="bg-[#faf8f9] px-6 py-4 border-b border-pink-100/40">
                <h3 class="text-lg font-medium text-[#7c7275] tracking-wide">Pedidos Completados</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#faf8f9]/50 border-b border-pink-50 text-[#8e7f84] text-xs uppercase tracking-wider font-medium">
                            <th class="py-3 px-6">ID de Pedido</th>
                            <th class="py-3 px-4">Fecha de Compra</th>
                            <th class="py-3 px-4">Productos Pedidos</th>
                            <th class="py-3 px-6 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-pink-50/40 text-[#5c5457] text-sm">
                        @forelse ($pedidos_completados as $pedido)
                            <tr class="hover:bg-[#faf8f9]/20 transition-colors">
                                <!-- ID -->
                                <td class="py-4 px-6 text-[#7c7275]">
                                    #{{ $pedido->id_pedido }}
                                </td>
                                <!-- Fecha -->
                                <td class="py-4 px-4 text-[#8e7f84]">
                                    {{ $pedido->fecha_compra }}
                                </td>
                                <!-- Productos -->
                                <td class="py-4 px-4">
                                    <ul class="space-y-1 text-xs opacity-80">
                                        @foreach ($pedido->detalle_pedido as $detalle)
                                            <li class="flex items-center gap-1.5">
                                                <span class="text-[#8e7f84] font-medium">{{ $detalle->cantidad }}x</span>
                                                <span>{{ $detalle->producto->nombre }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <!-- Total -->
                                <td class="py-4 px-6 text-right font-medium text-[#3a3a3a]">
                                    ${{ $pedido->total }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-10 text-center text-[#8e7f84] italic">
                                    No tienes pedidos completados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-plantilla>