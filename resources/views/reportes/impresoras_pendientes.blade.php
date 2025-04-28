@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container py-4">
    <h1 class="mb-4 display-5 text-center" style="color: #6f42c1; font-family: 'Nunito', sans-serif; font-weight: 700;">
        Listado de Impresoras Pendientes
    </h1>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-purple text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Impresoras con Tareas Pendientes</h5>
                <span class="badge bg-white text-purple">Total: {{ $impresorasPendientes->count() }}</span>
            </div>
        </div>
        
        @if($impresorasPendientes->count() > 0)
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Modelo</th>
                                <th>Número Serie</th>
                                <th>Fecha Entrada</th>
                                <th>Estado Pendiente</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($impresorasPendientes as $impresora)
                                <tr>
                                    <td>{{ $impresora->modelo }}</td>
                                    <td>{{ $impresora->numero_serie }}</td>
                                    <td>{{ date('d/m/Y', strtotime($impresora->fecha_entrada)) }}</td>
                                    <td>
                                        @if($impresora->estado_pendiente == 'No entregada')
                                            <span class="badge bg-warning text-dark">{{ $impresora->estado_pendiente }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $impresora->estado_pendiente }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="card-body">
                <div class="alert alert-success mb-0">
                    <i class="fas fa-check-circle me-2"></i> No hay impresoras pendientes. ¡Todo está al día!
                </div>
            </div>
        @endif
    </div>
    
    <!-- Información de códigos -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0 text-secondary">Leyenda de Estados</h5>
        </div>
        <div class="card-body">
            <div class="d-flex gap-3">
                <div class="d-flex align-items-center">
                    <span class="badge bg-warning text-dark me-2">No entregada</span>
                    <span>La impresora aún no ha sido entregada al cliente</span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-danger me-2">Pago pendiente</span>
                    <span>El servicio realizado aún no ha sido pagado</span>
                </div>
            </div>
        </div>
    </div>
    
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
