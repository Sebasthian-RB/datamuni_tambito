@extends('adminlte::page')

@section('title', 'Lista de Menores')

@section('content_header')
    <h1>Lista de Menores</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('vl_minors.create') }}" class="btn btn-info mb-3">Agregar Menor</a>
    <a href="{{ route('sectors.create') }}" class="btn btn-danger mb-3">Volver</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de menores registrados</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Sexo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vlMinors as $minor)
                        <tr>
                            <td>{{ $minor->id }}</td>
                            <td>{{ $minor->given_name }}</td>
                            <td>{{ $minor->paternal_last_name }}</td>
                            <td>{{ $minor->maternal_last_name }}</td>
                            <td>{{ $minor->birth_date->format('d/m/Y') }}</td>
                            <td>{{ $minor->sex_type == 0 ? 'Femenino' : 'Masculino' }}</td>
                            <td>
                                <a href="{{ route('vl_minors.show', $minor->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('vl_minors.edit', $minor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('vl_minors.destroy', $minor->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
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
