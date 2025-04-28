<header class="header bg-purple text-white py-3 shadow-sm w-100 position-fixed top-0" style="z-index: 1050;">
    <div class="container d-flex flex-wrap justify-content-between align-items-center">
        <h1 class="h4 mb-0"><a href="{{ url('/homeApp') }}" class="text-white text-decoration-none">Taller MYS</a></h1>
        <nav class="nav">
            <!-- Botón para Agregar Venta -->
            <a href="{{ url('/ventas/agregar') }}" class="btn btn-light text-purple me-3">
                <strong>+</strong> Agregar Venta
            </a>
            <!-- Botón dropdown para Opciones -->
            <div class="dropdown ms-3">
                <button class="btn btn-light text-purple dropdown-toggle" type="button" id="opcionesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Opciones
                </button>
                <ul class="dropdown-menu" aria-labelledby="opcionesDropdown">
                    <li><a class="dropdown-item" href="{{ url('/reportes') }}">Reportes</a></li>
                    <li>
                        <a class="dropdown-item text-danger text-decoration-underline" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Salir
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<style>
    .bg-purple {
        background-color: #6f42c1; /* Color morado */
    }
    .text-purple {
        color: #6f42c1; /* Color morado */
    }
</style>
<!-- Incluir los scripts necesarios de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
