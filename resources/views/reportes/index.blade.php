@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container py-4">
    <h1 class="mb-4 display-5 text-center" style="color: #6f42c1; font-family: 'Nunito', sans-serif; font-weight: 700;">
        Reportes
    </h1>

    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
        <!-- Reporte 1: Historial de reparaciones -->
        <div class="col">
            <div class="card h-100 shadow-sm hover-card">
                <div class="card-body">
                    <h5 class="card-title text-purple">
                        <i class="fas fa-history me-2"></i>
                        Historial de reparaciones por impresora
                    </h5>
                    <p class="card-text">
                        Un desglose cronológico de todos los servicios realizados a cada equipo.
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ url('/reportes/historial-reparaciones') }}" class="btn btn-sm btn-purple w-100">
                        Ver reporte
                    </a>
                </div>
            </div>
        </div>

        <!-- Reporte 2: Impresoras pendientes -->
        <div class="col">
            <div class="card h-100 shadow-sm hover-card">
                <div class="card-body">
                    <h5 class="card-title text-purple">
                        <i class="fas fa-clock me-2"></i>
                        Listado de impresoras pendientes
                    </h5>
                    <p class="card-text">
                        Un informe de los trabajos que aún no se han concluido, para priorizar la carga de trabajo.
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ url('/reportes/impresoras-pendientes') }}" class="btn btn-sm btn-purple w-100">
                        Ver reporte
                    </a>
                </div>
            </div>
        </div>

        <!-- Reporte 3: Ingresos por servicios -->
        <div class="col">
            <div class="card h-100 shadow-sm hover-card">
                <div class="card-body">
                    <h5 class="card-title text-purple">
                        <i class="fas fa-chart-line me-2"></i>
                        Informe de ingresos por servicios
                    </h5>
                    <p class="card-text">
                        Un resumen económico que consolida los montos cobrados y permite evaluar la rentabilidad del taller.
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ url('/reportes/ingresos-servicios') }}" class="btn btn-sm btn-purple w-100">
                        Ver reporte
                    </a>
                </div>
            </div>
        </div>
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
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(111, 66, 193, 0.15) !important;
    }
</style>
@endsection
