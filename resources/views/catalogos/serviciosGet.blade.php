@extends("components.layout")
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Servicios</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/empleados/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">SERVICIO</th>
            <th scope="col">COSTO</th>
            <th scope="col">ACTIVO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($servicios as $servicio)
            <tr>
                <td>{{ $servicio->id_CatalogoServicio }}</td>
                <td>{{ $servicio->diagnostico }}</td>
                <td>${{ number_format($servicio->cantidad_cobrada, 2) }}</td>
                <td>{{ $servicio->estado_pago ? 'Sí' : 'No' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
