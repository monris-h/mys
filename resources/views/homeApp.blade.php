@extends("components.layout")

@section("content")
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h1 class="display-5 mb-3 text-center">Bienvenido: {{ Auth::user()->name }}</h1>
                    <br>
                    <!-- Acciones Rápidas (Movido hacia arriba) -->
                    <h2 class="h4 mb-3 mt-2">Acciones Rápidas</h2>
                    <div class="row">
                        <div class="col-md col-12 mb-3">
                            <div class="team-card text-center">
                                <i class="fas fa-user-friends mb-2"></i>
                                <h5><a href="{{ url('/catalogos/clientes') }}"><strong style="color: #6f42c1;">Clientes</strong></a></h5>
                            </div>
                        </div>
                        <div class="col-md col-12 mb-3">
                            <div class="team-card text-center">
                                <i class="fas fa-users-cog mb-2"></i>
                                <h5><a href="{{ url('/catalogos/empleados') }}"><strong style="color: #6f42c1;">Empleados</strong></a></h5>
                            </div>
                        </div>
                        <div class="col-md col-12 mb-3">
                            <div class="team-card text-center">
                                <i class="fas fa-print mb-2"></i>
                                <h5><a href="{{ url('/catalogos/impresoras') }}"><strong style="color: #6f42c1;">Impresoras</strong></a></h5>
                            </div>
                        </div>
                        <div class="col-md col-12 mb-3">
                            <div class="team-card text-center">
                                <i class="fas fa-cogs mb-2"></i>
                                <h5><a href="{{ url('/catalogos/servicios') }}"><strong style="color: #6f42c1;">Servicios</strong></a></h5>
                            </div>
                        </div>
                        <div class="col-md col-12 mb-3">
                            <div class="team-card text-center">
                                <i class="fas fa-chart-line mb-2"></i>
                                <h5><a href="{{ url('/reportes') }}"><strong style="color: #6f42c1;">Reportes</strong></a></h5>
                            </div>
                        </div>
                        <div class="col-md col-12 mb-3">
                            <div class="team-card text-center">
                                <i class="fas fa-file-invoice-dollar mb-2"></i>
                                <h5><a href="{{ url('/ventas') }}"><strong style="color: #6f42c1;">Ventas</strong></a></h5>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Métricas rápidas -->
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <div class="card bg-white shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <div class="display-4 text-purple">${{ number_format($ventasMesActual, 0) }}</div>
                                    <h5 class="text-muted">Ventas de {{ $mesActualNombre }} {{ $añoActual }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card bg-white shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <div class="display-4 text-purple">${{ number_format($totalHistorico, 0) }}</div>
                                    <h5 class="text-muted">Total Ventas</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card bg-white shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <div class="display-4 text-purple">{{ $ventasPendientes }}</div>
                                    <h5 class="text-muted">Pagos Pendientes</h5>
                                </div>
                            </div>
                        </div>
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

    /* Estilos para las nuevas tarjetas de acceso */
    .access-card {
        display: flex;
        flex-direction: row;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(111, 66, 193, 0.15);
        margin: 30px 0;
        min-height: 300px;
    }

    .access-card-left, .access-card-right {
        flex: 1;
        padding: 3rem 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .access-card-left {
        background: linear-gradient(135deg, var(--theme-purple) 0%, var(--theme-purple-dark) 100%);
        color: white;
    }

    .access-card-right {
        background-color: white;
        color: var(--theme-purple-dark);
    }

    .access-card h3 {
        font-family: 'Nunito', sans-serif;
        font-weight: 700;
        margin: 15px 0 10px;
    }

    .access-card p {
        margin-bottom: 25px;
        opacity: 0.9;
        font-size: 1.1rem;
    }

    .icon-container {
        height: 80px;
        width: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .access-card-left .icon-container {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .access-card-right .icon-container {
        background-color: rgba(111, 66, 193, 0.1);
    }

    .access-card i {
        font-size: 2.5rem;
        color: inherit;
    }

    .access-card-right i {
        color: var(--theme-purple);
    }

    .btn-outline-light:hover {
        background-color: white !important;
        color: var(--theme-purple) !important;
    }

    .access-card-right .btn {
        color: white;
        background-color: var(--theme-purple);
        border-color: var(--theme-purple);
    }

    .access-card-right .btn:hover {
        background-color: var(--theme-purple-dark);
        border-color: var(--theme-purple-dark);
    }

    /* Responsive */
    @media (max-width: 767px) {
        .access-card {
            flex-direction: column;
        }

        .access-card-left, .access-card-right {
            padding: 2rem;
        }
    }

    h1.display-4 {
        font-family: 'Nunito', sans-serif;
        font-weight: 700;
        letter-spacing: -0.5px;
        color: var(--theme-purple);
    }

    .btn-primary {
        background-color: var(--theme-purple) !important;
        border-color: var(--theme-purple) !important;
    }

    .btn-primary:hover, .btn-primary:focus {
        background-color: var(--theme-purple-dark) !important;
        border-color: var(--theme-purple-dark) !important;
    }

    .btn-outline-primary {
        color: var(--theme-purple) !important;
        border-color: var(--theme-purple) !important;
    }

    .btn-outline-primary:hover, .btn-outline-primary:focus {
        background-color: var(--theme-purple) !important;
        color: white !important;
    }

    .list-group-item-action:hover {
        padding-left: 5px;
        color: var(--theme-purple) !important;
        background-color: rgba(111, 66, 193, 0.05);
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(111, 66, 193, 0.15) !important;
    }

    .card .card-body h2 {
        color: var(--theme-purple);
        border-bottom: 2px solid rgba(111, 66, 193, 0.2);
        padding-bottom: 8px;
        display: inline-block;
    }

    .fas {
        color: var(--theme-purple);
    }

    .card-body a:not(.btn) {
        color: var(--theme-purple);
        text-decoration: none;
    }

    .card-body a:not(.btn):hover {
        color: var(--theme-purple-dark);
        text-decoration: underline;
    }

    /* Estilos para las tarjetas del equipo */
    .team-card {
        background-color: rgba(111, 66, 193, 0.05);
        border-radius: 12px;
        height: 120px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .team-card:hover {
        background-color: rgba(111, 66, 193, 0.1);
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(111, 66, 193, 0.1);
    }

    .team-card i {
        font-size: 2.5rem;
        color: var(--theme-purple);
        margin-bottom: 15px;
    }

    .team-card h5 {
        margin-bottom: 0;
    }

    /* Versión compacta para tarjeta de Ventas */
    .access-card-compact {
        display: flex;
        align-items: center;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 8px 15px rgba(111, 66, 193, 0.1);
        margin: 20px 0;
        background: linear-gradient(135deg, var(--theme-purple) 0%, var(--theme-purple-dark) 100%);
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

    .access-card-compact .action {
        margin-left: 20px;
    }

    .access-card-compact .btn {
        background-color: white;
        color: var(--theme-purple);
        border-color: white;
        font-weight: 600;
    }

    .text-purple {
        color: var(--theme-purple) !important;
    }

    .access-card-compact .btn:hover {
        background-color: rgba(255, 255, 255, 0.9);
        border-color: rgba(255, 255, 255, 0.9);
    }

    /* Más compacto para las acciones rápidas */
    .team-card {
        height: 120px;
        padding: 1.5rem;
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

        .access-card-compact .action {
            margin-left: 0;
            margin-top: 15px;
        }
    }
</style>
@endsection
