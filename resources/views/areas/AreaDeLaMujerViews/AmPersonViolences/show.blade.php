@extends('adminlte::page')

@section('title', 'Detalles de Relación de Violencia')

@section('content_header')
    <h1>Detalles de Casos de Personas</h1>
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
            <h3 class="mb-4">Detalles de la Relación de Violencia</h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Persona:</strong></h5>
                    <p>{{ $amPersonViolence->amPerson->given_name }} {{ $amPersonViolence->amPerson->paternal_last_name }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5><strong>Tipo de Violencia:</strong></h5>
                    <p>{{ $amPersonViolence->violence->kind_violence }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Fecha de Registro:</strong></h5>
                    <p>{{ $amPersonViolence->registration_date->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Footer con el botón para regresar -->
        <div class="card-footer text-center">
            <a href="{{ route('am_person_violences.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Volver al listado
            </a>
        </div>
    </div>
</div>
@stop
