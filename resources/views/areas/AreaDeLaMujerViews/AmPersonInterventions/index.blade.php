@extends('adminlte::page')

@section('title', 'Relaciones Persona-Intervención')

@section('content_header')
    <h1>Relaciones Persona-Intervención</h1>
@stop

@section('content')
<div class="container">
    <!-- Botones de acción -->
    <a href="{{ route('am_person_interventions.create') }}" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Crear Relación</a>
    <a href="{{ route('sectors.create') }}" class="btn btn-danger mb-3"><i class="fa fa-arrow-left"></i> Volver</a>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla de datos -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Relaciones Registradas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
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
                        <td>
                            <span class="badge 
                                @if($relation->status == 'En progreso') badge-warning
                                @elseif($relation->status == 'Completado') badge-success
                                @elseif($relation->status == 'Cancelado') badge-danger
                                @else badge-secondary
                                @endif">
                                {{ $relation->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('am_person_interventions.show', $relation->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</a>
                            <a href="{{ route('am_person_interventions.edit', $relation->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
                            <form action="{{ route('am_person_interventions.destroy', $relation->id) }}" method="POST" style="display:inline-block;">
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
</div>
@stop
