@extends('adminlte::page')

@section('title', 'Detalles de Vivienda')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #930813; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="card shadow-lg"
        style="border-radius: 15px; max-width: 800px; margin: 2rem auto; border-left: 5px solid #99050f;">

        <!-- Encabezado de la tarjeta -->
        <div class="card-header" style="background: #f00e1c; color: white; border-radius: 15px 15px 0 0;">
            <h3 class="card-title mb-0">Detalle de Vivienda</h3>
        </div>

        <!-- Cuerpo de la tarjeta con los detalles -->
        <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
            <div class="row mb-4">
                <!-- Localización -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Localización:</h5>
                    <p>{{ $omDwelling->exact_location ?? 'No especificada' }}</p>
                </div>

                <!-- Referencia -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Referencia:</h5>
                    <p>{{ $omDwelling->reference ?? 'No especificada' }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <!-- Anexo/Sector -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Anexo/Sector:</h5>
                    <p>{{ $omDwelling->annex_sector ?? 'No especificado' }}</p>
                </div>

                <!-- Agua y/o Luz -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Agua y/o Luz:</h5>
                    <p>{{ $omDwelling->water_electricity }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <!-- Tipo de Vivienda -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Tipo de Vivienda:</h5>
                    <p>{{ $omDwelling->type }}</p>
                </div>

                <!-- Situación -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Situación:</h5>
                    <p>{{ $omDwelling->ownership_status }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <!-- Ocupantes Permanentes -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Ocupantes Permanentes:</h5>
                    <p>{{ $omDwelling->permanent_occupants }}</p>
                </div>
            </div>
        </div>

        <!-- Pie de página con los botones -->
        <div class="card-footer text-center" style="background: #f00e1c; border-radius: 0 0 15px 15px;">
            <a href="javascript:history.back()" class="btn btn-lg btn-light shadow-sm"
                style="border-radius: 8px; color: white;">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ route('om-dwellings.edit', $omDwelling) }}" class="btn btn-lg btn-light shadow-sm"
                style="border-radius: 8px; color: white;">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>
@stop

@section('css')
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <style>
        .card {
            transition: transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn-light {
            background-color: #930813;
            border: 1px solid #930813;
            color: #930813;
        }

        .btn-light:hover {
            background-color: #50030a;
            color: #fff;
        }

        .btn-warning {
            background-color: #f39c12;
            border: 1px solid #f39c12;
            color: white;
        }

        .btn-warning:hover {
            background-color: #e67e22;
            color: white;
        }
    </style>
@stop
