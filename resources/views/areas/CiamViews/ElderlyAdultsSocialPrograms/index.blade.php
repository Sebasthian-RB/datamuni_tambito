@extends('adminlte::page')

@section('title', 'Relaciones Adulto Mayor - Programas Sociales')

@section('content_header')
<h1>Relaciones Adulto Mayor y Programas Sociales</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('elderly_adult_social_programs.create') }}" class="btn btn-primary">Crear Relación</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Adulto Mayor</th>
                    <th>Programa Social</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($relations as $relation)
                <tr>
                    <td>{{ $relation->id }}</td>
                    <td>
                        {{ $relation->elderlyAdult->given_name }} {{ $relation->elderlyAdult->paternal_last_name }}
                    </td>
                    <td>{{ $relation->socialProgram->social_programs_name }}</td>
                    <td>
                        <a href="{{ route('elderly_adult_social_programs.show', $relation->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('elderly_adult_social_programs.edit', $relation->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('elderly_adult_social_programs.destroy', $relation->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop