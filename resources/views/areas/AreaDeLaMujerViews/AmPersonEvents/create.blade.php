@extends('adminlte::page')

@section('title', 'Nueva Asistencia')

@section('content_header')
    <h1>Nueva Asistencia</h1>
@stop

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('am_person_events.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="am_person_id">Persona</label>
                    <select name="am_person_id" id="am_person_id" class="form-control" required>
                        <option value="">Seleccione una persona</option>
                        @foreach($people as $person)
                            <option value="{{ $person->id }}">{{ $person->given_name }} {{ $person->paternal_last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="event_id">Evento</label>
                    <select name="event_id" id="event_id" class="form-control" required>
                        <option value="">Seleccione un evento</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Seleccione un estado</option>
                        <option value="Asistió">Asistió</option>
                        <option value="No Asistió">No Asistió</option>
                        <option value="Justificado">Justificado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('am_person_events.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
