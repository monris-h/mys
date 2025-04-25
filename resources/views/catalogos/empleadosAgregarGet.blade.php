@extends("components.layout") 
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs]) 
@endcomponent

<div class="container">
    <h1>Agregar Nuevo Empleado</h1>

    <form method="POST" action="{{ url('/catalogos/empleados/agregar') }}">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Completo:</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso:</label>
            <input type="date" class="form-control @error('fecha_ingreso') is-invalid @enderror" id="fecha_ingreso" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}" required>
            @error('fecha_ingreso')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="rol" class="form-label">Rol o Puesto:</label>
            <input type="text" class="form-control @error('rol') is-invalid @enderror" id="rol" name="rol" value="{{ old('rol') }}" required>
            @error('rol')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                <option value="1" {{ old('estado', '1') == '1' ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Si necesitaras un campo para seleccionar el puesto (como en tu ejemplo anterior), lo añadirías aquí --}}

        <button type="submit" class="btn btn-primary">Guardar Empleado</button>
        <a href="{{ url('/catalogos/empleados') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection