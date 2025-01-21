@extends('adminlte::page')

@section('title', 'Detalles de Asistencia')

@section('content_header')
    <h1>Detalles de Asistencia</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <!-- Header con la imagen -->
        <div class="card-header bg-success p-0 d-flex justify-content-center align-items-center" style="height: 60px;">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="height: 80%; width: auto;">
        </div>

        <!-- Cuerpo de la tarjeta con los detalles -->
        <div class="card-body">
            <div class="row">
                <!-- Columna de la persona -->
                <div class="col-md-6 mb-3">
                    <h5><strong>Persona:</strong></h5>
                    <p>{{ $amPersonEvent->amPerson->given_name }} {{ $amPersonEvent->amPerson->paternal_last_name }}</p>
                </div>

                <!-- Columna del evento -->
                <div class="col-md-6 mb-3">
                    <h5><strong>Evento:</strong></h5>
                    <p>{{ $amPersonEvent->event->name }}</p>
                </div>
            </div>

            <div class="row">
                <!-- Columna del estado -->
                <div class="col-md-6 mb-3">
                    <h5><strong>Estado:</strong></h5>
                    <p class="badge {{ $amPersonEvent->status == 'Asistió' ? 'bg-success' : ($amPersonEvent->status == 'No Asistió' ? 'bg-danger' : 'bg-warning') }}">
                        {{ $amPersonEvent->status }}
                    </p>
                </div>

                <!-- Columna de la fecha y hora -->
                <div class="col-md-6 mb-3">
                    <h5><strong>Fecha y Hora de Asistencia:</strong></h5>
                    <p>{{ $amPersonEvent->attendance_datetime ? $amPersonEvent->attendance_datetime->format('d/m/Y h:i A') : 'No especificada' }}</p>
                </div>
            </div>
        </div>

        <!-- Pie de página con el botón de volver -->
        <div class="card-footer text-center">
            <a href="{{ route('am_person_events.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>
@stop
