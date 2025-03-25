@extends('adminlte::page')

@section('title', 'Detalles de Relación de Violencia')

@section('content_header')
    <!-- Imagen superior -->
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #c06c84; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
@stop

@section('content')

    <div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">

        <!-- Encabezado -->
        <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
            <h3 class="card-title mb-0">Detalles de Relación de Violencia</h3>
        </div>

        <!-- Cuerpo de la tarjeta con los detalles -->
        <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
            <h3 class="text-center font-weight-bold" style="color: #355c7d;">
                Detalles de Violencia
            </h3>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Persona:</h5>
                    <p>{{ $amPersonViolence->amPerson->given_name }} {{ $amPersonViolence->amPerson->paternal_last_name }}
                    </p>
                </div>
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Tipo de Violencia:</h5>
                    <p>{{ $amPersonViolence->violence->kind_violence }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Fecha de Registro:</h5>
                    <p>{{ $amPersonViolence->registration_date->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Pie de página con el botón de regresar -->
        <div class="card-footer text-center" style="background: #355c7d; border-radius: 0 0 15px 15px;">
            <a href="{{ route('am_person_violences.index') }}" class="btn btn-lg btn-light shadow-sm"
                style="border-radius: 8px; color: #355c7d;">
                <i class="fas fa-arrow-left"></i> Volver al listado
            </a>
        </div>
    </div>

@stop

@section('css')
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <style>
        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
@stop
