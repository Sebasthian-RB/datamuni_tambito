@extends('adminlte::page')

@section('title', 'Detalles del Programa')

@section('content_header')
    <h1>Detalles del Programa</h1>
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
            <h3 class="mb-4">Detalles del Programa: {{ $program->name }}</h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Nombre:</strong></h5>
                    <p>{{ $program->name }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5><strong>Tipo:</strong></h5>
                    <p>{{ $program->program_type }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Descripción:</strong></h5>
                    <p>{{ $program->description }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5><strong>Estado:</strong></h5>
                    <p>{{ $program->status }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Fecha de Inicio:</strong></h5>
                    <p>{{ $program->start_date }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5><strong>Fecha de Finalización:</strong></h5>
                    <p>{{ $program->end_date }}</p>
                </div>
            </div>
        </div>

        <!-- Footer con el botón para regresar -->
        <div class="card-footer text-center">
            <a href="{{ route('programs.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Volver al listado
            </a>
        </div>
    </div>
</div>
@stop
