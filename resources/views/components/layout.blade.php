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
        margin-top: 80px; /* Incrementar el margen superior para mayor separación */
    }
</style>
</head>
<body>
@component("components.sidebar")
@endcomponent
<div class="container mt-4">
@section("content")
@show
</div>
</body>
</html>
