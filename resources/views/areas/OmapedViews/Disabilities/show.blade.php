@extends('adminlte::page')

@section('title', 'Detalles de Discapacidad')

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
            <h3 class="card-title mb-0">Detalle de la Discapacidad</h3>
        </div>

        <!-- Cuerpo de la tarjeta con los detalles -->
        <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
            <div class="row mb-4">
                <!-- Certificado -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">N° Certificado:</h5>
                    <p>{{ $disability->certificate_number ?? 'No disponible' }}</p>
                </div>

                <!-- Fecha de emisión -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Fecha de Emisión:</h5>
                    <p>{{ $disability->certificate_issue_date ? $disability->certificate_issue_date->format('d/m/Y') : 'No disponible' }}
                    </p>
                </div>
            </div>

            <div class="row mb-4">
                <!-- Fecha de caducidad -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Fecha de Caducidad:</h5>
                    <p>{{ $disability->certificate_expiry_date ? $disability->certificate_expiry_date->format('d/m/Y') : 'No especificada' }}
                    </p>
                </div>

                <!-- Organización -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Organización:</h5>
                    <p>{{ $disability->organization_name }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <!-- Diagnóstico -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Diagnóstico:</h5>
                    <p>{{ $disability->diagnosis }}</p>
                </div>

                <!-- Tipo de Discapacidad -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Tipo de Discapacidad:</h5>
                    <p>{{ $disability->disability_type }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <!-- Nivel de gravedad -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Nivel de Gravedad:</h5>
                    <p>{{ $disability->severity_level }}</p>
                </div>

                <!-- Dispositivos necesarios -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Dispositivos Necesarios:</h5>
                    <p>{{ $disability->required_support_devices ?? 'No se especificaron dispositivos necesarios.' }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <!-- Dispositivos usados -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Dispositivos Usados:</h5>
                    <p>{{ $disability->used_support_devices ?? 'No se especificaron dispositivos usados.' }}</p>
                </div>
            </div>
        </div>

        <!-- Pie de página con el botón de volver -->
        <div class="card-footer text-center" style="background: #f00e1c; border-radius: 0 0 15px 15px;">
            <a href="javascript:history.back()" class="btn btn-lg btn-light shadow-sm"
                style="border-radius: 8px; color: white;">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ route('disabilities.edit', $disability) }}" class="btn btn-lg btn-light shadow-sm"
                style="border-radius: 8px; color: #fff;">
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
    </style>
@stop
