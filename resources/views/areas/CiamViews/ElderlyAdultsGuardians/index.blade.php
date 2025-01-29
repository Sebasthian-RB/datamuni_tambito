@extends('adminlte::page')

@section('title', 'Relaciones Adultos Mayores - Guardianes')

@section('content_header')
<h1>Relaciones Adultos Mayores - Guardianes</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('elderly_adult_guardians.create') }}" class="btn btn-success">Nueva Relación</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Adulto Mayor</th>
                    <th>Guardián</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($relations as $relation)
                <tr>
                    <td>{{ $relation->id }}</td>
                    <td>{{ $relation->elderlyAdult->given_name }} {{ $relation->elderlyAdult->paternal_last_name }}</td>
                    <td>{{ $relation->guardian->given_name }} {{ $relation->guardian->paternal_last_name }}</td>
                    <td>
                        <a href="{{ route('elderly_adult_guardians.show', $relation) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('elderly_adult_guardians.edit', $relation) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('elderly_adult_guardians.destroy', $relation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta relación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop