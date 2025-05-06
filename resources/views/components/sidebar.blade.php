<header class="header bg-purple text-white py-3 shadow-sm w-100 position-fixed top-0" style="z-index: 1050;">
    <div class="container d-flex flex-wrap justify-content-between align-items-center">
        <h1 class="h4 mb-0"><a href="{{ url('/homeApp') }}" class="text-white text-decoration-none">Taller MYS</a></h1>
        
        @auth
        <nav class="nav align-items-center">
        <a href="{{ url('/ventas/agregar') }}" class="btn btn-light text-purple me-3">
            <strong>+</strong> Agregar Venta
        </a>

        <form method="POST" action="{{ route('logout') }}" class="ms-3">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-sign-out-alt me-1" style="color: white;"></i>
                 Cerrar Sesión
            </button>
        </form>
    </nav>
        @endauth
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
