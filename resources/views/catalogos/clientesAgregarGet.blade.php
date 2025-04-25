@extends("components.layout")
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container">
    <h1>Agregar Nuevo Cliente</h1>

    <form method="POST" action="{{ url('/catalogos/clientes/agregar') }}">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Completo:</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
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
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="RFC" class="form-label">RFC:</label>
            <input type="text" class="form-control @error('RFC') is-invalid @enderror" id="RFC" name="RFC" value="{{ old('RFC') }}">
            @error('RFC')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cliente</button>
        <a href="{{ url('/catalogos/clientes') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection