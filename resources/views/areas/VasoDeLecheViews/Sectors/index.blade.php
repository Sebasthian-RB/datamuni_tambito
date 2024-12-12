@extends('adminlte::page')

@section('title', 'Sectores')

@section('content_header')
    <h1>Lista de Sectores</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('sectors.create') }}" class="btn btn-success mb-3">Agregar Sector</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Responsable</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sectors as $sector)
                <tr>
                    <td>{{ $sector->id }}</td>
                    <td>{{ $sector->name }}</td>
                    <td>{{ $sector->responsible_person }}</td>
                    <td>
                        <a href="{{ route('sectors.show', $sector->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('sectors.destroy', $sector->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este sector?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
