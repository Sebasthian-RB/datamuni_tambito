@extends('adminlte::page')

@section('title', 'Detalles de la Solicitud')

@section('content_header')
    <!-- Texto e imagen superior -->
    <div class="px-4 py-3 d-flex justify-content-between align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
        <h3 style="color: gold; font-weight: bold; margin: 0;">Solicitud SISFOH</h3>
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo Solicitud" class="img-fluid" style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="shadow-lg card d-flex" style="border-radius: 15px; max-width: 900px; margin: 2rem auto; border-left: 5px solid #026d0a; display: flex; flex-direction: row;">
        
        <!-- Contenedor de los detalles -->
        <div class="flex-grow-1">
            <!-- Encabezado de la tarjeta -->
            <div class="card-header" style="background: #028a0f; color: white; border-radius: 15px 15px 0 0;">
                <h3 class="mb-0 card-title">Detalles de la Solicitud</h3>
            </div>

            <!-- Cuerpo de la tarjeta con los detalles -->
            <div class="card-body" style="background: linear-gradient(135deg, #a8e6a350 0%, #56ab2f50 100%);">
                <div class="mb-4 row">
                    <!-- ID -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">ID:</h5>
                        <p>{{ $sfhRequest->id }}</p>
                    </div>
                    
                    <!-- Fecha de Solicitud -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Fecha de Solicitud:</h5>
                        <p>{{ $sfhRequest->formatted_request_date }}</p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Descripción -->
                    <div class="col-md-12">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Motivo:</h5>
                        <p>{{ $sfhRequest->description ?? 'Sin descripción disponible.' }}</p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Persona Relacionada -->
                    <div class="col-md-12">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Ciudadano Relacionado:</h5>
                        <p>
                            {{ $sfhRequest->sfhPerson->given_name ?? 'N/A' }} 
                            {{ $sfhRequest->sfhPerson->paternal_last_name ?? '' }} 
                            {{ $sfhRequest->sfhPerson->maternal_last_name ?? '' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pie de página con los botones -->
            <div class="text-center card-footer" style="background: #028a0f; border-radius: 0 0 15px 15px;">
                <a href="{{ route('sfh_requests.index') }}" class="shadow-sm btn btn-lg btn-light" style="border-radius: 8px; color: white;">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <a href="{{ route('sfh_requests.edit', $sfhRequest->id) }}" class="shadow-sm btn btn-lg btn-light" style="border-radius: 8px; color: #fff;">
                    <i class="fas fa-edit"></i> Editar
                </a>
            </div>
        </div>

        <!-- Imagen a la derecha con fondo blanco claro -->
        <div class="p-3 d-flex align-items-center" style="flex: 1; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <img src="{{ asset('Images/solicitudsisfoh.png') }}" alt="Solicitud" class="img-fluid" style="width: 100%; height: auto; object-fit: cover; border-radius: 10px; max-height: 300px;">
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
        console.log('Vista de Detalles de la Solicitud cargada.');
    </script>
@stop
