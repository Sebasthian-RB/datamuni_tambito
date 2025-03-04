@extends('adminlte::page')

@section('title', 'Detalle de Persona')

@section('content_header')
<!-- Imagen superior -->
<div class="d-flex justify-content-center align-items-center py-3" style="background: #c06c84; border-radius: 0 0 15px 15px;">
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')

<div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    
    <!-- Encabezado -->
    <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
        <h3 class="card-title mb-0">Detalle de Persona</h3>
    </div>

    <!-- Cuerpo de la tarjeta con los detalles -->
    <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
        <h3 class="text-center font-weight-bold" style="color: #355c7d;">
            {{ $amPerson->given_name }} {{ $amPerson->paternal_last_name }} {{ $amPerson->maternal_last_name }}
        </h3>

        <div class="row mt-4">
            <div class="col-md-6">
                <h5 class="font-weight-bold" style="color: #355c7d;">N° Documento:</h5>
                <p>{{ $amPerson->id }}</p>
            </div>
            <div class="col-md-6">
                <h5 class="font-weight-bold" style="color: #355c7d;">Documento de Identidad:</h5>
                <p>{{ $amPerson->identity_document }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5 class="font-weight-bold" style="color: #355c7d;">Sexo:</h5>
                <p>{{ $amPerson->sex_type ? 'Masculino' : 'Femenino' }}</p>
            </div>
            <div class="col-md-6">
                <h5 class="font-weight-bold" style="color: #355c7d;">Dirección:</h5>
                <p>{{ $amPerson->address ?? 'No disponible' }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5 class="font-weight-bold" style="color: #355c7d;">Número de Teléfono:</h5>
                <p>{{ $amPerson->phone_number ?? 'No disponible' }}</p>
            </div>
            <div class="col-md-6">
                <h5 class="font-weight-bold" style="color: #355c7d;">Fecha de Asistencia:</h5>
                <p>{{ $amPerson->attendance_date->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    <!-- Pie de página con el botón de volver -->
    <div class="card-footer text-center" style="background: #355c7d; border-radius: 0 0 15px 15px;">
        <a href="{{ route('am_people.index') }}" class="btn btn-lg btn-light shadow-sm" 
           style="border-radius: 8px; color: #355c7d;">
            <i class="fas fa-arrow-left"></i> Volver al listado
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
