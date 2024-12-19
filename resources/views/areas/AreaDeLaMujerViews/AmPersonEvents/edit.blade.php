@extends('adminlte::page')

@section('title', 'Editar Asistencia')

@section('content_header')
    <h1>Editar Asistencia</h1>
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
            <form action="{{ route('am_person_events.update', $amPersonEvent->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="am_person_id">Persona</label>
                    <select name="am_person_id" id="am_person_id" class="form-control" required>
                        @foreach($people as $person)
                            <option value="{{ $person->id }}" {{ $person->id == $amPersonEvent->am_person_id ? 'selected' : '' }}>
                                {{ $person->given_name }} {{ $person->paternal_last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="event_id">Evento</label>
                    <select name="event_id" id="event_id" class="form-control" required>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ $event->id == $amPersonEvent->event_id ? 'selected' : '' }}>
                                {{ $event->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Asistió" {{ $amPersonEvent->status == 'Asistió' ? 'selected' : '' }}>Asistió</option>
                        <option value="No Asistió" {{ $amPersonEvent->status == 'No Asistió' ? 'selected' : '' }}>No Asistió</option>
                        <option value="Justificado" {{ $amPersonEvent->status == 'Justificado' ? 'selected' : '' }}>Justificado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('am_person_events.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
