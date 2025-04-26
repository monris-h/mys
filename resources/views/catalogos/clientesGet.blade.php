@extends("components.layout")
@section("content")

@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Clientes</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/clientes/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead class="bg-purple text-white">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">TELÉFONO</th>
            <th scope="col">EMAIL</th>
            <th scope="col">RFC</th>
            <th scope="col">ACCIONES</th> <!-- Nuevo encabezado -->
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id_cliente }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->RFC }}</td>
                <td>
                    <a href="{{ url('/catalogos/clientes/editar/' . $cliente->id_cliente) }}" class="btn btn-sm text-white" style="background-color: #6f42c1;">Editar</a>
                </td> <!-- Botón Editar en morado -->
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
