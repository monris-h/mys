@extends("components.layout")
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Servicios</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/servicios/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">DIAGNÓSTICO</th>
            <th scope="col">MONTO</th>
            <th scope="col">ESTADO</th>
            <th scope="col">ACCIONES</th> <!-- Nuevo encabezado -->
        </tr>
    </thead>
    <tbody>
        @foreach ($servicios as $servicio)
            <tr>
                <td>{{ $servicio->id_CatalogoServicio }}</td>
                <td>{{ $servicio->diagnostico }}</td>
                <td>${{ number_format($servicio->cantidad_cobrada, 2) }}</td>
                <td>{{ $servicio->estado_pago ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <a href="{{ url('/catalogos/servicios/editar/' . $servicio->id_CatalogoServicio) }}" class="btn btn-sm text-white" style="background-color: #6f42c1;">Editar</a>
                </td> <!-- Botón Editar en morado -->
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
