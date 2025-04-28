@extends('components.layout')
@section('content')
@component('components.breadcrumbs', ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h1 class="display-5 mb-4 text-center" style="color: #6f42c1; font-family: 'Nunito', sans-serif; font-weight: 700;">
                        Editar Venta #{{ $venta->id_venta }}
                    </h1>

                    @if($venta->estado_pago == 0)
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Esta venta está pendiente de pago. Puede cambiar su estado a "Pagado".
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i> Esta venta ya ha sido pagada y no puede ser modificada.
                        </div>
                    @endif

                    <form action="{{ url('/ventas/editar/' . $venta->id_venta) }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <!-- Columna izquierda -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Cliente:</label>
                                    <p class="form-control-plaintext">{{ $venta->cliente->nombre }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Empleado:</label>
                                    <p class="form-control-plaintext">{{ $venta->empleado->nombre }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Impresora:</label>
                                    <p class="form-control-plaintext">{{ $venta->impresora->modelo }} ({{ $venta->impresora->numero_serie }})</p>
                                </div>
                            </div>

                            <!-- Columna derecha -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Fecha de Venta:</label>
                                    <p class="form-control-plaintext">{{ $venta->fecha_venta }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Método de Pago:</label>
                                    <p class="form-control-plaintext">{{ $venta->metodo_pago }}</p>
                                </div>

                                <div class="mb-3">
                                    <label for="estado_pago" class="form-label fw-bold">Estado de Pago:</label>
                                    @if($venta->estado_pago == 0)
                                        <select class="form-select" id="estado_pago" name="estado_pago">
                                            <option value="0" {{ $venta->estado_pago == 0 ? 'selected' : '' }}>Pendiente</option>
                                            <option value="1" {{ $venta->estado_pago == 1 ? 'selected' : '' }}>Pagado</option>
                                        </select>
                                    @else
                                        <p class="form-control-plaintext">
                                            <span class="badge" style="background-color: #6f42c1;">Pagado</span>
                                        </p>
                                        <input type="hidden" name="estado_pago" value="{{ $venta->estado_pago }}">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Sección de servicios -->
                        <h3 class="mt-4 mb-3">Servicios</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-purple text-white">
                                    <tr>
                                        <th>Servicio</th>
                                        <th>Diagnóstico</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($venta->detallesVenta as $detalle)
                                    <tr>
                                        <td>{{ $detalle->catalogoServicio->diagnostico }}</td>
                                        <td>{{ $detalle->catalogoServicio->diagnostico }}</td>
                                        <td>${{ number_format($detalle->subtotal, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-end">Total:</th>
                                        <th>${{ number_format($venta->monto_total, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ url('/ventas') }}" class="btn btn-sm text-white" style="background-color: #6f42c1;">Volver</a>
                            @if($venta->estado_pago == 0)
                                <button type="submit" class="btn btn-sm text-white" style="background-color: #6f42c1;">Guardar Cambios</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap');

    .bg-purple {
        background-color: #6f42c1;
    }
</style>
@endsection
