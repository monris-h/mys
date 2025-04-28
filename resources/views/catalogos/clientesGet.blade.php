@extends("components.layout")
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<!-- Acciones Rápidas -->
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
    </div>
</div>

<div class="row my-4">
    <div class="col-md-6">
        <h1>Clientes</h1>
    </div>
    <div class="col-md-6">
        <div class="d-flex justify-content-end gap-2">
            <div class="input-group search-container">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-purple"></i>
                </span>
                <input 
                    type="text" 
                    id="searchInput" 
                    class="form-control border-start-0" 
                    placeholder="Buscar por nombre o RFC..." 
                    value="{{ $search ?? '' }}"
                >
                @if(isset($search) && !empty($search))
                    <button type="button" class="btn text-white clear-btn" id="clearSearch">
                        <i class="fas fa-times"></i>
                    </button>
                @endif
            </div>
            <a class="btn btn-purple" href="{{ url('/catalogos/clientes/agregar') }}">
                <i class="fas fa-plus me-1"></i> Agregar
            </a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table" id="maintable">
        <thead class="bg-purple text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">TELÉFONO</th>
                <th scope="col">EMAIL</th>
                <th scope="col">RFC</th>
                <th scope="col">ACCIONES</th> <!-- Nuevo encabezado -->
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id_cliente }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->RFC }}</td>
                    <td>
                        <a href="{{ url('/catalogos/clientes/editar/' . $cliente->id_cliente) }}" class="btn btn-sm text-white" style="background-color: #6f42c1;">Editar</a>
                    </td> <!-- Botón Editar en morado -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Clean pagination design -->
<div class="d-flex justify-content-between align-items-center border-top pt-3 mt-2">
    <div>
        <small class="text-muted">Mostrando {{ $clientes->firstItem() ?? 0 }}-{{ $clientes->lastItem() ?? 0 }} de {{ $clientes->total() }} registros</small>
    </div>
    <nav aria-label="Navegación de clientes">
        {{ $clientes->onEachSide(1)->links('vendor.pagination.custom') }}
    </nav>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    const table = document.getElementById('maintable');
    let typingTimer;
    const doneTypingInterval = 500; // Espera medio segundo después de que el usuario deja de escribir
    
    // Función para realizar la búsqueda
    function performSearch() {
        const searchTerm = searchInput.value.trim();
        
        // Crear la URL con el parámetro de búsqueda
        const url = new URL(window.location.href);
        
        if (searchTerm) {
            url.searchParams.set('search', searchTerm);
        } else {
            url.searchParams.delete('search');
        }
        
        // Redirigir a la nueva URL
        window.location.href = url.toString();
    }
    
    // Evento keyup para detectar cuando el usuario escribe
    searchInput.addEventListener('keyup', function() {
        clearTimeout(typingTimer);
        if (searchInput.value) {
            typingTimer = setTimeout(performSearch, doneTypingInterval);
        }
    });
    
    // Si hay un botón de limpiar, añadirle evento
    if (clearSearch) {
        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            performSearch();
        });
    }
    
    // Manejar la tecla Enter para realizar búsqueda inmediata
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(typingTimer);
            performSearch();
        }
    });
});
</script>

<style>
    .btn-purple {
        background-color: #6f42c1;
        color: white;
    }
    .btn-purple:hover {
        background-color: #5a36a0;
        color: white;
    }
    
    /* Revised search container styling */
    .search-container {
        width: 300px;
        position: relative;
    }
    
    .search-container .input-group-text {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
        border-right: none;
    }
    
    .search-container .form-control {
        border-left: none;
        padding-left: 0;
    }
    
    .search-container .form-control:focus {
        box-shadow: none;
        border-color: #ced4da;
    }
    
    .search-container .clear-btn {
        background-color: #6f42c1;
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
        border: none;
    }
    
    .text-purple {
        color: #6f42c1;
    }
</style>

@endsection
