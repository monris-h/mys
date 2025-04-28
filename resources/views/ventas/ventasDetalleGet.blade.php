@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h1 class="display-5 mb-3 text-center" style="color: #6f42c1; font-family: 'Nunito', sans-serif; font-weight: 700;">
                        Detalle de Venta #{{ $venta->id_venta }}
                    </h1>
                    
                    <!-- Estado de pago -->
                    <div class="text-center mb-4">
                        @if($venta->estado_pago)
                            <span class="badge bg-success fs-6 px-4 py-2">Pagado</span>
                        @else
                            <span class="badge bg-warning text-dark fs-6 px-4 py-2">Pendiente</span>
                        @endif
                    </div>

                    <!-- Información general (Resumida en una sola tarjeta) -->
                    <div class="card bg-light mb-4">
                        <div class="card-header bg-purple text-white">
                            <h4 class="mb-0">Información General</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Fecha:</strong> {{ $venta->fecha_venta }}</p>
                                    <p><strong>Método de Pago:</strong> {{ $venta->metodo_pago }}</p>
                                    <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Impresora:</strong> {{ $venta->impresora->modelo }} ({{ $venta->impresora->numero_serie }})</p>
                                    <p><strong>Empleado:</strong> {{ $venta->empleado->nombre }}</p>
                                    <p><strong>Total:</strong> <span class="fw-bold">${{ number_format($venta->monto_total, 2) }}</span></p>
                                </div>
                            </div>
                            
                            @if($factura)
                            <div class="mt-3 pt-3 border-top">
                                <p class="mb-1"><strong>Factura #{{ $factura->id_factura }}</strong> - Emitida: {{ $factura->fecha_emision }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Servicios incluidos - Diseño mejorado -->
                    <div class="card bg-light mb-4">
                        <div class="card-header bg-purple text-white d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Servicios Incluidos</h4>
                            <span class="badge bg-light text-purple">{{ $venta->detallesVenta->count() }} servicios</span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-0 ps-3">Servicio</th>
                                            <th class="border-0 text-end pe-3">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($venta->detallesVenta as $detalle)
                                        <tr>
                                            <td class="ps-3">{{ $detalle->catalogoServicio->diagnostico }}</td>
                                            <td class="text-end pe-3">${{ number_format($detalle->subtotal, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-purple text-white">
                                            <th class="text-end ps-3">Total:</th>
                                            <th class="text-end pe-3">${{ number_format($venta->monto_total, 2) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ url('/ventas') }}" class="btn btn-sm text-white" style="background-color: #6f42c1;">
                            <i class="fas fa-arrow-left me-1"></i> Volver
                        </a>
                        @if(!$venta->estado_pago)
                        <a href="{{ url('/ventas/editar/' . $venta->id_venta) }}" class="btn btn-sm btn-success">
                            <i class="fas fa-check me-1"></i> Registrar Pago
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap');

    :root {
        --theme-purple: #6f42c1;
        --theme-purple-light: #8458d5;
        --theme-purple-dark: #5e35a8;
    }
    
    .bg-purple {
        background-color: #6f42c1;
        color: white;
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 1rem;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(111, 66, 193, 0.15) !important;
    }
</style>
@endsection
