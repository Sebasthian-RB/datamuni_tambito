@extends('adminlte::page')

@section('title', 'Detalles del Evento')

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
            <h3 class="card-title mb-0">Detalles del Evento: {{ $event->name }}</h3>
        </div>

        <!-- Cuerpo de la tarjeta con los detalles -->
        <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
            <div class="row mb-4">
                <!-- Nombre del Evento -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Nombre:</h5>
                    <p>{{ $event->name }}</p>
                </div>

                <!-- Lugar del Evento -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Lugar:</h5>
                    <p>{{ $event->place }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <!-- Estado del Evento -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Estado:</h5>
                    <p class="badge {{ $event->status == 'Pendiente' ? 'bg-warning' : ($event->status == 'Finalizado' ? 'bg-success' : 'bg-danger') }}" 
                       style="font-size: 16px; padding: 10px; border-radius: 8px;">
                        {{ $event->status }}
                    </p>
                </div>

                <!-- Fecha de Inicio -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Fecha de Inicio:</h5>
                    <p>{{ $event->start_date }}</p>
                </div>
            </div>

            <div class="row">
                <!-- Fecha de Finalización -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Fecha de Finalización:</h5>
                    <p>{{ $event->end_date }}</p>
                </div>

                <!-- Programa -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Programa:</h5>
                    <p>{{ $event->program->name }}</p>
                </div>
            </div>
        </div>

        <!-- Pie de página con el botón de volver -->
        <div class="card-footer text-center" style="background: #355c7d; border-radius: 0 0 15px 15px;">
            <a href="{{ route('events.index') }}" class="btn btn-lg btn-light shadow-sm" 
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
