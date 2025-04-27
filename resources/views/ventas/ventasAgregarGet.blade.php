@extends('components.layout')
@section('content')
@component('components.breadcrumbs', ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h1 class="display-5 mb-4 text-center" style="color: #6f42c1; font-family: 'Nunito', sans-serif; font-weight: 700;">Agregar Venta</h1>

                    <form action="{{ url('/ventas/agregar') }}" method="POST" id="formVenta">
                        @csrf
                        <div class="row">
                            <!-- Columna izquierda -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_cliente" class="form-label">Cliente *</label>
                                    <select class="form-select" id="id_cliente" name="id_cliente" required>
                                        <option value="">Seleccionar cliente</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }} ({{ $cliente->RFC }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="id_empleado" class="form-label">Empleado *</label>
                                    <select class="form-select" id="id_empleado" name="id_empleado" required>
                                        <option value="">Seleccionar empleado</option>
                                        @foreach($empleados as $empleado)
                                            <option value="{{ $empleado->id_empleado }}">{{ $empleado->nombre }} ({{ $empleado->rol }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="id_impresora" class="form-label">Impresora *</label>
                                    <select class="form-select" id="id_impresora" name="id_impresora" required>
                                        <option value="">Seleccionar impresora</option>
                                        @foreach($impresoras as $impresora)
                                            <option value="{{ $impresora->id_impresora }}">{{ $impresora->modelo }} ({{ $impresora->numero_serie }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Columna derecha -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fecha_venta" class="form-label">Fecha de Venta *</label>
                                    <input type="date" class="form-control" id="fecha_venta" name="fecha_venta" value="{{ date('Y-m-d') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="metodo_pago" class="form-label">Método de Pago *</label>
                                    <select class="form-select" id="metodo_pago" name="metodo_pago" required>
                                        <option value="">Seleccionar método</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Tarjeta">Tarjeta</option>
                                        <option value="Transferencia">Transferencia</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="estado_pago" class="form-label">Estado de Pago *</label>
                                    <select class="form-select" id="estado_pago" name="estado_pago" required>
                                        <option value="1">Pagado</option>
                                        <option value="0">Pendiente</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Sección de servicios -->
                        <h3 class="mt-4 mb-3">Servicios</h3>
                        <div class="table-responsive">
                            <table class="table" id="tablaServicios">
                                <thead class="bg-purple text-white">
                                    <tr>
                                        <th>Servicio</th>
                                        <th>Diagnóstico</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="serviciosBody">
                                    <tr id="filaServicio0">
                                        <td>
                                            <select class="form-select servicio-select" name="servicios[0][id_CatalogoServicio]" required>
                                                <option value="">Seleccionar servicio</option>
                                                @foreach($servicios as $servicio)
                                                    <option value="{{ $servicio->id_CatalogoServicio }}" data-precio="{{ $servicio->cantidad_cobrada }}" data-diagnostico="{{ $servicio->diagnostico }}">
                                                        {{ $servicio->diagnostico }} - ${{ number_format($servicio->cantidad_cobrada, 2) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td id="diagnostico0"></td>
                                        <td>
                                            <input type="number" class="form-control precio-servicio" name="servicios[0][subtotal]" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminarServicio(0)" disabled>
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <button type="button" class="btn btn-purple" onclick="agregarServicio()">
                                <i class="fas fa-plus"></i> Agregar Servicio
                            </button>
                            <div class="text-end">
                                <h4>Total: $<span id="montoTotal">0.00</span></h4>
                                <input type="hidden" name="monto_total" id="montoTotalInput" value="0">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ url('/ventas') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-purple">Guardar Venta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let contadorServicios = 1;

    // Actualizar diagnóstico y precio al seleccionar un servicio
    document.addEventListener('DOMContentLoaded', function() {
        document.body.addEventListener('change', function(e) {
            if (e.target && e.target.classList.contains('servicio-select')) {
                const id = e.target.name.match(/\d+/)[0];
                const option = e.target.options[e.target.selectedIndex];
                const precio = option.dataset.precio || 0;
                const diagnostico = option.dataset.diagnostico || '';

                document.getElementById('diagnostico' + id).textContent = diagnostico;
                const precioInput = e.target.closest('tr').querySelector('.precio-servicio');
                precioInput.value = precio;

                actualizarTotal();
            }
        });
    });

    // Agregar una nueva fila de servicio
    function agregarServicio() {
        // Clonar la primera fila
        const primeraFila = document.querySelector('#serviciosBody tr:first-child');
        const nuevaFila = primeraFila.cloneNode(true);

        // Guardar el ID actual antes de incrementarlo
        const currentId = contadorServicios;

        // Actualizar IDs y atributos
        nuevaFila.id = 'filaServicio' + currentId;

        // Actualizar el select
        const select = nuevaFila.querySelector('.servicio-select');
        select.name = `servicios[${currentId}][id_CatalogoServicio]`;
        select.value = ''; // Resetear selección

        // Actualizar celda de diagnóstico
        const tdDiagnostico = nuevaFila.querySelector('td:nth-child(2)');
        tdDiagnostico.id = `diagnostico${currentId}`;
        tdDiagnostico.textContent = '';

        // Actualizar input de precio
        const inputPrecio = nuevaFila.querySelector('.precio-servicio');
        inputPrecio.name = `servicios[${currentId}][subtotal]`;
        inputPrecio.value = '';

        // Actualizar botón eliminar - Corregido
        const botonEliminar = nuevaFila.querySelector('button');
        botonEliminar.setAttribute('onclick', `eliminarServicio(${currentId})`);
        botonEliminar.disabled = false;
        botonEliminar.className = 'btn btn-purple btn-sm'; // Usar estilo btn-purple consistente

        // Agregar la nueva fila al DOM
        document.getElementById('serviciosBody').appendChild(nuevaFila);
        contadorServicios++;
    }

    // Eliminar fila de servicio
    function eliminarServicio(id) {
        document.getElementById('filaServicio' + id).remove();
        actualizarTotal();
    }

    // Actualizar el monto total
    function actualizarTotal() {
        const precios = document.querySelectorAll('.precio-servicio');
        let total = 0;

        precios.forEach(precio => {
            if (precio.value) {
                total += parseFloat(precio.value);
            }
        });

        document.getElementById('montoTotal').textContent = total.toFixed(2);
        document.getElementById('montoTotalInput').value = total;
    }

    // Validar formulario antes de enviar
    document.getElementById('formVenta').addEventListener('submit', function(e) {
        // Validar que haya al menos un servicio
        const servicios = document.querySelectorAll('.servicio-select');
        let hayServicios = false;

        servicios.forEach(servicio => {
            if (servicio.value) {
                hayServicios = true;
            }
        });

        if (!hayServicios) {
            e.preventDefault();
            alert('Debe agregar al menos un servicio a la venta');
            return;
        }
        
        // Validar que el monto total sea mayor a cero
        const montoTotal = parseFloat(document.getElementById('montoTotalInput').value);
        if (montoTotal <= 0) {
            e.preventDefault();
            alert('El monto total de la venta debe ser mayor a cero');
            return;
        }

        // Reindexar los servicios antes de enviar para evitar problemas con índices no secuenciales
        let nuevoIndice = 0;
        document.querySelectorAll('#serviciosBody tr').forEach(fila => {
            if (fila.style.display !== 'none' && fila.querySelector('.servicio-select').value) {
                const selectServicio = fila.querySelector('.servicio-select');
                const inputPrecio = fila.querySelector('.precio-servicio');
                
                // Guardar los valores actuales
                const servicioId = selectServicio.value;
                const precioServicio = inputPrecio.value;
                
                // Actualizar los nombres con índices secuenciales
                selectServicio.name = `servicios[${nuevoIndice}][id_CatalogoServicio]`;
                inputPrecio.name = `servicios[${nuevoIndice}][subtotal]`;
                
                // Restaurar los valores
                selectServicio.value = servicioId;
                inputPrecio.value = precioServicio;
                
                nuevoIndice++;
            }
        });
    });
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap');

    :root {
        --theme-purple: #6f42c1;
        --theme-purple-light: #8458d5;
        --theme-purple-dark: #5e35a8;
    }
    
    .bg-purple {
        background-color: #6f42c1;
        color: white;
    }
    .text-purple {
        color: #6f42c1;
    }
    .btn-purple {
        background-color: #6f42c1;
        color: white;
    }
    .btn-purple:hover {
        background-color: #5a36a0;
        color: white;
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(111, 66, 193, 0.15) !important;
    }

    h1.display-5 {
        letter-spacing: -0.5px;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--theme-purple-light);
        box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.25);
    }
</style>
@endsection
