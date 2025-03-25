@extends('adminlte::page')

@section('title', 'Detalles del Programa')

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
            <h3 class="card-title mb-0">Detalles del Programa: {{ $program->name }}</h3>
        </div>

        <!-- Cuerpo -->
        <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
            <div class="row mb-4">
                <!-- Nombre -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Nombre:</h5>
                    <p class="text-dark">{{ $program->name }}</p>
                </div>

                <!-- Tipo -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Tipo:</h5>
                    <p class="text-dark">{{ $program->program_type }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <!-- Descripción -->
                <div class="col-md-12">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Descripción:</h5>
                    <p class="text-dark">{{ $program->description }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <!-- Estado -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Estado:</h5>
                    <p class="text-dark">{{ $program->status }}</p>
                </div>

                <!-- Fechas -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #355c7d;">Fechas:</h5>
                    <p class="text-dark">
                        <strong>Inicio:</strong> {{ $program->start_date }}<br>
                        <strong>Finalización:</strong> {{ $program->end_date ?? 'N/A' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Pie de página -->
        <div class="card-footer text-center" style="background: #355c7d; border-radius: 0 0 15px 15px;">
            <a href="{{ route('programs.index') }}" class="btn btn-lg btn-light shadow-sm"
                style="border-radius: 8px; color: #355c7d;">
                <i class="fas fa-arrow-left"></i> Volver al Listado
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

        .text-dark {
            color: #4a4a4a !important;
            font-size: 1.1rem;
        }
    </style>
@stop
