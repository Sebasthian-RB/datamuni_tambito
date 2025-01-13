@extends('adminlte::page')

@section('title', 'Lista de Guardianes')

@section('content_header')
<h1>Lista de Guardianes</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <a href="{{ route('guardians.create') }}" class="btn btn-success mb-3">Agregar Nuevo Guardián</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo Documento</th>
                    <th>Nombres</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guardians as $guardian)
                <tr>
                    <td>{{ $guardian->id }}</td>
                    <td>{{ $guardian->document_type }}</td>
                    <td>{{ $guardian->given_name }} {{ $guardian->paternal_last_name }} {{ $guardian->maternal_last_name }}</td>
                    <td>{{ $guardian->phone_number }}</td>
                    <td>
                        <a href="{{ route('guardians.show', $guardian->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('guardians.edit', $guardian->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('guardians.destroy', $guardian->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este guardián?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop