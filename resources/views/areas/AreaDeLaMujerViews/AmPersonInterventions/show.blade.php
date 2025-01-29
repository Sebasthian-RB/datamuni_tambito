@extends('adminlte::page')

@section('title', 'Detalle Relación Persona-Intervención')

@section('content_header')
<!-- Imagen superior -->
<div class="d-flex justify-content-center align-items-center py-3" style="background: #c06c84; border-radius: 0 0 15px 15px;">
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')

<div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    
    <!-- Encabezado con imagen -->
    <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
        <h3 class="card-title mb-0">Detalle de Relación Persona-Intervención</h3>
    </div>

    <!-- Cuerpo de la tarjeta con los detalles -->
    <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
        <div class="row mb-4">
            <!-- Persona -->
            <div class="col-md-6">
                <h5 class="font-weight-bold" style="color: #355c7d;">Persona:</h5>
                <p>{{ $amPersonIntervention->amPerson->given_name }} {{ $amPersonIntervention->amPerson->paternal_last_name }}</p>
            </div>
            
            <!-- Intervención -->
            <div class="col-md-6">
                <h5 class="font-weight-bold" style="color: #355c7d;">Intervención:</h5>
                <p>{{ $amPersonIntervention->intervention->appointment }}</p>
            </div>
        </div>

        <div class="row">
            <!-- Estado -->
            <div class="col-md-6">
                <h5 class="font-weight-bold" style="color: #355c7d;">Estado:</h5>
                <p class="badge {{ $amPersonIntervention->status == 'Completado' ? 'bg-success' : ($amPersonIntervention->status == 'Pendiente' ? 'bg-warning' : 'bg-danger') }}"
                   style="font-size: 16px; padding: 10px; border-radius: 8px;">
                    {{ $amPersonIntervention->status }}
                </p>
            </div>
        </div>
    </div>

    <!-- Pie de página con el botón de volver -->
    <div class="card-footer text-center" style="background: #355c7d; border-radius: 0 0 15px 15px;">
        <a href="{{ route('am_person_interventions.index') }}" class="btn btn-lg btn-light shadow-sm" 
           style="border-radius: 8px; color: #355c7d;">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>
@stop
@section('css')
    <style>
        .card {
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
@stop
