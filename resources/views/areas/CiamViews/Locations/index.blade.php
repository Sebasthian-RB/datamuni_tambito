@extends('adminlte::page')

@section('title', 'Listado de Ubicaciones')

@section('content_header')
<h1>Ubicaciones</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('locations.create') }}" class="btn btn-primary">Nueva Ubicación</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Región</th>
                    <th>País</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->location_name }}</td>
                    <td>{{ $location->region }}</td>
                    <td>{{ $location->country }}</td>
                    <td>
                        <a href="{{ route('locations.show', $location->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('locations.destroy', $location->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Está seguro de eliminar esta ubicación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop