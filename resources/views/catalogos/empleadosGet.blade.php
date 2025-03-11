@extends("components.layout")
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Empleados</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/empleados/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">TELÉFONO</th>
            <th scope="col">INGRESO</th>
            <th scope="col">ROL</th>
            <th scope="col">ACTIVO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id_empleado }}</td>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->telefono }}</td>
                <td>{{ $empleado->fecha_ingreso }}</td>
                <td>{{ $empleado->rol }}</td>
                <td>{{ $empleado->estado ? 'Sí' : 'No' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
