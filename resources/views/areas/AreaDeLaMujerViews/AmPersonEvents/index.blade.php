@extends('adminlte::page')

@section('title', 'Lista de Asistencias')

@section('content_header')
    <h1>Lista de Asistencias</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('am_person_events.create') }}" class="btn btn-primary">Nueva Asistencia</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
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
                            <td>{{ $record->status }}</td>
                            <td>
                                <a href="{{ route('am_person_events.show', $record->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('am_person_events.edit', $record->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('am_person_events.destroy', $record->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
