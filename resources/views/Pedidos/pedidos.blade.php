<x-plantilla>
    <h1>Mis pedidos</h1>

    <div>
        <h3>Pedidos pendientes</h3>
        <table>
            <thead>
                <tr>
                    <th>ID de Pedido</th>
                    <th>Fecha de Compra</th>
                    <th>Productos Pedidos</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pedidos_pendientes as $pedido)
                    <tr>
                        <td>{{ $pedido->id_pedido }}</td>
                        <td>{{ $pedido->fecha_compra }}</td>
                        <td>
                            <ul>
                                @foreach ($pedido->detalle_pedido as $detalle)
                                    <li>{{ $detalle->cantidad }} {{ $detalle->producto->nombre }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>${{ $pedido->total }}</td>
                        <td>
                            <form action="{{ route('pedidos.pagar', $pedido->id_pedido) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit">
                                    Pagar
                                </button>
                            </form>
                            <form action="{{ route('pedidos.cancelar', $pedido->id_pedido) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    Cancelar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        No tienes pedidos pendientes :D
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        <h3>Pedidos completados</h3>
        <table>
            <thead>
                <tr>
                    <th>ID de Pedido</th>
                    <th>Fecha de Compra</th>
                    <th>Productos Pedidos</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pedidos_completados as $pedido)
                    <tr>
                        <td>{{ $pedido->id_pedido }}</td>
                        <td>{{ $pedido->fecha_compra }}</td>
                        <td>
                            <ul>
                                @foreach ($pedido->detalle_pedido as $detalle)
                                    <li>{{ $detalle->cantidad }} {{ $detalle->producto->nombre }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>${{ $pedido->total }}</td>
                    </tr>
                @empty
                    <tr>
                        No tienes pedidos completados
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-plantilla>