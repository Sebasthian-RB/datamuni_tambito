@extends('adminlte::page')

@section('title', 'Detalles de la Visita')

@section('content_header')
    <!-- Texto e imagen superior -->
    <div class="px-4 py-3 d-flex justify-content-between align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
        <h3 style="color: gold; font-weight: bold; margin: 0;">Visita SISFOH</h3>
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo Visita" class="img-fluid" style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="shadow-lg card d-flex" style="border-radius: 15px; max-width: 900px; margin: 2rem auto; border-left: 5px solid #026d0a; display: flex; flex-direction: row;">
        
        <!-- Contenedor de los detalles -->
        <div class="flex-grow-1">
            <!-- Encabezado de la tarjeta -->
            <div class="card-header" style="background: #028a0f; color: white; border-radius: 15px 15px 0 0;">
                <h3 class="mb-0 card-title">Detalles de la Visita</h3>
            </div>

            <!-- Cuerpo de la tarjeta con los detalles -->
            <div class="card-body" style="background: linear-gradient(135deg, #a8e6a350 0%, #56ab2f50 100%);">
                <div class="mb-4 row">
                    <!-- Fecha de Visita -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Fecha de Visita:</h5>
                        <p>{{ $visit->formatted_visit_date }}</p>
                    </div>
                    
                    <!-- Estado -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Estado:</h5>
                        <p>{{ $visit->status }}</p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Enumerador -->
                    <div class="col-md-12">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Encuestador(a):</h5>
                        <p>
                            {{ $visit->enumerator->given_name ?? 'N/A' }} 
                            {{ $visit->enumerator->paternal_last_name ?? '' }} 
                            {{ $visit->enumerator->maternal_last_name ?? '' }}
                        </p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Solicitud -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Solicitud:</h5>
                        <p>{{ $visit->request->id ?? 'N/A' }}</p>
                    </div>

                    <!-- Observaciones -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Observaciones:</h5>
                        <p>{{ $visit->observations ?? 'Sin observaciones disponibles.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Pie de página con los botones -->
            <div class="text-center card-footer" style="background: #028a0f; border-radius: 0 0 15px 15px;">
                <a href="{{ route('visits.index') }}" class="shadow-sm btn btn-lg btn-light" style="border-radius: 8px; color: white;">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <a href="{{ route('visits.edit', $visit) }}" class="shadow-sm btn btn-lg btn-light" style="border-radius: 8px; color: #fff;">
                    <i class="fas fa-edit"></i> Editar
                </a>
            </div>
        </div>

        <!-- Imagen a la derecha con fondo blanco claro -->
        <div class="p-3 d-flex align-items-center" style="flex: 1; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <img src="{{ asset('Images/visitasisfoh.png') }}" alt="Visita" class="img-fluid" style="width: 100%; height: auto; object-fit: cover; border-radius: 10px; max-height: 300px;">
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
            background-color: #026d0a;
            border: 1px solid #026d0a;
            color: #026d0a;
        }

        .btn-light:hover {
            background-color: #014f07;
            color: #fff;
        }

        /* Estilo adicional para la imagen */
        .img-fluid {
            transition: transform 0.3s ease;
        }

        .img-fluid:hover {
            transform: scale(1.05); /* Efecto de zoom al pasar el mouse */
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Vista de Detalles de la Visita cargada.');
    </script>
@stop
