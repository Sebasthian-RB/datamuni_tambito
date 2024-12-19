@extends('adminlte::page')

@section('title', 'Detalles de Asistencia')

@section('content_header')
    <h1>Detalles de Asistencia</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Persona:</strong> {{ $amPersonEvent->amPerson->given_name }} {{ $amPersonEvent->amPerson->paternal_last_name }}</p>
            <p><strong>Evento:</strong> {{ $amPersonEvent->event->name }}</p>
            <p><strong>Estado:</strong> {{ $amPersonEvent->status }}</p>
            <a href="{{ route('am_person_events.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@stop
