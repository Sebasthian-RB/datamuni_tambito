@extends('adminlte::page')

@section('title', 'Agregar Miembro de Familia y Menores')

@section('content_header')
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

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

        /* Estilos para los botones de selección de sexo */
        .sex-button {
            background-color: transparent;
            border: 1px solid var(--color-accent); 
            color: var(--color-primary); /* Color del texto */
            padding: 8px 16px; /* Espaciado interno */
            font-weight: normal !important;  
            font-size: 14px;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: inline-flex; /* Alinea ícono y texto en una sola fila */
            align-items: center; /* Centra verticalmente */
        }

        .sex-button:hover {
            background-color: var(--color-accent); /* Color de fondo al pasar el cursor */
            color: white; /* Color del texto al pasar el cursor */
        }

        .sex-button.active {
            background-color: var(--color-secondary); /* Color de fondo cuando está seleccionado */
            color: white; /* Color del texto cuando está seleccionado */
            border: 1px solid var(--color-secondary);
        }

        .sex-button i {
            color: var(--color-secondary); /* Color del ícono */
            margin-right: 8px; /* Espacio entre el ícono y el texto */
        }

        .sex-button.active i {
            color: white; /* Color del ícono cuando está seleccionado */
        }

        /* Estilos para mostrar datos del comité */
        .committee-card {
            background-color: #ffffff;
            border: 1px solid var(--color-accent);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        /* Estilos para el cuerpo de la tarjeta */
        .committee-card-body {
            display: flex;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        /* Estilos para cada ítem de información */
        .committee-info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background-color: var(--color-background);
            border-radius: 8px;
        }

        /* Estilos específicos para el nombre del comité */
        .committee-card-body .committee-info-item.committee-name {
            flex: 2;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--color-primary);
            text-transform: uppercase;
            letter-spacing: 1px;
            background-color: var(--color-accent);
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para el presidente */
        .committee-president {
            flex: 1;
        }

        /* Estilos para el sector */
        .committee-sector {
            flex: 1;
        }

        /* Estilos para el núcleo urbano */
        .committee-nucleo {
            flex: 1;
        }

        /* Estilos para los íconos */
        .committee-icon {
            font-size: 1.25rem;
            color: var(--color-secondary);
        }

        /* Estilos para el texto */
        .committee-text {
            display: flex;
            flex-direction: column;
        }

        .committee-label {
            font-weight: 600;
            color: var(--color-primary);
            font-size: 0.9rem;
            margin-bottom: 2px;
        }

        .committee-value {
            color: var(--color-primary);
            font-size: 1rem;
            font-weight: 500;
        }

        .committee-name-value {
            color: var(--color-primary);
            font-size: 1.5rem;
            font-weight: bold;
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

        /* Estilos para select 2 */
        .select2-container .select2-selection--single {
            height: 36px; /* Ajusta la altura según tus necesidades */
            padding: 10px;
            font-size: 16px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 20px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 20px;
        }
    </style>
@stop

@section('content')
<div class="container">
    <form action="{{ route('committee_vl_family_members.store') }}" method="POST">
        @csrf
        <div class="card">
            <!-- Card Header -->
            <div class="card-header">
                <div class="header-content">
                    <div>
                        <h1 class="card-title">Formulario para agregar miembro de familia y menores</h1>
                        <p class="card-subtitle">Complete los campos para registrar un nuevo miembro de familia y sus menores.</p>
                    </div>
                    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
                </div>
            </div>
            
            <div class="card-body">
                <!-- Información del Comité -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="committee-card">
                            <div class="committee-card-body">
                                <!-- Nombre del comité (resaltado) -->
                                <div class="committee-info-item committee-name">
                                    <span class="committee-name-value">{{ $committee->name }}</span>
                                </div>
                                
                                <!-- Sector -->
                                <div class="committee-info-item committee-sector">
                                    <i class="fas fa-map-marked-alt committee-icon"></i>
                                    <div class="committee-text">
                                        <span class="committee-label">Sector:</span>
                                        <span class="committee-value">{{ $committee->sector->name }}</span>
                                    </div>
                                </div>
                
                                <!-- Núcleo Urbano -->
                                <div class="committee-info-item committee-nucleo">
                                    <i class="fas fa-city committee-icon"></i>
                                    <div class="committee-text">
                                        <span class="committee-label">Núcleo:</span>
                                        <span class="committee-value">{{ $committee->urban_core }}</span>
                                    </div>
                                </div>

                                <!-- Presidente -->
                                <div class="committee-info-item committee-president">
                                    <i class="fas fa-user-tie committee-icon"></i>
                                    <div class="committee-text">
                                        <span class="committee-label">Presidente:</span>
                                        <span class="committee-value">{{ $committee->president }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sección para crear un nuevo miembro de familia -->
                <form id="form-miembro">
                    @csrf <!-- Token CSRF para protección -->

                    <!-- Campos del formulario -->
                    <div class="row mt-4">
                        <div class="col-md-12 card-body">
                            <h4 class="font-weight-bold">Crear Nuevo Miembro de Familia</h4>
                            <hr>

                            <div class="row">
                                <!-- Columna izquierda: Documento de Identidad -->
                                <div class="col-md-5">
                                    <div class="row">
                                        <!-- Campo: Número de Documento -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="new_id" class="font-weight-bold">
                                                    <i class="fas fa-id-card mr-2"></i>Número de Documento
                                                </label>
                                                <span class="text-danger">*</span>
                                                <input type="text" class="form-control @error('new_id') is-invalid @enderror" id="new_id" name="new_id" value="{{ old('new_id') }}" placeholder="Ej: 12345678">
                                                @error('new_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                                
                                        <!-- Campo: Tipo de Documento -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="new_identity_document" class="font-weight-bold">
                                                    <i class="fas fa-file-alt mr-2"></i>Tipo de Documento
                                                </label>
                                                <span class="text-danger">*</span>
                                                <select class="form-control @error('new_identity_document') is-invalid @enderror" id="new_identity_document" name="new_identity_document">
                                                    <option value="" disabled selected class="placeholder-option">Seleccione Tipo de Documento</option>
                                                    @foreach($identityDocumentTypes as $key => $label)
                                                        <option value="{{ $key }}" {{ (old('new_identity_document') == $key || $key == 'DNI') ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('new_identity_document')
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

                                <!-- Columna derecha: Apellidos y nombres del familiar -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <!-- Campo: Apellido Paterno -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="new_paternal_last_name" class="font-weight-bold">
                                                    <i class="fas fa-user-tag mr-2"></i>Apellido Paterno
                                                </label>
                                                <span class="text-danger">*</span>
                                                <input type="text" class="form-control @error('new_paternal_last_name') is-invalid @enderror" id="new_paternal_last_name" name="new_paternal_last_name" value="{{ old('new_paternal_last_name') }}" placeholder="Ej: Pérez">
                                                @error('new_paternal_last_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Campo: Apellido Materno -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="new_maternal_last_name" class="font-weight-bold">
                                                    <i class="fas fa-user-tag mr-2"></i>Apellido Materno
                                                </label>
                                                <input type="text" class="form-control @error('new_maternal_last_name') is-invalid @enderror" id="new_maternal_last_name" name="new_maternal_last_name" value="{{ old('new_maternal_last_name') }}" placeholder="Ej: Gómez">
                                                @error('new_maternal_last_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <!-- Campo: Nombres -->
                                    <div class="form-group mb-4">
                                        <label for="new_given_name" class="font-weight-bold">
                                            <i class="fas fa-user mr-2"></i>Nombres
                                        </label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('new_given_name') is-invalid @enderror" id="new_given_name" name="new_given_name" value="{{ old('new_given_name') }}" placeholder="Ej: Juan Carlos">
                                        @error('new_given_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Sección para agregar menores de edad dinámicamente -->
                <div id="minors-container">
                    <!-- Bloque inicial para un menor -->
                    <div class="minor-block">
                        <h4 class="font-weight-bold">Crear Nuevo Menor de Edad</h4>
                        <hr>
                        <div class="row">
                            <!-- Columna izquierda: Documento de Identidad -->
                            <div class="col-md-5">
                                <div class="row">
                                    <!-- Campo: Número de Documento -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="id" class="font-weight-bold">
                                                <i class="fas fa-id-card mr-2"></i>Número de Documento
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control @error('minors.0.id') is-invalid @enderror" name="minors[0][id]" placeholder="Ej: 12345678" required>
                                            @error('minors.0.id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Campo: Tipo de Documento -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="identity_document" class="font-weight-bold">
                                                <i class="fas fa-file-alt mr-2"></i>Tipo de Documento
                                            </label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control @error('minors.0.identity_document') is-invalid @enderror" name="minors[0][identity_document]" required>
                                                <option value="" disabled selected class="placeholder-option">Seleccione un documento</option>
                                                @foreach($documentTypes as $type)
                                                    <option value="{{ $type }}" {{ $type == 'DNI' ? 'selected' : '' }}>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                            @error('minors.0.identity_document')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Campo: Fecha de Nacimiento -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="birth_date" class="font-weight-bold">
                                                <i class="fas fa-calendar-alt mr-2"></i>Fecha de Nacimiento
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="date" class="form-control @error('minors.0.birth_date') is-invalid @enderror" name="minors[0][birth_date]" value="{{ old('minors.0.birth_date') }}" required>
                                            @error('minors.0.birth_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Campo: Sexo -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-venus-mars mr-2"></i>Sexo
                                            </label>
                                            <span class="text-danger">*</span>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <!-- Botón para Femenino -->
                                                <label class="btn sex-button @error('minors.0.sex_type') is-invalid @enderror">
                                                    <input type="radio" name="minors[0][sex_type]" value="0" required {{ old('minors.0.sex_type') == '0' ? 'checked' : '' }}>
                                                    <i class="fas fa-venus mr-2"></i> Femenino
                                                </label>
                                                <!-- Botón para Masculino -->
                                                <label class="btn sex-button @error('minors.0.sex_type') is-invalid @enderror">
                                                    <input type="radio" name="minors[0][sex_type]" value="1" required {{ old('minors.0.sex_type') == '1' ? 'checked' : '' }}>
                                                    <i class="fas fa-mars mr-2"></i> Masculino
                                                </label>
                                            </div>
                                            @error('minors.0.sex_type')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <!-- Línea divisoria -->
                             <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <div class="vertical-divider"></div>
                            </div>

                            <!-- Columna derecha: Apellidos y nombres del familiar -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Campo: Apellido Paterno -->
                                        <div class="form-group mb-4">
                                            <label for="paternal_last_name" class="font-weight-bold">
                                                <i class="fas fa-user mr-2"></i>Apellido Paterno
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="minors[0][paternal_last_name]" placeholder="Ej: Pérez" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Campo: Apellido Materno -->
                                        <div class="form-group mb-4">
                                            <label for="maternal_last_name" class="font-weight-bold">
                                                <i class="fas fa-user mr-2"></i>Apellido Materno
                                            </label>
                                            <input type="text" class="form-control" name="minors[0][maternal_last_name]" placeholder="Ej: Gómez">
                                        </div>
                                    </div>
                                </div>

                                <!-- Campo: Nombre -->
                                <div class="form-group mb-4">
                                    <label for="given_name" class="font-weight-bold">
                                        <i class="fas fa-user mr-2"></i>Nombre
                                    </label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="minors[0][given_name]" placeholder="Ej: Juan" required>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 30px;"></div>
                        <div class="row align-items-center">
                            <!-- Campo: Parentesco -->
                            <div class="col-md-4"> 
                                <div class="form-group mb-4 d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-2">
                                        <i class="fas fa-handshake mr-2 align-self-center"></i>
                                        <label for="kinship" class="font-weight-bold mb-0">
                                            Parentesco
                                        </label>
                                        <span class="text-danger">*</span>
                                    </div>
                                    
                                    <select name="minors[0][kinship]" class="form-control @error('minors.0.kinship') is-invalid @enderror" required>
                                        <option value="" disabled selected class="placeholder-option">Seleccione una relación</option>
                                        @foreach($kinships as $kinship)
                                            <option value="{{ $kinship }}" {{ old('minors.0.kinship') == $kinship ? 'selected' : '' }}>
                                                {{ $kinship }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('minors.0.kinship')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Espaciado -->
                            <div class="col-md-1"></div>

                            <!-- Campo: Condición -->
                            <div class="col-md-3"> 
                                <div class="form-group mb-4 d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-2">
                                        <i class="fas fa-heartbeat mr-2 align-self-center"></i>
                                        <label for="condition" class="font-weight-bold mb-0">
                                            Condición
                                        </label>
                                        <span class="text-danger">*</span>
                                    </div>                                                        

                                    <select class="form-control @error('minors.0.condition') is-invalid @enderror" name="minors[0][condition]" required>
                                        <option value="" disabled selected class="placeholder-option">Seleccione la condición</option>
                                        @foreach($conditions as $condition)
                                            <option value="{{ $condition }}" {{ old('minors.0.condition') == $condition ? 'selected' : '' }}>
                                                {{ $condition }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('minors.0.condition')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Espaciado -->
                            <div class="col-md-1"></div>
                            
                            <!-- Campo: Discapacidad -->
                            <div class="col-md-3"> 
                                <div class="form-group mb-4 d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-2">
                                        <i class="fas fa-wheelchair mr-2 align-self-center"></i>
                                        <label for="disability" class="font-weight-bold mb-0">
                                            Discapacidad
                                        </label>
                                    </div>
                                    
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <!-- Opción No -->
                                        <label class="btn sex-button">
                                            <input type="radio" name="minors[0][disability]" value="0">
                                            <i class="fas fa-times-circle mr-2"></i> No
                                        </label>
                                        
                                        <!-- Opción Sí -->
                                        <label class="btn sex-button">
                                            <input type="radio" name="minors[0][disability]" value="1">
                                            <i class="fas fa-check-circle mr-2"></i> Sí
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-bottom: 30px;"></div>

                        <div class="row">
                            <!-- Columna izquierda -->
                            <div class="col-md-5">
                                <div class="row">
                                    <!-- Campo: Dirección -->
                                    <div class="col-md-7">
                                        <div class="form-group mb-4">
                                            <label for="address" class="font-weight-bold">
                                                <i class="fas fa-map-marker-alt mr-2"></i>Dirección
                                            </label>
                                            <input type="text" class="form-control @error('minors.0.address') is-invalid @enderror" name="minors[0][address]" value="{{ old('minors.0.address') }}" placeholder="Ej: Av. Principal 123">
                                            @error('minors.0.address')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Campo: Tipo de Vivienda -->
                                    <div class="col-md-5">                                        
                                        <div class="form-group mb-4">
                                            <label for="dwelling_type" class="font-weight-bold">
                                                <i class="fas fa-home mr-2"></i>Tipo de Vivienda
                                            </label>
                                            <select class="form-control @error('minors.0.dwelling_type') is-invalid @enderror" name="minors[0][dwelling_type]" required>
                                                <option value="" disabled selected class="placeholder-option">Seleccione el tipo de vivienda</option>
                                                @foreach($dwellingTypes as $dwelling)
                                                    <option value="{{ $dwelling }}" {{ old('minors.0.dwelling_type') == $dwelling ? 'selected' : '' }}>
                                                        {{ $dwelling }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('minors.0.dwelling_type')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>   
                                    </div>
                                </div>
                            </div>
        
                            <!-- Línea divisoria -->
                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <div class="vertical-divider"></div>
                            </div>
        
                            <!-- Columna derecha -->
                            <div class="col-md-6">
                                <div class="row">
                                    <!-- Campo: Nivel Educativo -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="education_level" class="font-weight-bold">
                                                <i class="fas fa-graduation-cap mr-2"></i>Nivel Educativo
                                            </label>
                                            <select class="form-control @error('minors.0.education_level') is-invalid @enderror" name="minors[0][education_level]" required>
                                                <option value="" disabled selected class="placeholder-option">Seleccione el nivel educativo</option>
                                                @foreach($educationLevels as $level)
                                                    <option value="{{ $level }}" {{ old('minors.0.education_level') == $level ? 'selected' : '' }}>
                                                        {{ $level }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('minors.0.education_level')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Campo: Fecha de Registro -->
                                    <div class="col-md-6">                                        
                                        <div class="form-group mb-4">
                                            <label for="registration_date" class="font-weight-bold">
                                                <i class="fas fa-calendar-alt mr-2"></i>Fecha de Registro
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="date" class="form-control @error('minors.0.registration_date') is-invalid @enderror" name="minors[0][registration_date]" value="{{ old('minors.0.registration_date', now()->toDateString()) }}" required>
                                            @error('minors.0.registration_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                </div>                                                     
                            </div>
                        </div>
                        <!-- Botón para eliminar este bloque de menor -->
                        <button type="button" class="btn btn-danger btn-sm remove-minor-block">Eliminar Menor</button>
                        <div style="margin-top: 30px;"></div>
                        <hr>
                    </div>
                </div>

                <!-- Botón para agregar más menores -->
                <button type="button" id="add-minor-block" class="btn btn-secondary btn-sm">
                    <i class="fas fa-plus"></i> Agregar Otro Menor
                </button>

                <!-- Columna derecha: Fecha de Cambio y Descripción -->
                <div class="col-md-6">
                    <div class="row">
                        <!-- Campo: Descripción -->
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="description" class="font-weight-bold">
                                    <i class="fas fa-align-left mr-2"></i>Descripción
                                </label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" placeholder="Ej: Cambio de miembro">
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Card Footer -->
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-custom">Guardar Miembro y Menores</button>
                <a href="{{ route('committee_vl_family_members.index', ['committee_id' => $committee->id]) }}" class="btn btn-danger ml-2">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Inicializar Select2
            $('.select2').select2();
    
            // Contador para los bloques de menores
            let minorBlockCounter = 1;
    
            // Función para agregar un nuevo bloque de menor
            $('#add-minor-block').click(function () {
                const newBlock = $(`
                    <div class="minor-block">
                        <h4 class="font-weight-bold">Crear Nuevo Menor de Edad</h4>
                        <hr>
                        <div class="row">
                            <!-- Columna izquierda: Documento de Identidad -->
                            <div class="col-md-5">
                                <div class="row">
                                    <!-- Campo: Número de Documento -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="id" class="font-weight-bold">
                                                <i class="fas fa-id-card mr-2"></i>Número de Documento
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control @error('minors.${minorBlockCounter}.id') is-invalid @enderror" name="minors[${minorBlockCounter}][id]" placeholder="Ej: 12345678" required>
                                            @error('minors.${minorBlockCounter}.id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <!-- Campo: Tipo de Documento -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="identity_document" class="font-weight-bold">
                                                <i class="fas fa-file-alt mr-2"></i>Tipo de Documento
                                            </label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control @error('minors.${minorBlockCounter}.identity_document') is-invalid @enderror" name="minors[${minorBlockCounter}][identity_document]" required>
                                                <option value="" disabled selected class="placeholder-option">Seleccione un documento</option>
                                                @foreach($documentTypes as $type)
                                                    <option value="{{ $type }}" {{ $type == 'DNI' ? 'selected' : '' }}>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                            @error('minors.${minorBlockCounter}.identity_document')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <!-- Campo: Fecha de Nacimiento -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="birth_date" class="font-weight-bold">
                                                <i class="fas fa-calendar-alt mr-2"></i>Fecha de Nacimiento
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="date" class="form-control @error('minors.${minorBlockCounter}.birth_date') is-invalid @enderror" name="minors[${minorBlockCounter}][birth_date]" value="{{ old('minors.${minorBlockCounter}.birth_date') }}" required>
                                            @error('minors.${minorBlockCounter}.birth_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <!-- Campo: Sexo -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-venus-mars mr-2"></i>Sexo
                                            </label>
                                            <span class="text-danger">*</span>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <!-- Botón para Femenino -->
                                                <label class="btn sex-button @error('minors.${minorBlockCounter}.sex_type') is-invalid @enderror">
                                                    <input type="radio" name="minors[${minorBlockCounter}][sex_type]" value="0" required {{ old('minors.${minorBlockCounter}.sex_type') == '0' ? 'checked' : '' }}>
                                                    <i class="fas fa-venus mr-2"></i> Femenino
                                                </label>
                                                <!-- Botón para Masculino -->
                                                <label class="btn sex-button @error('minors.${minorBlockCounter}.sex_type') is-invalid @enderror">
                                                    <input type="radio" name="minors[${minorBlockCounter}][sex_type]" value="1" required {{ old('minors.${minorBlockCounter}.sex_type') == '1' ? 'checked' : '' }}>
                                                    <i class="fas fa-mars mr-2"></i> Masculino
                                                </label>
                                            </div>
                                            @error('minors.${minorBlockCounter}.sex_type')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Línea divisoria -->
                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <div class="vertical-divider"></div>
                            </div>
    
                            <!-- Columna derecha: Apellidos y nombres del familiar -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Campo: Apellido Paterno -->
                                        <div class="form-group mb-4">
                                            <label for="paternal_last_name" class="font-weight-bold">
                                                <i class="fas fa-user mr-2"></i>Apellido Paterno
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control @error('minors.${minorBlockCounter}.paternal_last_name') is-invalid @enderror" name="minors[${minorBlockCounter}][paternal_last_name]" placeholder="Ej: Pérez" required>
                                            @error('minors.${minorBlockCounter}.paternal_last_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <!-- Campo: Apellido Materno -->
                                        <div class="form-group mb-4">
                                            <label for="maternal_last_name" class="font-weight-bold">
                                                <i class="fas fa-user mr-2"></i>Apellido Materno
                                            </label>
                                            <input type="text" class="form-control @error('minors.${minorBlockCounter}.maternal_last_name') is-invalid @enderror" name="minors[${minorBlockCounter}][maternal_last_name]" placeholder="Ej: Gómez">
                                            @error('minors.${minorBlockCounter}.maternal_last_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Campo: Nombre -->
                                <div class="form-group mb-4">
                                    <label for="given_name" class="font-weight-bold">
                                        <i class="fas fa-user mr-2"></i>Nombre
                                    </label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control @error('minors.${minorBlockCounter}.given_name') is-invalid @enderror" name="minors[${minorBlockCounter}][given_name]" placeholder="Ej: Juan" required>
                                    @error('minors.${minorBlockCounter}.given_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
    
                        <div style="margin-top: 30px;"></div>
                        <div class="row align-items-center">
                            <!-- Campo: Parentesco -->
                            <div class="col-md-4"> 
                                <div class="form-group mb-4 d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-2">
                                        <i class="fas fa-handshake mr-2 align-self-center"></i>
                                        <label for="kinship" class="font-weight-bold mb-0">
                                            Parentesco
                                        </label>
                                        <span class="text-danger">*</span>
                                    </div>
                                    
                                    <select name="minors[${minorBlockCounter}][kinship]" class="form-control @error('minors.${minorBlockCounter}.kinship') is-invalid @enderror" required>
                                        <option value="" disabled selected class="placeholder-option">Seleccione una relación</option>
                                        @foreach($kinships as $kinship)
                                            <option value="{{ $kinship }}" {{ old('minors.${minorBlockCounter}.kinship') == $kinship ? 'selected' : '' }}>
                                                {{ $kinship }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('minors.${minorBlockCounter}.kinship')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <!-- Espaciado -->
                            <div class="col-md-1"></div>
    
                            <!-- Campo: Condición -->
                            <div class="col-md-3"> 
                                <div class="form-group mb-4 d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-2">
                                        <i class="fas fa-heartbeat mr-2 align-self-center"></i>
                                        <label for="condition" class="font-weight-bold mb-0">
                                            Condición
                                        </label>
                                        <span class="text-danger">*</span>
                                    </div>                                                        
    
                                    <select class="form-control @error('minors.${minorBlockCounter}.condition') is-invalid @enderror" name="minors[${minorBlockCounter}][condition]" required>
                                        <option value="" disabled selected class="placeholder-option">Seleccione la condición</option>
                                        @foreach($conditions as $condition)
                                            <option value="{{ $condition }}" {{ old('minors.${minorBlockCounter}.condition') == $condition ? 'selected' : '' }}>
                                                {{ $condition }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('minors.${minorBlockCounter}.condition')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <!-- Espaciado -->
                            <div class="col-md-1"></div>
                            
                            <!-- Campo: Discapacidad -->
                            <div class="col-md-3"> 
                                <div class="form-group mb-4 d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-2">
                                        <i class="fas fa-wheelchair mr-2 align-self-center"></i>
                                        <label for="disability" class="font-weight-bold mb-0">
                                            Discapacidad
                                        </label>
                                    </div>
                                    
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <!-- Opción No -->
                                        <label class="btn sex-button">
                                            <input type="radio" name="minors[${minorBlockCounter}][disability]" value="0">
                                            <i class="fas fa-times-circle mr-2"></i> No
                                        </label>
                                        
                                        <!-- Opción Sí -->
                                        <label class="btn sex-button">
                                            <input type="radio" name="minors[${minorBlockCounter}][disability]" value="1">
                                            <i class="fas fa-check-circle mr-2"></i> Sí
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-bottom: 30px;"></div>
    
                        <div class="row">
                            <!-- Columna izquierda -->
                            <div class="col-md-5">
                                <div class="row">
                                    <!-- Campo: Dirección -->
                                    <div class="col-md-7">
                                        <div class="form-group mb-4">
                                            <label for="address" class="font-weight-bold">
                                                <i class="fas fa-map-marker-alt mr-2"></i>Dirección
                                            </label>
                                            <input type="text" class="form-control @error('minors.${minorBlockCounter}.address') is-invalid @enderror" name="minors[${minorBlockCounter}][address]" value="{{ old('minors.${minorBlockCounter}.address') }}" placeholder="Ej: Av. Principal 123">
                                            @error('minors.${minorBlockCounter}.address')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <!-- Campo: Tipo de Vivienda -->
                                    <div class="col-md-5">                                        
                                        <div class="form-group mb-4">
                                            <label for="dwelling_type" class="font-weight-bold">
                                                <i class="fas fa-home mr-2"></i>Tipo de Vivienda
                                            </label>
                                            <select class="form-control @error('minors.${minorBlockCounter}.dwelling_type') is-invalid @enderror" name="minors[${minorBlockCounter}][dwelling_type]" required>
                                                <option value="" disabled selected class="placeholder-option">Seleccione el tipo de vivienda</option>
                                                @foreach($dwellingTypes as $dwelling)
                                                    <option value="{{ $dwelling }}" {{ old('minors.${minorBlockCounter}.dwelling_type') == $dwelling ? 'selected' : '' }}>
                                                        {{ $dwelling }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('minors.${minorBlockCounter}.dwelling_type')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>   
                                    </div>
                                </div>
                            </div>
            
                            <!-- Línea divisoria -->
                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <div class="vertical-divider"></div>
                            </div>
            
                            <!-- Columna derecha -->
                            <div class="col-md-6">
                                <div class="row">
                                    <!-- Campo: Nivel Educativo -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="education_level" class="font-weight-bold">
                                                <i class="fas fa-graduation-cap mr-2"></i>Nivel Educativo
                                            </label>
                                            <select class="form-control @error('minors.${minorBlockCounter}.education_level') is-invalid @enderror" name="minors[${minorBlockCounter}][education_level]" required>
                                                <option value="" disabled selected class="placeholder-option">Seleccione el nivel educativo</option>
                                                @foreach($educationLevels as $level)
                                                    <option value="{{ $level }}" {{ old('minors.${minorBlockCounter}.education_level') == $level ? 'selected' : '' }}>
                                                        {{ $level }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('minors.${minorBlockCounter}.education_level')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <!-- Campo: Fecha de Registro -->
                                    <div class="col-md-6">                                        
                                        <div class="form-group mb-4">
                                            <label for="registration_date" class="font-weight-bold">
                                                <i class="fas fa-calendar-alt mr-2"></i>Fecha de Registro
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="date" class="form-control @error('minors.${minorBlockCounter}.registration_date') is-invalid @enderror" name="minors[${minorBlockCounter}][registration_date]" value="{{ old('minors.${minorBlockCounter}.registration_date', now()->toDateString()) }}" required>
                                            @error('minors.${minorBlockCounter}.registration_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                </div>                                                     
                            </div>
                        </div>
                        <!-- Botón para eliminar este bloque de menor -->
                        <button type="button" class="btn btn-danger btn-sm remove-minor-block">Eliminar Menor</button>
                        <div style="margin-top: 30px;"></div>
                        <hr>
                    </div>
                `);
    
                $('#minors-container').append(newBlock);
                minorBlockCounter++;
    
                // Inicializar Select2 en el nuevo bloque
                newBlock.find('.select2').select2();
            });
    
            // Función para eliminar un bloque de menor
            $(document).on('click', '.remove-minor-block', function () {
                $(this).closest('.minor-block').remove();
            });
        });
    </script>
@endpush