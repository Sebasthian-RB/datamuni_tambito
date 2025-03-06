@extends('adminlte::page')

@section('title', 'Detalles de la Vivienda')

@section('content_header')
    <!-- Texto e imagen superior -->
    <div class="px-4 py-3 d-flex justify-content-between align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
        <h3 style="color: gold; font-weight: bold; margin: 0;">Vivienda SISFOH</h3>
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo Vivienda" class="img-fluid" style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="shadow-lg card d-flex" style="border-radius: 15px; max-width: 900px; margin: 2rem auto; border-left: 5px solid #026d0a; display: flex; flex-direction: row;">
        
        <!-- Contenedor de los detalles -->
        <div class="flex-grow-1" style="width: 60%;">
            <!-- Encabezado de la tarjeta -->
            <div class="card-header" style="background: #028a0f; color: white; border-radius: 15px 15px 0 0;">
                <h3 class="mb-0 card-title">Detalles de la Vivienda</h3>
            </div>

            <!-- Cuerpo de la tarjeta con los detalles -->
            <div class="card-body" style="background: linear-gradient(135deg, #a8e6a350 0%, #56ab2f50 100%);">
                <div class="mb-4 row">
                    <!-- Dirección -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Dirección:</h5>
                        <p>{{ $sfhDwelling->street_address }}</p>
                    </div>
                    
                    <!-- Referencia -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Referencia:</h5>
                        <p>{{ $sfhDwelling->reference }}</p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Barrio -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Barrio:</h5>
                        <p>{{ $sfhDwelling->neighborhood }}</p>
                    </div>

                    <!-- Distrito -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Distrito:</h5>
                        <p>{{ $sfhDwelling->district }}</p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Provincia -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Provincia:</h5>
                        <p>{{ $sfhDwelling->provincia }}</p>
                    </div>

                    <!-- Región -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Región:</h5>
                        <p>{{ $sfhDwelling->region }}</p>
                    </div>
                </div>
            </div>

            <!-- Pie de página con los botones -->
            <div class="text-center card-footer" style="background: #028a0f; border-radius: 0 0 15px 15px;">
                <a href="{{ route('sfh_dwelling.index') }}" class="shadow-sm btn btn-lg btn-light" style="border-radius: 8px; color: white;">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <a href="{{ route('sfh_dwelling.edit', $sfhDwelling) }}" class="shadow-sm btn btn-lg btn-light" style="border-radius: 8px; color: #fff;">
                    <i class="fas fa-edit"></i> Editar
                </a>
            </div>
        </div>

        <!-- Imagen a la derecha con fondo blanco claro -->
        <div class="p-3 d-flex align-items-center justify-content-center" style="width: 40%; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <img src="{{ asset('Images/viviendasisfoh.png') }}" alt="Vivienda" class="img-fluid" style="width: 100%; height: auto; object-fit: cover; border-radius: 10px; max-height: 300px;">
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
        console.log('Vista de Detalles de la Vivienda cargada.');
    </script>
@stop
