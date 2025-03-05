@extends('adminlte::page')

@section('title', 'Agregar Miembro de Familia')

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
    
        /* Estilos personalizados para el botón "Guardar Miembro" */
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

            /* Ajustes adicionales para campos en móviles */
            .form-group {
                margin-bottom: 15px; /* Más espacio entre campos */
            }

            .form-control {
                font-size: 16px; /* Tamaño de fuente más grande para móviles */
            }
        }
    </style>
@stop

@section('content')
<div class="container">
    <form action="{{ route('vl_family_members.store') }}" method="POST">
        @csrf
        <div class="card">
            <!-- Card Header -->
            <div class="card-header">
                <div class="header-content">
                    <div>
                        <h1 class="card-title">Formulario para agregar miembro de familia</h1>
                        <p class="card-subtitle">Complete los campos para registrar un nuevo miembro de familia.</p>
                    </div>
                    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <!-- Columna izquierda: Número de Documento y Tipo de Documento en la misma fila -->
                    <div class="col-md-5">
                        <div class="row">
                            <!-- Campo: Número de Documento -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="id" class="font-weight-bold">
                                        <i class="fas fa-hashtag mr-2"></i>Número de Documento
                                    </label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id') }}" placeholder="Ej: 12345678" required>
                                    @error('id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Campo: Tipo de Documento -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="identity_document" class="font-weight-bold">
                                        <i class="fas fa-id-card mr-2"></i>Tipo de Documento
                                    </label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control @error('identity_document') is-invalid @enderror" id="identity_document" name="identity_document" required>
                                        <option value="" disabled selected class="placeholder-option">Seleccione Tipo de Documento</option>
                                        @foreach($identityDocumentTypes as $key => $label)
                                            <option value="{{ $key }}" {{ old('identity_document') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('identity_document')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Línea divisoria -->
                    <div class="col-md-1 d-flex justify-content-center align-items-center">
                        <div class="vertical-divider"></div>
                    </div>

                    <!-- Columna derecha: Nombres y Apellidos -->
                    <div class="col-md-6">
                        <div class="row">
                            <!-- Fila 1: Apellido Paterno y Apellido Materno -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="paternal_last_name" class="font-weight-bold">
                                        <i class="fas fa-user-tag mr-2"></i>Apellido Paterno
                                    </label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control @error('paternal_last_name') is-invalid @enderror" id="paternal_last_name" name="paternal_last_name" value="{{ old('paternal_last_name') }}" placeholder="Ej: Pérez" required>
                                    @error('paternal_last_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="maternal_last_name" class="font-weight-bold">
                                        <i class="fas fa-user-tag mr-2"></i>Apellido Materno
                                    </label>
                                    <input type="text" class="form-control @error('maternal_last_name') is-invalid @enderror" id="maternal_last_name" name="maternal_last_name" value="{{ old('maternal_last_name') }}" placeholder="Ej: Gómez">
                                    @error('maternal_last_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fila 2: Nombres -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label for="given_name" class="font-weight-bold">
                                        <i class="fas fa-user mr-2"></i>Nombres
                                    </label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name" name="given_name" value="{{ old('given_name') }}" placeholder="Ej: Juan Carlos" required>
                                    @error('given_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        
            <!-- Card Footer -->
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-custom">Guardar Miembro</button>
                <a href="{{ route('vl_family_members.index') }}" class="btn btn-danger ml-2">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop