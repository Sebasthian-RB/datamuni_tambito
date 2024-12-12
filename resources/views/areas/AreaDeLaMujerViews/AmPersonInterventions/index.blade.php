@extends('adminlte::page')

@section('title', 'Relaciones Persona-Intervención')

@section('content_header')
    <h1>Relaciones Persona-Intervención</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('am_person_interventions.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Relación</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Persona</th>
                    <th>Intervención</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($amPersonInterventions as $relation)
                <tr>
                    <td>{{ $relation->id }}</td>
                    <td>{{ $relation->amPerson->given_name }} {{ $relation->amPerson->paternal_last_name }}</td>
                    <td>{{ Str::limit($relation->intervention->appointment, 50) }}</td>
                    <td>{{ $relation->status }}</td>
                    <td>
                        <a href="{{ route('am_person_interventions.show', $relation->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</a>
                        <a href="{{ route('am_person_interventions.edit', $relation->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
                        <form action="{{ route('am_person_interventions.destroy', $relation->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">
                                <i class="fa fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
