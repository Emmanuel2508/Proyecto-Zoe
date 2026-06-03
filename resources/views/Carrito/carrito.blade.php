<x-plantilla>
    <h1>Mi Carrito</h1>
    @if (session('error'))
        <span>{{ session('error') }}</span>
    @endif
    <span>Total de compras: {{ $carrito->subtotal }}</span>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($carrito->detalles_carrito as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->producto->precio }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->subtotal }}</td>
                    <td class="flex">
                        <form action="{{ route('carrito.eliminarDetalle', $detalle->id_detalle) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id_carrito" value="{{ $carrito->id_carrito }}">
                            <button type="submit" class="border border-pink-800 rounded p-1">
                                Eliminar
                            </button>
                        </form>
                        <form action="{{ route('carrito.agregarUno', $carrito->id_carrito) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_productos" value="{{ $detalle->producto->id_productos }}">
                            <button type="submit" class="border border-pink-800 rounded p-1">
                                +
                            </button>
                        </form>
                        @if ($detalle->cantidad > 1)
                            <form action="{{ route('carrito.quitarUno', $carrito->id_carrito) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id_productos" value="{{ $detalle->producto->id_productos }}">
                                <button type="submit" class="border border-pink-800 rounded p-1">
                                    -
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    El carrito está vacío
                </tr>
            @endforelse
        </tbody>
    </table>
    <form action="{{ route('pedidos.confirmar') }}" method="post">
        @csrf
        <button type="submit">
            Confirmar Pedido
        </button>
    </form>
</x-plantilla>