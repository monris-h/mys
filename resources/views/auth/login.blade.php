@extends('components.layout')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="display-5 mb-3 text-center" style="color: #6f42c1; font-family: 'Nunito', sans-serif; font-weight: 700;">Iniciar Sesión</h1>

                    <p class="text-muted text-center mb-3">
                        Ingresa tus credenciales para acceder al sistema
                    </p>

                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-purple">Iniciar Sesión</button>
                        </div>

                        <div class="text-center">
                            <a href="{{ url('/') }}" class="btn btn-link text-purple">Regresar al inicio</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <p>¿No tienes cuenta? <a href="{{ route('register') }}" class="text-purple fw-bold">Crear una cuenta</a></p>
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

    .text-purple {
        color: var(--theme-purple) !important;
    }

    .btn-purple {
        background-color: var(--theme-purple);
        border-color: var(--theme-purple);
        color: white;
    }

    .btn-purple:hover {
        background-color: var(--theme-purple-dark);
        border-color: var(--theme-purple-dark);
        color: white;
    }

    .btn-link.text-purple:hover {
        color: var(--theme-purple-dark) !important;
    }

    .form-control:focus {
        border-color: var(--theme-purple-light);
        box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.25);
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(111, 66, 193, 0.15) !important;
    }

    label {
        font-weight: 500;
        color: #555;
    }
</style>
@endsection
