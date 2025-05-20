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
                        Editar Cliente
                    </h1>

                    <form method="POST" action="{{ url('/catalogos/clientes/editar/' . $cliente->id_cliente) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo:</label>
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
                            <input type="text" class="form-control @error('RFC') is-invalid @enderror" id="RFC" name="RFC" value="{{ old('RFC', $cliente->RFC) }}" maxlength="13" pattern="[A-Za-z0-9]{1,13}" title="El RFC debe contener máximo 13 caracteres alfanuméricos">
                            <small class="text-muted">Máximo 13 caracteres alfanuméricos</small>
                            @error('RFC')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ url('/catalogos/clientes') }}" class="btn btn-sm text-white" style="background-color: #6f42c1;">Cancelar</a>
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