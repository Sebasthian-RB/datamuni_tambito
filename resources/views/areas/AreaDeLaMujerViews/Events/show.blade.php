@extends('adminlte::page')

@section('title', 'Detalles del Evento')

@section('content_header')
    <h1>Detalles del Evento</h1>
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
            <h3 class="mb-4">Detalles del Evento: {{ $event->name }}</h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Nombre:</strong></h5>
                    <p>{{ $event->name }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5><strong>Lugar:</strong></h5>
                    <p>{{ $event->place }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Estado:</strong></h5>
                    <p>{{ $event->status }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5><strong>Fecha de Inicio:</strong></h5>
                    <p>{{ $event->start_date }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5><strong>Fecha de Finalización:</strong></h5>
                    <p>{{ $event->end_date }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5><strong>Programa:</strong></h5>
                    <p>{{ $event->program->name }}</p>
                </div>
            </div>
        </div>

        <!-- Footer con el botón para regresar -->
        <div class="card-footer text-center">
            <a href="{{ route('events.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Volver al listado
            </a>
        </div>
    </div>
</div>
@stop
