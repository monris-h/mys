@extends("components.layout")

@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Bienvenido a Nuestra Plataforma</h1>
            <p>
                Esta es la plataforma donde podrás encontrar información, servicios y funcionalidades diseñadas para ayudarte, tanto si estás registrado como si no.
            </p>
            <p>
                Si eres nuevo, te invitamos a <a href="{{ url('/register') }}">registrarte</a> para aprovechar todas las ventajas y acceder a contenido exclusivo.
            </p>
            <p>
                Si ya tienes una cuenta, puedes <a href="{{ url('/login') }}">iniciar sesión</a> para personalizar tu experiencia.
            </p>
            <hr>
            <h2>Acerca de Nosotros</h2>
            <p>
                Aquí encontrarás toda la información relativa a nuestros servicios, nuestro equipo y nuestra misión. En nuestra plataforma valoramos la seguridad y la experiencia del usuario, ofreciendo herramientas intuitivas y actualizadas.
            </p>
            <h2>Navegación</h2>
            <ul>
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <li><a href="{{ url('/catalogos/clientes') }}">Clientes</a></li>
                <li><a href="{{ url('/catalogos/empleados') }}">Empleados</a></li>
                <li><a href="{{ url('/catalogos/impresoras') }}">Impresoras</a></li>
                <li><a href="{{ url('/catalogos/servicios') }}">Servicios</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection