@extends("components.layout")
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container">
    <h1>Agregar Nueva Impresora</h1>

    <form method="POST" action="{{ url('/catalogos/impresoras/agregar') }}">
        @csrf

        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo:</label>
            <input type="text" class="form-control @error('modelo') is-invalid @enderror" id="modelo" name="modelo" value="{{ old('modelo') }}" required>
            @error('modelo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="numero_serie" class="form-label">Número de Serie:</label>
            <input type="text" class="form-control @error('numero_serie') is-invalid @enderror" id="numero_serie" name="numero_serie" value="{{ old('numero_serie') }}" required>
            @error('numero_serie')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_entrada" class="form-label">Fecha de Entrada:</label>
            <input type="date" class="form-control @error('fecha_entrada') is-invalid @enderror" id="fecha_entrada" name="fecha_entrada" value="{{ old('fecha_entrada') }}" required>
            @error('fecha_entrada')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_salida" class="form-label">Fecha de Salida (Opcional):</label>
            <input type="date" class="form-control @error('fecha_salida') is-invalid @enderror" id="fecha_salida" name="fecha_salida" value="{{ old('fecha_salida') }}">
            @error('fecha_salida')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar Impresora</button>
        <a href="{{ url('/catalogos/impresoras') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection