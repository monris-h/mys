@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container">
    <h1>Ventas</h1>

    <div class="text-end mb-3">
    <a class="btn btn-primary" href="{{ url('/ventas/agregar') }}">Agregar</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="bg-purple text-white">
                <tr>
                    <th>ID</th>
                    <th>ESTADO PAGO</th>
                    <th>FECHA</th>
                    <th>MÉTODO PAGO</th>
                    <th>MONTO</th>
                    <th>CLIENTE</th>
                    <th>EMPLEADO</th>
                    <th>IMPRESORA</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ventas as $venta)
                <tr>
                    <td>{{ $venta->id_venta }}</td>
                    <td>
                        @if($venta->estado_pago)
                            <span class="badge bg-success">Pagado</span>
                        @else
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        @endif
                    </td>
                    <td>{{ $venta->fecha_venta }}</td>
                    <td>{{ $venta->metodo_pago }}</td>
                    <td>${{ number_format($venta->monto_total, 2) }}</td>
                    <td>{{ $venta->cliente->nombre }}</td>
                    <td>{{ $venta->empleado->nombre }}</td>
                    <td>{{ $venta->impresora->modelo }}</td>
                    <td>
                        <a href="{{ url('ventas/detalle/' . $venta->id_venta) }}" class="btn btn-sm text-white me-1" style="background-color: #6f42c1;">Ver Detalle</a>
                        <a href="{{ url('ventas/editar/' . $venta->id_venta) }}" class="btn btn-sm text-white" style="background-color: #6f42c1;">Editar</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">No hay ventas registradas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $ventas->links() }}
    </div>
</div>


@endsection
