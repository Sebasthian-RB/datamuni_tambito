@extends('adminlte::page')

@section('title', 'Agregar Comité')

@section('content_header')
@stop

@section('css')
    <!-- Estilos personalizados -->
    <style>
        /* Colores de la paleta */
        :root {
            --color-primary: #3B1E54;
            --color-secondary: #9B7EBD;
            --color-accent: #D4BEE4;
            --color-background: #EEEEEE;
        }
    
        /* Estilos generales */
        .card {
            border: 1px solid var(--color-accent);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            padding-top: 20px;
        }
    
        /* Header */
        .card-header {
            background: linear-gradient(135deg, var(--color-primary), #5A2E7A);
            color: #FFFFFF;
            padding: 25px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    
        .card-title {
            font-size: 1.75rem;
            margin: 0;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
    
        .card-subtitle {
            font-size: 1rem;
            color: var(--color-accent);
            margin-top: 5px;
            font-weight: 400;
        }
    
        .header-logo {
            height: 50px;
            width: auto;
            transition: opacity 0.3s ease;
        }
    
        .header-logo:hover {
            opacity: 0.8;
        }
    
        /* Estilos para las etiquetas */
        label {
            color: var(--color-primary);
            font-weight: bold;
        }
    
        /* Estilos para los campos de formulario */
        .form-control {
            border: 1px solid var(--color-accent);
            border-radius: 6px;
            padding: 10px;
            font-size: 14px;
            color: var(--color-primary);
        }
    
        .form-control::placeholder {
            color: #999;
            font-style: italic;
        }
    
        .form-control:focus {
            border-color: var(--color-secondary);
            box-shadow: 0 0 5px rgba(155, 126, 189, 0.5);
        }
    
        /* Estilos para los select */
        .form-control option {
            color: var(--color-primary);
        }
    
        .form-control option.placeholder-option {
            color: #999;
            font-style: italic;
        }
    
        /* Estilos para los íconos */
        .fas {
            color: var(--color-secondary);
        }
    
        /* Estilos para los mensajes de error */
        .invalid-feedback {
            color: #dc3545;
            font-size: 12px;
        }
    
        /* Estilos personalizados para el botón "Guardar Comité" */
        .btn-custom {
            background-color: #9B7EBD;
            border-color: #9B7EBD;
            color: white;
        }

        .btn-custom:hover,
        .btn-danger:hover {
            background-color: var(--color-primary); /* Mismo color para todos los hovers */
            border-color: var(--color-primary);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
        }

        /* Línea divisoria vertical */
        .vertical-divider {
            width: 1px;
            height: 100%;
            background-color: var(--color-accent);
        }
    
        /* Estilos responsivos */
        @media (max-width: 768px) {
            .col-md-6, .col-md-4, .col-md-8, .col-md-5, .col-md-1 {
                width: 100%;
            }
    
            .vertical-divider {
                display: none; /* Ocultar la línea divisoria en pantallas pequeñas */
            }
    
            .header-content {
                flex-direction: column;
                text-align: center;
            }
    
            .header-logo {
                margin-top: 10px;
            }

            .card-title {
                font-size: 1.5rem;
            }

            .card-subtitle {
                font-size: 0.9rem;
            }
    
            .card-footer {
                text-align: center;
            }
    
            .btn {
                width: 100%;
                margin-bottom: 10px;
            }

            .btn-custom, .btn-danger {
                width: 100%; /* Botones ocupan el 100% del ancho en móviles */
                margin-bottom: 10px; /* Espacio entre botones */
            }

            .btn-danger {
                margin-left: 0 !important; /* Eliminar margen izquierdo en móviles */
            }
        }
    </style>
@stop

@section('content')
<div class="container">
    <form action="{{ route('committees.store') }}" method="POST">
        @csrf
        <div class="card">
            <!-- Card Header -->
            <div class="card-header">
                <div class="header-content">
                    <div>
                        <h1 class="card-title">Formulario para agregar nuevo Comité</h1>
                        <p class="card-subtitle">Complete los campos para registrar un nuevo comité.</p>
                    </div>
                    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <!-- Sección del Comité -->
                    <div class="col-md-12">
                        <div class="row">
                            <!-- Columna izquierda -->
                            <div class="col-md-6">
                                <!-- Fila para Número y Nombre -->
                                <div class="row">
                                    <!-- Columna para Número de comité (más pequeño) -->
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="id" class="font-weight-bold">
                                                <i class="fas fa-hashtag mr-2"></i>Número de comité
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id') }}" placeholder="Ej: 1234" required>
                                            @error('id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <!-- Columna para Nombre (más grande) -->
                                    <div class="col-md-8">
                                        <div class="form-group mb-4">
                                            <label for="name" class="font-weight-bold">
                                                <i class="fas fa-file-signature mr-2"></i>Nombre
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Ej: Comité de Desarrollo Local" required>
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Campo: Presidente(a) -->
                                <div class="form-group mb-4">
                                    <label for="president" class="font-weight-bold">
                                        <i class="fas fa-user-tie mr-2"></i>Presidente(a)
                                    </label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control @error('president') is-invalid @enderror" id="president" name="president" value="{{ old('president') }}" placeholder="Ej: Apellidos y Nombres" required>
                                    @error('president')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
        
                            <!-- Línea divisoria -->
                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <div class="vertical-divider"></div>
                            </div>
        
                            <!-- Columna derecha -->
                            <div class="col-md-5">
                                <!-- Campo: Núcleo Urbano -->
                                <div class="form-group mb-4">
                                    <label for="urban_core" class="font-weight-bold">
                                        <i class="fas fa-map-marker-alt mr-2"></i>Núcleo Urbano
                                    </label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control @error('urban_core') is-invalid @enderror" id="urban_core" name="urban_core" required>
                                        <option value="" disabled selected class="placeholder-option">Seleccione un Núcleo Urbano</option>
                                        @foreach ($urbanCores as $core)
                                            <option value="{{ $core }}" {{ old('urban_core') == $core ? 'selected' : '' }}>{{ $core }}</option>
                                        @endforeach
                                    </select>
                                    @error('urban_core')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <!-- Campo: Sector -->
                                <div class="form-group mb-4">
                                    <label for="sector_id" class="font-weight-bold">
                                        <i class="fas fa-map mr-2"></i>Sector
                                    </label>
                                    <span class="text-danger">*</span>
                                    @if($sectors->isEmpty())
                                        <p class="text-muted">No hay sectores disponibles.</p>
                                    @else
                                        <select name="sector_id" id="sector_id" class="form-control @error('sector_id') is-invalid @enderror" required>
                                            <option value="" disabled selected class="placeholder-option">Seleccione un Sector</option>
                                            @foreach($sectors as $sector)
                                                <option value="{{ $sector->id }}" {{ old('sector_id') == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('sector_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Card Footer -->
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-custom">Guardar Comité</button>
                <a href="{{ route('committees.index') }}" class="btn btn-danger ml-2">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop