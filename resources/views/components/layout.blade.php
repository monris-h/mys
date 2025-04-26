<!DOCTYPE html>
<html lang="en">
<head>
<!-- importar las librerías de bootstrap -->
<link rel="stylesheet" href={{ URL::asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }} />
<!-- importar los archivos JavaScript de Bootstrap-->
<script src={{ URL::asset('bootstrap-5.3.3-dist/js/bootstrap.min.js') }}></script>
<!-- importar librerías de estilos y javascript de datatables para manipular tablas desde el
navegador del usuario-->
<link href={{ URL::asset('DataTables/datatables.min.css')}} rel="stylesheet"/>
<script src={{ URL::asset('DataTables/datatables.min.js')}}></script>
<link href={{URL::asset("assets/style.css")}} rel="stylesheet" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Taller de impresoras MYS</title>
<style>
    body {
        margin-top: 80px; /* Separación del header */
        background-color: #f8f9fa; /* Fondo claro */
    }
    .card {
        border: none; /* Sin bordes */
        border-radius: 8px; /* Bordes ligeramente redondeados */
        background-color: white; /* Fondo blanco */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra ligera */
        position: relative; /* Asegurar que el panel no interfiera con el dropdown */
        z-index: 1; /* Contexto de apilamiento del panel */
    }
    .card-body {
        padding: 1.5rem; /* Espaciado interno moderado */
    }
    .dropdown-menu {
        border-radius: 8px; /* Bordes redondeados */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra ligera */
        padding: 0.5rem 0; /* Espaciado interno */
        z-index: 1050; /* Asegurar que el dropdown esté sobre el panel */
    }
    .dropdown-item {
        padding: 0.5rem 1rem; /* Espaciado interno de las opciones */
        color: #212529; /* Color del texto */
    }
    .dropdown-item:hover {
        background-color: #f8f9fa; /* Fondo claro al pasar el mouse */
        color: #6f42c1; /* Texto morado al pasar el mouse */
    }
</style>
</head>
<body>
@component("components.sidebar")
@endcomponent
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            @section("content")
            @show
        </div>
    </div>
</div>
</body>
</html>
