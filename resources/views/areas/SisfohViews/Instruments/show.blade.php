@extends('adminlte::page')

@section('title', 'Detalles del Instrumento')

@section('content_header')
    <!-- Texto e imagen superior -->
    <div class="px-4 py-3 d-flex justify-content-between align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
        <h3 style="color: gold; font-weight: bold; margin: 0;">Instrumento SISFOH</h3>
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo Instrumento" class="img-fluid" style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="shadow-lg card d-flex" style="border-radius: 15px; max-width: 900px; margin: 2rem auto; border-left: 5px solid #026d0a; display: flex; flex-direction: row;">
        
        <!-- Contenedor de los detalles -->
        <div class="flex-grow-1">
            <!-- Encabezado de la tarjeta -->
            <div class="card-header" style="background: #028a0f; color: white; border-radius: 15px 15px 0 0;">
                <h3 class="mb-0 card-title">Detalles del Instrumento</h3>
            </div>

            <!-- Cuerpo de la tarjeta con los detalles -->
            <div class="card-body" style="background: linear-gradient(135deg, #a8e6a350 0%, #56ab2f50 100%);">
                <div class="mb-4 row">
                    <!-- Nombre del Instrumento -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Nombre:</h5>
                        <p>{{ $instrument->name_instruments }}</p>
                    </div>
                    
                    <!-- Tipo de Instrumento -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Tipo:</h5>
                        <p>{{ $instrument->type_instruments }}</p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Descripción -->
                    <div class="col-md-12">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Descripción:</h5>
                        <p>{{ $instrument->description ?? 'Sin descripción disponible.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Pie de página con los botones -->
            <div class="text-center card-footer" style="background: #028a0f; border-radius: 0 0 15px 15px;">
                <a href="{{ route('instruments.index') }}" class="shadow-sm btn btn-lg btn-light" style="border-radius: 8px; color: white;">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <a href="{{ route('instruments.edit', $instrument) }}" class="shadow-sm btn btn-lg btn-light" style="border-radius: 8px; color: #fff;">
                    <i class="fas fa-edit"></i> Editar
                </a>
            </div>
        </div>

        <!-- Imagen a la derecha con fondo blanco claro -->
        <div class="p-3 d-flex align-items-center" style="flex: 1; background-color: #fff; border-radius: 10px;">
            <img src="{{ asset('Images/instrumentosisfoh.png') }}" alt="Instrumento" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
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
        console.log('Vista de Detalles del Instrumento cargada.');
    </script>
@stop
