@extends('components.layout')

@section('content')
    <div class="row my-4">
        <h1>Iniciar Sesión</h1>
    </div>

    <div class="row my-4">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </form>

                    <div class="mt-3 text-center">
                        <p>¿No tienes cuenta? 
                            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">
                                Crear una cuenta
                            </a>
                        </p>
                    </div>
                    <div class="mt-3 text-center">
                        <p>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm">
                                Regresar
                            </a>
                        </p>
                </div>
            </div>
        </div>
    </div>
@endsection
