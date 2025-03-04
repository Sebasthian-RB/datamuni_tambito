@extends('adminlte::page')

@section('title', 'Detalles del Encuestador')

@section('content_header')
    <!-- Texto y imagen superior -->
    <div class="px-4 py-3 d-flex justify-content-between align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
        <h3 style="color: gold; font-weight: bold; margin: 0;">Encuestador Sisfoh</h3>
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo Encuestador" class="img-fluid" style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="shadow-lg card d-flex" style="border-radius: 15px; max-width: 900px; margin: 2rem auto; border-left: 5px solid #026d0a; display: flex; flex-direction: row;">
        
        <!-- Contenedor de los detalles -->
        <div class="flex-grow-1">
            <!-- Encabezado de la tarjeta -->
            <div class="card-header" style="background: #028a0f; color: white; border-radius: 15px 15px 0 0;">
                <h3 class="mb-0 card-title">Detalles del Encuestador</h3>
            </div>

            <!-- Cuerpo de la tarjeta con los detalles -->
            <div class="card-body" style="background: linear-gradient(135deg, #a8e6a350 0%, #56ab2f50 100%);">
                <div class="mb-4 row">
                    <!-- Nombre Completo -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Nombre Completo:</h5>
                        <p>{{ $enumerator->given_name }} {{ $enumerator->paternal_last_name }} {{ $enumerator->maternal_last_name }}</p>
                    </div>
                    
                    <!-- Tipo de Documento -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Tipo de Documento:</h5>
                        <p>{{ $enumerator->identity_document }}</p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Número de Documento -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Número de Documento:</h5>
                        <p>{{ $enumerator->id }}</p>
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Número de Teléfono:</h5>
                        <p>{{ $enumerator->phone_number ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Pie de página con los botones -->
            <div class="text-center card-footer" style="background: #028a0f; border-radius: 0 0 15px 15px;">
                <a href="javascript:history.back()" class="shadow-sm btn btn-lg btn-light" style="border-radius: 8px; color: white;">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <a href="{{ route('enumerators.edit', $enumerator) }}" class="shadow-sm btn btn-lg btn-light" style="border-radius: 8px; color: #fff;">
                    <i class="fas fa-edit"></i> Editar
                </a>
            </div>
        </div>

        <!-- Imagen a la derecha con fondo blanco claro -->
        <div class="p-3 d-flex align-items-center" style="flex: 1; background-color: #fff; border-radius: 10px;">
            <img src="{{ asset('Images/encuestadores1.png') }}" alt="Encuestador" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
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
    </style>
@stop

@section('js')
    <script>
        console.log('Vista de Detalles del Encuestador cargada.');
    </script>
@stop
