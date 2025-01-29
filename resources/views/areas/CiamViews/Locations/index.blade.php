@extends('adminlte::page')

@section('title', 'Localidades')

@section('content_header')
<h1>Lista de Localidades</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('locations.create') }}" class="btn mb-3" style="background-color: #708F3A; color: white;">Agregar Localidad</a>
    <a href="{{ route('ciamdashboard') }}" class="btn btn-secondary mb-3">Volver</a>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Localidades Registradas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Departamento</th>
                        <th>Provincia</th>
                        <th>Distrito</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                    <tr>
                        <td>{{ $location->id }}</td>
                        <td>{{ $location->department }}</td>
                        <td>{{ $location->province }}</td>
                        <td>{{ $location->district }}</td>
                        <td>
                            <a href="{{ route('locations.show', $location->id) }}" class="btn btn-sm" style="background-color: #708F3A; color: white;">Ver</a>
                            <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-sm" style="background-color: #9CC36A; color: white;">Editar</a>
                            <form action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta localidad?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop