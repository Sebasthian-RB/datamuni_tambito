@extends('adminlte::page')

@section('title', 'Detalle de Persona')

@section('content_header')
    <h1>Detalle de Persona</h1>
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
            <h3 class="mb-4">{{ $amPerson->given_name }} {{ $amPerson->paternal_last_name }} {{ $amPerson->maternal_last_name }}</h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>N° Documento:</strong></h5>
                    <p>{{ $amPerson->id }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5><strong>Documento de Identidad:</strong></h5>
                    <p>{{ $amPerson->identity_document }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Sexo:</strong></h5>
                    <p>{{ $amPerson->sex_type ? 'Masculino' : 'Femenino' }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5><strong>Dirección:</strong></h5>
                    <p>{{ $amPerson->address ?? 'No disponible' }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Número de Teléfono:</strong></h5>
                    <p>{{ $amPerson->phone_number ?? 'No disponible' }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5><strong>Fecha de Asistencia:</strong></h5>
                    <p>{{ $amPerson->attendance_date->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Fecha de Creación:</strong></h5>
                    <p>{{ $amPerson->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5><strong>Fecha de Actualización:</strong></h5>
                    <p>{{ $amPerson->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Footer con botones de acción -->
        <div class="card-footer text-center">
            <a href="{{ route('am_people.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Volver al listado
            </a>
        </div>
    </div>
</div>
@stop
