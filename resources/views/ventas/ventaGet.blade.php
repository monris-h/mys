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
        <h1>Ventas</h1>
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
                    placeholder="Buscar por nombre de empleado o ID..." 
                    value="{{ $search ?? '' }}"
                >
                @if(isset($search) && !empty($search))
                    <button type="button" class="btn text-white clear-btn" id="clearSearch">
                        <i class="fas fa-times"></i>
                    </button>
                @endif
            </div>
            <a class="btn btn-purple" href="{{ url('/ventas/agregar') }}">
                <i class="fas fa-plus me-1"></i> Agregar
            </a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped" id="maintable">
        <thead class="bg-purple text-white">
            <tr>
                <th class="text-nowrap" width="40">ID</th>
                <th class="text-nowrap" width="100">ESTADO PAGO</th>
                <th class="text-nowrap" width="100">FECHA</th>
                <th class="text-nowrap" width="120">MÉTODO PAGO</th>
                <th class="text-nowrap" width="100">MONTO</th>
                <th class="text-nowrap">CLIENTE</th>
                <th class="text-nowrap">EMPLEADO</th> 
                <th class="text-nowrap">IMPRESORA</th>
                <th class="text-nowrap" width="180">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ventas as $venta)
            <tr>
                <td class="align-middle">{{ $venta->id_venta }}</td>
                <td class="align-middle">
                    @if($venta->estado_pago)
                        <span class="badge" style="background-color: #6f42c1;">Pagado</span>
                    @else
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    @endif
                </td>
                <td class="align-middle">{{ $venta->fecha_venta }}</td>
                <td class="align-middle">{{ $venta->metodo_pago }}</td>
                <td class="align-middle">${{ number_format($venta->monto_total, 2) }}</td>
                <td class="align-middle text-truncate" style="max-width: 150px;">{{ $venta->cliente->nombre }}</td>
                <td class="align-middle text-truncate" style="max-width: 150px;">{{ $venta->empleado->nombre }}</td>
                <td class="align-middle text-truncate" style="max-width: 150px;">{{ $venta->impresora->modelo }}</td>
                <td class="align-middle text-nowrap">
                    <div class="d-flex gap-1">
                        <a href="{{ url('ventas/detalle/' . $venta->id_venta) }}" class="btn btn-sm text-white" style="background-color: #6f42c1;">Ver Detalle</a>
                        <a href="{{ url('ventas/editar/' . $venta->id_venta) }}" class="btn btn-sm text-white" style="background-color: #6f42c1;">Editar</a>
                        <form method="POST" action="{{ url('ventas/' . $venta->id_venta) }}" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta venta (ID: {{ $venta->id_venta }})? Esta acción no se puede deshacer.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No hay ventas registradas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Clean pagination design -->
    <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-2">
        <div>
            <small class="text-muted">Mostrando {{ $ventas->firstItem() ?? 0 }}-{{ $ventas->lastItem() ?? 0 }} de {{ $ventas->total() }} registros</small>
        </div>
        <nav aria-label="Navegación de ventas">
            {{ $ventas->onEachSide(1)->links('vendor.pagination.custom') }}
        </nav>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    let typingTimer;
    const doneTypingInterval = 500;
    
    function performSearch() {
        const searchTerm = searchInput.value.trim();
        const url = new URL(window.location.href);
        
        if (searchTerm) {
            url.searchParams.set('search', searchTerm);
        } else {
            url.searchParams.delete('search');
        }
        
        window.location.href = url.toString();
    }
    
    searchInput.addEventListener('keyup', function() {
        clearTimeout(typingTimer);
        if (searchInput.value) {
            typingTimer = setTimeout(performSearch, doneTypingInterval);
        }
    });
    
    if (clearSearch) {
        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            performSearch();
        });
    }
    
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
    
    .bg-purple {
        background-color: #6f42c1;
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
    
    /* Table specific styling */
    #maintable th, #maintable td {
        white-space: nowrap;
        vertical-align: middle;
    }
    
    /* For text that needs to be contained */
    .text-truncate {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    /* Ensure buttons stay put */
    #maintable .btn {
        white-space: nowrap;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }
</style>
@endsection
