@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="bg-light py-2 px-3 mb-3 rounded shadow-sm">
    <div class="d-flex flex-wrap justify-content-center gap-2">
        <a href="{{ url('/catalogos/clientes') }}" class="btn btn-sm {{ request()->is('catalogos/clientes*') ? 'btn-purple' : 'btn-outline-secondary' }}">
            <i class="fas fa-user-friends"></i> Clientes
        </a>
        <a href="{{ url('/catalogos/empleados') }}" class="btn btn-sm {{ request()->is('catalogos/empleados*') ? 'btn-purple' : 'btn-outline-secondary' }}">
            <i class="fas fa-users-cog"></i> Empleados
        </a>
        <a href="{{ url('/catalogos/impresoras') }}" class="btn btn-sm {{ request()->is('catalogos/impresoras*') ? 'btn-purple' : 'btn-outline-secondary' }}">
            <i class="fas fa-print"></i> Impresoras
        </a>
        <a href="{{ url('/catalogos/servicios') }}" class="btn btn-sm {{ request()->is('catalogos/servicios*') ? 'btn-purple' : 'btn-outline-secondary' }}">
            <i class="fas fa-cogs"></i> Servicios
        </a>
        <a href="{{ url('/ventas') }}" class="btn btn-sm {{ request()->is('ventas*') ? 'btn-purple' : 'btn-outline-secondary' }}">
            <i class="fas fa-file-invoice-dollar"></i> Ventas
        </a>
        <a href="{{ url('/reportes') }}" class="btn btn-sm {{ request()->is('reportes*') ? 'btn-purple' : 'btn-outline-secondary' }}">
            <i class="fas fa-chart-bar"></i> Reportes
        </a>
    </div>
</div>

<div class="container py-4">
    <h1 class="mb-4 display-5 text-center" style="color: #6f42c1; font-family: 'Nunito', sans-serif; font-weight: 700;">
        Reportes
    </h1>

    <!-- Reportes del Taller -->
    <div class="mb-4">
        <div class="access-card-compact">
            <div class="icon-container-sm">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div class="content">
                <h3>Reportes del Taller</h3>
                <p>Consulta detallada de informes del taller disponibles a continuación</p>
            </div>
        </div>
    </div>

    <!-- Gráfica de ventas mensuales -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-purple text-white py-3">
            <h5 class="mb-0">Ventas Mensuales - {{ date('Y') }}</h5>
        </div>
        <div class="card-body">
            <canvas id="ventasChart" height="300"></canvas>
        </div>
    </div>

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
    
    /* Estilos para el panel de Reportes del Taller */
    .access-card-compact {
        display: flex;
        align-items: center;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 8px 15px rgba(111, 66, 193, 0.1);
        margin: 20px 0;
        background: linear-gradient(135deg, #6f42c1 0%, #5e35a8 100%);
        color: white;
    }
    
    .icon-container-sm {
        height: 60px;
        width: 60px;
        min-width: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.2);
        margin-right: 20px;
    }
    
    .icon-container-sm i {
        font-size: 1.8rem;
        color: white;
    }
    
    .access-card-compact .content {
        flex: 1;
    }
    
    .access-card-compact h3 {
        font-family: 'Nunito', sans-serif;
        font-weight: 700;
        margin: 0 0 5px;
        font-size: 1.3rem;
    }
    
    .access-card-compact p {
        margin-bottom: 0;
        opacity: 0.9;
        font-size: 1rem;
    }
    
    .bg-purple {
        background-color: #6f42c1;
    }
    
    /* Ajustes para pantallas más pequeñas */
    @media (max-width: 767px) {
        .access-card-compact {
            flex-direction: column;
            text-align: center;
        }
    
        .icon-container-sm {
            margin-right: 0;
            margin-bottom: 15px;
        }
    }
</style>

<!-- Añadir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        try {
            // Datos para la gráfica
            var ventasData = {!! $ventasPorMes !!};
            console.log("Datos de ventas:", ventasData); // Para depuración
            
            // Extracción de datos para Chart.js
            var meses = ventasData.map(item => item.mes);
            var totales = ventasData.map(item => item.total);
            
            // Configuración de la gráfica
            var ctx = document.getElementById('ventasChart').getContext('2d');
            var ventasChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Ventas ($)',
                        data: totales,
                        backgroundColor: 'rgba(111, 66, 193, 0.7)',
                        borderColor: '#6f42c1',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return '$' + context.raw.toLocaleString();
                                }
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        title: {
                            display: false
                        }
                    }
                }
            });
        } catch (error) {
            console.error("Error al crear el gráfico:", error);
            document.getElementById('ventasChart').parentNode.innerHTML = 
                '<div class="alert alert-warning">No se pudieron cargar los datos de ventas. Por favor, intente nuevamente.</div>';
        }
    });
</script>
@endsection
