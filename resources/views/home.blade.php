@extends("components.layout")

@section("content")
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 mb-5">
                <div class="card-body p-4 p-md-5">
                    <h1 class="display-4 mb-4 text-center">Bienvenido a Nuestra Plataforma</h1>
                    <p class="lead text-muted">
                        Bienvenido al Sistema de Información para Taller de Impresoras, un proyecto escolar diseñado para optimizar los procesos de registros y generacion de reportes.
                    </p>

                    <div class="mt-5">
                        <div class="access-card">
                            <div class="access-card-left">
                                <div class="icon-container">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <h3>Crea tu cuenta</h3>
                                <p>Registrate y comienza</p>
                                <a href="{{ url('/register') }}" class="btn btn-outline-light rounded-pill px-4">Registrarse</a>
                            </div>
                            <div class="access-card-right">
                                <div class="icon-container">
                                    <i class="fas fa-sign-in-alt"></i>
                                </div>
                                <h3>Bienvenido de vuelta</h3>
                                <p>Continúa donde lo dejaste</p>
                                <a href="{{ url('/login') }}" class="btn btn-light rounded-pill px-4">Iniciar sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm h-100 border-0">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="h3 mb-4">Acerca de Nosotros</h2>
                            <p class="text-muted mb-4">
                                Este sistema de gestión de registros y reportes para taller de impresoras fue desarrollado como parte de la materia Desarrollo e Implementación de Sistemas de Información en el Tecnológico Nacional de México, campus Colima. El proyecto forma parte de nuestra formación académica en la carrera de Ingeniería Informática, y está enfocado en crear una solución integral que optimice los procesos administrativos en talleres dedicados a la reparación y mantenimiento de impresoras.
                            </p>

                            <h4 class="h5 mt-4 mb-3" style="color: var(--theme-purple);">Equipo de Desarrollo</h4>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="team-card text-center">
                                        <i class="fas fa-code mb-3"></i>
                                        <h5><strong style="color: #6f42c1;">Yerik Monroy García</strong></h5>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="team-card text-center">
                                        <i class="fas fa-cogs mb-3"></i>
                                        <h5><strong style="color: #6f42c1;">Erik Alejandro Campos Ahumada</strong></h5>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="team-card text-center">
                                        <i class="fas fa-project-diagram mb-3"></i>
                                        <h5><strong style="color: #6f42c1;">César Rogelio Corona Cortes</strong></h5>
                                    </div>
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

    /* Estilo para los nombres en la sección Acerca de Nosotros */
    .card-body p.text-muted strong {
        color: var(--theme-purple);
        font-weight: 700;
    }

    /* Estilos para las tarjetas del equipo */
    .team-card {
        background-color: rgba(111, 66, 193, 0.05);
        border-radius: 12px;
        height: 160px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
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
</style>
@endsection
