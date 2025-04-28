@extends("components.layout")
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h1 class="display-5 mb-4 text-center" style="color: #6f42c1; font-family: 'Nunito', sans-serif; font-weight: 700;">
                        Editar Servicio
                    </h1>

                    <form method="POST" action="{{ url('/catalogos/servicios/editar/' . $servicio->id_CatalogoServicio) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="cantidad_cobrada" class="form-label">Precio servicio:</label>
                            <input type="number" step="0.01" class="form-control @error('cantidad_cobrada') is-invalid @enderror" id="cantidad_cobrada" name="cantidad_cobrada" value="{{ old('cantidad_cobrada', $servicio->cantidad_cobrada) }}" required>
                            @error('cantidad_cobrada')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="diagnostico" class="form-label">Nombre Servicio:</label>
                            <textarea class="form-control @error('diagnostico') is-invalid @enderror" id="diagnostico" name="diagnostico" rows="3" required>{{ old('diagnostico', $servicio->diagnostico) }}</textarea>
                            @error('diagnostico')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="estado_pago" class="form-label">Estado:</label>
                            <select class="form-select @error('estado_pago') is-invalid @enderror" id="estado_pago" name="estado_pago" required>
                                <option value="1" {{ old('estado_pago', $servicio->estado_pago) == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('estado_pago', $servicio->estado_pago) == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado_pago')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ url('/catalogos/servicios') }}" class="btn btn-sm text-white" style="background-color: #6f42c1;">Cancelar</a>
                            <button type="submit" class="btn btn-sm text-white" style="background-color: #6f42c1;">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap');

    :root {
        --theme-purple: #6f42c1;
        --theme-purple-light: #8458d5;
        --theme-purple-dark: #5e35a8;
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

    .form-control:focus {
        border-color: var(--theme-purple-light);
        box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.25);
    }
</style>
@endsection
