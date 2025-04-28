@extends("components.layout") {{-- Usando tu layout --}}
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs]) {{-- Usando tu componente --}}
@endcomponent

<div class="container">
    {{-- El título usa el nombre del cliente que estás editando --}}
    <h1>Editar Cliente: {{ $cliente->nombre }}</h1>

    {{-- El action apunta a la URL de actualización, incluyendo el ID --}}
    <form method="POST" action="{{ url('/catalogos/clientes/editar/' . $cliente->id_cliente . '') }}">
        @csrf {{-- Seguridad esencial --}}
        @method('PUT') {{-- IMPORTANTE: Simula un método PUT para la actualización --}}

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Completo:</label>
            {{-- El value usa old() para mantener datos re-enviados si falla validación,
                 y como segundo parámetro, el valor actual del cliente --}}
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" required>
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $cliente->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="RFC" class="form-label">RFC:</label>
            <input type="text" class="form-control @error('RFC') is-invalid @enderror" id="RFC" name="RFC" value="{{ old('RFC', $cliente->RFC) }}">
            @error('RFC')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
        <a href="{{ url('/catalogos/clientes') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection