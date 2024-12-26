@extends('adminlte::page')

@section('title', 'Lista de Asistencias')

@section('content_header')
    <h1>Lista de Asistencias</h1>
@stop

@section('content')
<div class="container">
    <!-- Botones de acción -->
    <a href="{{ route('am_person_events.create') }}" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Nueva Asistencia</a>
    <a href="{{ route('sectors.create') }}" class="btn btn-danger mb-3">Volver</a>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla de datos -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Asistencias Registradas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Persona</th>
                        <th>Evento</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personEvents as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->amPerson->given_name }} {{ $record->amPerson->paternal_last_name }}</td>
                            <td>{{ $record->event->name }}</td>
                            <td>
                                <span class="badge {{ $record->status === 'Asistió' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $record->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('am_person_events.show', $record->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</a>
                                <a href="{{ route('am_person_events.edit', $record->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                <form action="{{ route('am_person_events.destroy', $record->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta asistencia?')"><i class="fa fa-trash"></i> Eliminar</button>
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
