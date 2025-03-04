@extends('adminlte::page')

@section('title', 'Detalles de la Persona')

@section('content_header')
    <!-- Texto e imagen superior -->
    <div class="px-4 py-3 d-flex justify-content-between align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
        <h3 style="color: gold; font-weight: bold; margin: 0;">Persona SISFOH</h3>
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo Persona" class="img-fluid" style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="shadow-lg card d-flex" style="border-radius: 15px; max-width: 900px; margin: 2rem auto; border-left: 5px solid #026d0a; display: flex; flex-direction: row;">
        
        <!-- Contenedor de los detalles -->
        <div class="flex-grow-1">
            <!-- Encabezado de la tarjeta -->
            <div class="card-header" style="background: #028a0f; color: white; border-radius: 15px 15px 0 0;">
                <h3 class="mb-0 card-title">Detalles de la Persona</h3>
            </div>

            <!-- Cuerpo de la tarjeta con los detalles -->
            <div class="card-body" style="background: linear-gradient(135deg, #a8e6a350 0%, #56ab2f50 100%);">
                <div class="mb-4 row">
                    <!-- ID -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">ID:</h5>
                        <p>{{ $sfhPerson->id }}</p>
                    </div>
                    
                    <!-- Documento de Identidad -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Documento de Identidad:</h5>
                        <p>{{ $sfhPerson->identity_document }}</p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Nombre Completo -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Nombre Completo:</h5>
                        <p>{{ $sfhPerson->given_name }} {{ $sfhPerson->paternal_last_name }} {{ $sfhPerson->maternal_last_name }}</p>
                    </div>

                    <!-- Estado Civil -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Estado Civil:</h5>
                        <p>{{ $sfhPerson->marital_status }}</p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Fecha de Nacimiento -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Fecha de Nacimiento:</h5>
                        <p>{{ $sfhPerson->birth_date }}</p>
                    </div>

                    <!-- Sexo -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Sexo:</h5>
                        <p>{{ $sfhPerson->sex_type == 0 ? 'Femenino' : 'Masculino' }}</p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Teléfono -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Teléfono:</h5>
                        <p>{{ $sfhPerson->phone_number ?? 'N/A' }}</p>
                    </div>

                    <!-- Nacionalidad -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Nacionalidad:</h5>
                        <p>{{ $sfhPerson->nationality }}</p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Grado Académico -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Grado Académico:</h5>
                        <p>{{ $sfhPerson->degree }}</p>
                    </div>

                    <!-- Ocupación -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Ocupación:</h5>
                        <p>{{ $sfhPerson->occupation }}</p>
                    </div>
                </div>

                <div class="mb-4 row">
                    <!-- Categoría SISFOH -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold" style="color: #028a0f;">Categoría SISFOH:</h5>
                        <p>{{ $sfhPerson->sfh_category }}</p>
                    </div>
                </div>
            </div>

            <!-- Pie de página con los botones -->
            <div class="text-center card-footer" style="background: #028a0f; border-radius: 0 0 15px 15px;">
                <a href="{{ route('sfh_people.index') }}" class="shadow-sm btn btn-lg btn-light" style="border-radius: 8px; color: white;">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <a href="{{ route('sfh_people.edit', $sfhPerson) }}" class="shadow-sm btn btn-lg btn-light" style="border-radius: 8px; color: #fff;">
                    <i class="fas fa-edit"></i> Editar
                </a>
            </div>
        </div>

        <!-- Imagen a la derecha con fondo blanco claro -->
        <div class="p-3 d-flex align-items-center" style="flex: 1; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <img src="{{ asset('Images/familiarsisfoh.png') }}" alt="Persona" class="img-fluid" style="width: 100%; height: auto; object-fit: cover; border-radius: 10px; max-height: 300px;">
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
        console.log('Vista de Detalles de la Persona cargada.');
    </script>
@stop