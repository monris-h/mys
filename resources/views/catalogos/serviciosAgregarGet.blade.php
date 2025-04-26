@extends("components.layout")
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container">
    <h1>Agregar Nuevo Servicio</h1>

    <form method="POST" action="{{ url('/catalogos/servicios/agregar') }}">
        @csrf

        <div class="mb-3">
            <label for="cantidad_cobrada" class="form-label">Cantidad Cobrada:</label>
            <input type="number" step="0.01" class="form-control @error('cantidad_cobrada') is-invalid @enderror" id="cantidad_cobrada" name="cantidad_cobrada" value="{{ old('cantidad_cobrada') }}" required>
            @error('cantidad_cobrada')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="diagnostico" class="form-label">Diagnóstico / Descripción:</label>
            <textarea class="form-control @error('diagnostico') is-invalid @enderror" id="diagnostico" name="diagnostico" rows="3" required>{{ old('diagnostico') }}</textarea>
            @error('diagnostico')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado_pago" class="form-label">Estado del Pago:</label>
            <select class="form-select @error('estado_pago') is-invalid @enderror" id="estado_pago" name="estado_pago" required>
                <option value="Pendiente" {{ old('estado_pago', 'Pendiente') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="Pagado" {{ old('estado_pago') == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                <option value="Cancelado" {{ old('estado_pago') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                {{-- Agrega más estados si los necesitas --}}
            </select>
            @error('estado_pago')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar Servicio</button>
        <a href="{{ url('/catalogos/servicios') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection