@extends('adminlte::page')

@section('title', 'Detalle Relación Persona-Intervención')

@section('content_header')
    <h1>Detalle de Relación Persona-Intervención</h1>
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
                    <p>{{ $amPersonIntervention->amPerson->given_name }} {{ $amPersonIntervention->amPerson->paternal_last_name }}</p>
                </div>

                <!-- Columna de la intervención -->
                <div class="col-md-6 mb-3">
                    <h5><strong>Intervención:</strong></h5>
                    <p>{{ $amPersonIntervention->intervention->appointment }}</p>
                </div>
            </div>

            <div class="row">
                <!-- Columna del estado -->
                <div class="col-md-6 mb-3">
                    <h5><strong>Estado:</strong></h5>
                    <p class="badge {{ $amPersonIntervention->status == 'Completada' ? 'bg-success' : ($amPersonIntervention->status == 'Pendiente' ? 'bg-warning' : 'bg-danger') }}">
                        {{ $amPersonIntervention->status }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Pie de página con el botón de volver -->
        <div class="card-footer text-center">
            <a href="{{ route('am_person_interventions.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>
@stop
