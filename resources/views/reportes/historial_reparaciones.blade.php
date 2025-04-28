@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container py-4">
    <h1 class="mb-4 display-5 text-center" style="color: #6f42c1; font-family: 'Nunito', sans-serif; font-weight: 700;">
        Historial de Reparaciones por Impresora
    </h1>

    <!-- Filtro de impresoras -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="{{ url('/reportes/historial-reparaciones') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="impresora" class="form-label">Filtrar por Impresora:</label>
                    <select name="impresora" id="impresora" class="form-select">
                        <option value="">Seleccionar impresora</option>
                        @foreach($impresoras as $impresora)
                            <option value="{{ $impresora->id_impresora }}" {{ $impresoraSeleccionada == $impresora->id_impresora ? 'selected' : '' }}>
                                {{ $impresora->modelo }} ({{ $impresora->numero_serie }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-purple">
                            <i class="fas fa-filter me-2"></i> Filtrar
                        </button>
                        @if($impresoraSeleccionada)
                            <a href="{{ url('/reportes/historial-reparaciones') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i> Limpiar filtro
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Mensaje inicial -->
    @if(!$impresoraSeleccionada)
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i> Seleccione una impresora para ver su historial de reparaciones.
        </div>
    @endif

    <!-- Resultados - solo se muestran cuando se ha aplicado un filtro -->
    @if($impresoraSeleccionada)
        @if($serviciosPorImpresora->count() > 0)
            @foreach($serviciosPorImpresora as $impresoraId => $servicios)
                @php $primeraImpresora = $servicios->first(); @endphp
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-purple text-white">
                        <h5 class="mb-0">{{ $primeraImpresora->modelo }} ({{ $primeraImpresora->numero_serie }})</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Venta #</th>
                                        <th>Servicio</th>
                                        <th>Cliente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($servicios as $servicio)
                                        <tr>
                                            <td>{{ date('d/m/Y', strtotime($servicio->fecha_venta)) }}</td>
                                            <td>{{ $servicio->id_venta }}</td>
                                            <td>{{ $servicio->diagnostico }}</td>
                                            <td>{{ $servicio->cliente_nombre }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i> La impresora seleccionada no tiene servicios registrados.
            </div>
        @endif
    @endif
    
    <!-- Botón de retorno -->
    <div class="mt-4">
        <a href="{{ url('/reportes') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Volver a Reportes
        </a>
    </div>
</div>

<style>
    .btn-purple {
        background-color: #6f42c1;
        color: white;
    }
    .btn-purple:hover {
        background-color: #5a36a0;
        color: white;
    }
    .text-purple {
        color: #6f42c1;
    }
    .bg-purple {
        background-color: #6f42c1;
    }
</style>
@endsection
