@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container py-4">
    <h1 class="mb-4 display-5 text-center" style="color: #6f42c1; font-family: 'Nunito', sans-serif; font-weight: 700;">
        Informe de Ingresos por Servicios
    </h1>

    <!-- Filtros de fecha -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="{{ url('/reportes/ingresos-servicios') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="fecha_inicio" class="form-label">Fecha Inicial:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" 
                           value="{{ $fechaInicio }}" min="{{ $fechaMin }}" max="{{ $fechaMax }}">
                </div>
                <div class="col-md-5">
                    <label for="fecha_fin" class="form-label">Fecha Final:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" 
                           value="{{ $fechaFin }}" min="{{ $fechaMin }}" max="{{ $fechaMax }}">
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-purple">
                            <i class="fas fa-filter me-2"></i> Filtrar
                        </button>
                        @if($fechaInicio || $fechaFin)
                            <a href="{{ url('/reportes/ingresos-servicios') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i> Limpiar
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Resumen de ingresos -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-purple mb-1">Total de Ingresos</h5>
                            <small class="text-muted">Cantidad total facturada</small>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-0">${{ number_format($totalIngresos, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-purple mb-1">Total de Servicios</h5>
                            <small class="text-muted">Número de servicios realizados</small>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-0">{{ $totalServicios }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de ingresos por servicio -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-purple text-white">
            <h5 class="mb-0">Desglose por Tipo de Servicio</h5>
        </div>
        @if($ingresosPorServicio->count() > 0)
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Servicio</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Ingreso</th>
                                <th class="text-end">% del Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ingresosPorServicio as $servicio)
                                <tr>
                                    <td>{{ $servicio->diagnostico }}</td>
                                    <td class="text-center">{{ $servicio->total_servicios }}</td>
                                    <td class="text-end">${{ number_format($servicio->ingreso_total, 2) }}</td>
                                    <td class="text-end">
                                        {{ number_format(($servicio->ingreso_total / $totalIngresos) * 100, 1) }}%
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-purple" role="progressbar" 
                                                 style="width: {{ ($servicio->ingreso_total / $totalIngresos) * 100 }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr class="fw-bold">
                                <td>TOTAL</td>
                                <td class="text-center">{{ $totalServicios }}</td>
                                <td class="text-end">${{ number_format($totalIngresos, 2) }}</td>
                                <td class="text-end">100%</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @else
            <div class="card-body">
                <div class="alert alert-info mb-0">
                    <i class="fas fa-info-circle me-2"></i> No se encontraron servicios en el período seleccionado.
                </div>
            </div>
        @endif
    </div>
    
    <div class="mt-4">
        <a href="{{ url('/reportes') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Volver a Reportes
        </a>
        
        @if($ingresosPorServicio->count() > 0)
            <button class="btn btn-outline-success ms-2" id="btnExportarExcel">
                <i class="fas fa-file-excel me-2"></i> Exportar a Excel
            </button>
            <button class="btn btn-outline-danger ms-2" id="btnExportarPDF">
                <i class="fas fa-file-pdf me-2"></i> Exportar a PDF
            </button>
        @endif
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validar fechas para que fecha_fin no sea menor a fecha_inicio
        const fechaInicio = document.getElementById('fecha_inicio');
        const fechaFin = document.getElementById('fecha_fin');
        
        fechaInicio.addEventListener('change', function() {
            if (fechaFin.value && fechaInicio.value > fechaFin.value) {
                fechaFin.value = fechaInicio.value;
            }
            fechaFin.min = fechaInicio.value;
        });
        
        // Implementar en una fase futura la exportación a Excel y PDF
        document.getElementById('btnExportarExcel')?.addEventListener('click', function() {
            alert('La exportación a Excel estará disponible próximamente.');
        });
        
        document.getElementById('btnExportarPDF')?.addEventListener('click', function() {
            alert('La exportación a PDF estará disponible próximamente.');
        });
    });
</script>
@endsection
