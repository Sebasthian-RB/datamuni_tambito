@extends('adminlte::page')

@section('title', 'Programas Sociales')

@section('content_header')
<h1>Programas Sociales</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('social_programs.create') }}" class="btn btn-primary">Crear Nuevo</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($socialPrograms as $program)
                <tr>
                    <td>{{ $program->id }}</td>
                    <td>{{ $program->name }}</td>
                    <td>
                        <a href="{{ route('social_programs.show', $program) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('social_programs.edit', $program) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('social_programs.destroy', $program) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este programa social?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop