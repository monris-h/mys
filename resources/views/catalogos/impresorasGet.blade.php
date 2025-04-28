@extends("components.layout")
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Impresoras</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/impresoras/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead class="bg-purple text-white">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">MODELO</th>
            <th scope="col">NÚMERO DE SERIE</th>
            <th scope="col">FECHA ENTRADA</th>
            <th scope="col">FECHA SALIDA</th>
            <th scope="col">ACCIONES</th> <!-- Nuevo encabezado -->
        </tr>
    </thead>
    <tbody>
        @foreach ($impresoras as $impresora)
            <tr>
                <td>{{ $impresora->id_impresora }}</td>
                <td>{{ $impresora->modelo }}</td>
                <td>{{ $impresora->numero_serie }}</td>
                <td>{{ $impresora->fecha_entrada }}</td>
                <td>{{ $impresora->fecha_salida ?? 'Pendiente' }}</td>
                <td>
                    <a href="{{ url('/catalogos/impresoras/editar/' . $impresora->id_impresora) }}" class="btn btn-sm text-white" style="background-color: #6f42c1;">Editar</a>
                </td> <!-- Botón Editar en morado -->
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
