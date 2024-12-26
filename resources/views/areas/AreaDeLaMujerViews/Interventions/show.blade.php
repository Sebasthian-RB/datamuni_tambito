@extends('adminlte::page')

@section('title', 'Detalle de Intervención')

@section('content_header')
    <h1>Detalle de la Intervención</h1>
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
            <h3 class="mb-4">Detalles de la Intervención</h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Cita:</strong></h5>
                    <p>{{ $intervention->appointment }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5><strong>Derivación:</strong></h5>
                    <p>{{ $intervention->derivation ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Fecha de la Cita:</strong></h5>
                    <p>{{ $intervention->appointment_date }}</p>
                </div>
            </div>
        </div>

        <!-- Footer con el botón para regresar -->
        <div class="card-footer text-center">
            <a href="{{ route('interventions.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Volver al listado
            </a>
        </div>
    </div>
</div>
@stop
