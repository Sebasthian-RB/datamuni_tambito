@extends('adminlte::page')

@section('title', 'Detalles del Cuidador')

@section('content_header')
    <!-- Imagen superior -->
    <div class="d-flex justify-content-center align-items-center py-3" style="background: #f00e1c; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo Cuidador" class="img-fluid" style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto; border-left: 5px solid #99050f;">
        
        <!-- Encabezado de la tarjeta -->
        <div class="card-header" style="background: #f00e1c; color: white; border-radius: 15px 15px 0 0;">
            <h3 class="card-title mb-0">Detalles del Cuidador</h3>
        </div>

        <!-- Cuerpo de la tarjeta con los detalles -->
        <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
            <div class="row mb-4">
                <!-- Nombre Completo -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Nombre Completo:</h5>
                    <p>{{ $caregiver->full_name }}</p>
                </div>
                
                <!-- Relación -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Relación:</h5>
                    <p>{{ $caregiver->relationship }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <!-- DNI -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">DNI:</h5>
                    <p>{{ $caregiver->dni }}</p>
                </div>

                <!-- Teléfono -->
                <div class="col-md-6">
                    <h5 class="font-weight-bold" style="color: #f00e1c;">Teléfono:</h5>
                    <p>{{ $caregiver->phone ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Pie de página con los botones -->
        <div class="card-footer text-center" style="background: #f00e1c; border-radius: 0 0 15px 15px;">
            <a href="javascript:history.back()" class="btn btn-lg btn-light shadow-sm" style="border-radius: 8px; color: white;">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ route('caregivers.edit', $caregiver) }}" class="btn btn-lg btn-light shadow-sm" style="border-radius: 8px; color: #fff;">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>
@stop

@section('css')
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

@section('js')
    <script>
        console.log('Vista de Detalles del Cuidador cargada.');
    </script>
@stop
