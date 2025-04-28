@extends("components.layout") {{-- Usando tu layout --}}
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs]) {{-- Usando tu componente --}}
@endcomponent

<div class="container">
    {{-- Título dinámico con el nombre del empleado --}}
    <h1>Editar Empleado: {{ $empleado->nombre }}</h1>

    {{-- El action incluye el ID del empleado --}}
    <form method="POST" action="{{ url('/catalogos/empleados/editar/' . $empleado->id_empleado . '') }}">
        @csrf {{-- Seguridad --}}
        @method('PUT') {{-- Simula método PUT para la actualización --}}

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Completo:</label>
            {{-- Usa old() y el valor actual del empleado para el value --}}
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $empleado->nombre) }}" required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso:</label>
            <input type="date" class="form-control @error('fecha_ingreso') is-invalid @enderror" id="fecha_ingreso" name="fecha_ingreso" value="{{ old('fecha_ingreso', $empleado->fecha_ingreso) }}" required>
            @error('fecha_ingreso')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', $empleado->telefono) }}" required>
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="rol" class="form-label">Rol o Puesto:</label>
            <input type="text" class="form-control @error('rol') is-invalid @enderror" id="rol" name="rol" value="{{ old('rol', $empleado->rol) }}" required>
            @error('rol')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            {{-- El select necesita lógica para marcar como 'selected' la opción correcta --}}
            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                {{-- Comprueba el valor "viejo" o el valor actual del empleado para 'selected' --}}
                <option value="1" {{ old('estado', $empleado->estado) == '1' ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado', $empleado->estado) == '0' ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Si tuvieras campos adicionales relacionados (como cambiar el puesto), irían aquí --}}

        <button type="submit" class="btn btn-primary">Actualizar Empleado</button>
        <a href="{{ url('/catalogos/empleados') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection