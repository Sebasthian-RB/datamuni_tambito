@extends('adminlte::page')

@section('title', 'Editar Menor')

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
    
        /* Estilos personalizados para el botón "Guardar Menor" */
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
    <form action="{{ route('vl_minors.update', $vlMinor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <!-- Card Header -->
            <div class="card-header">
                <div class="header-content">
                    <div>
                        <h1 class="card-title">Formulario para editar Menor</h1>
                        <p class="card-subtitle">Complete los campos para actualizar la información.</p>
                    </div>
                    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <!-- Sección del Menor -->
                    <div class="col-md-12">
                        <div class="row">
                            <!-- Columna izquierda -->
                            <div class="col-md-5">
                                <div class="row">
                                    <!-- Campo: Número de Documento -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="id" class="font-weight-bold">
                                                <i class="fas fa-id-card mr-2"></i>Número de Documento
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id', $vlMinor->id) }}" placeholder="Ej: 12345678" required>
                                            @error('id')
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
                                            <select class="form-control @error('identity_document') is-invalid @enderror" id="identity_document" name="identity_document" required>
                                                <option value="" disabled selected>Seleccione un documento</option>
                                                @foreach($documentTypes as $type)
                                                    <option value="{{ $type }}" {{ old('identity_document', $vlMinor->identity_document) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                            @error('identity_document')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Campo: Apellido Paterno -->
                                <div class="form-group mb-4">
                                    <label for="paternal_last_name" class="font-weight-bold">
                                        <i class="fas fa-user mr-2"></i>Apellido Paterno
                                    </label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control @error('paternal_last_name') is-invalid @enderror" id="paternal_last_name" name="paternal_last_name" value="{{ old('paternal_last_name', $vlMinor->paternal_last_name) }}" placeholder="Ej: Pérez" required>
                                    @error('paternal_last_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo: Apellido Materno -->
                                <div class="form-group mb-4">
                                    <label for="maternal_last_name" class="font-weight-bold">
                                        <i class="fas fa-user mr-2"></i>Apellido Materno
                                    </label>
                                    <input type="text" class="form-control @error('maternal_last_name') is-invalid @enderror" id="maternal_last_name" name="maternal_last_name" value="{{ old('maternal_last_name', $vlMinor->maternal_last_name) }}" placeholder="Ej: Gómez">
                                    @error('maternal_last_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo: Nombre -->
                                <div class="form-group mb-4">
                                    <label for="given_name" class="font-weight-bold">
                                        <i class="fas fa-user mr-2"></i>Nombre
                                    </label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name" name="given_name" value="{{ old('given_name', $vlMinor->given_name) }}" placeholder="Ej: Juan" required>
                                    @error('given_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- Campo: Fecha de Nacimiento -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="birth_date" class="font-weight-bold">
                                                <i class="fas fa-calendar-alt mr-2"></i>Fecha de Nacimiento
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" 
                                                   value="{{ old('birth_date', $vlMinor->birth_date ? $vlMinor->birth_date->format('Y-m-d') : '') }}" required>
                                            @error('birth_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Campo: Sexo -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="sex_type" class="font-weight-bold">
                                                <i class="fas fa-venus-mars mr-2"></i>Sexo
                                            </label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control @error('sex_type') is-invalid @enderror" id="sex_type" name="sex_type" required>
                                                <option value="" disabled selected>Seleccione el sexo</option>
                                                <option value="0" {{ old('sex_type', $vlMinor->sex_type) == '0' ? 'selected' : '' }}>Femenino</option>
                                                <option value="1" {{ old('sex_type', $vlMinor->sex_type) == '1' ? 'selected' : '' }}>Masculino</option>
                                            </select>
                                            @error('sex_type')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Campo: Condición -->
                                    <div class="col-md-6"> 
                                        <div class="form-group mb-4">
                                            <label for="condition" class="font-weight-bold">
                                                <i class="fas fa-heartbeat mr-2"></i>Condición
                                            </label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control @error('condition') is-invalid @enderror" id="condition" name="condition" required>
                                                <option value="" disabled selected>Seleccione la condición</option>
                                                <option value="Gest." {{ old('condition', $vlMinor->condition) == 'Gest.' ? 'selected' : '' }}>Gestante</option>
                                                <option value="Lact." {{ old('condition', $vlMinor->condition) == 'Lact.' ? 'selected' : '' }}>Lactante</option>
                                                <option value="Anc." {{ old('condition', $vlMinor->condition) == 'Anc.' ? 'selected' : '' }}>Anciano</option>
                                            </select>
                                            @error('condition')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Campo: Discapacidad -->
                                    <div class="col-md-6"> 
                                        <div class="form-group mb-4">
                                            <label for="disability" class="font-weight-bold">
                                                <i class="fas fa-wheelchair mr-2"></i>Discapacidad
                                            </label>
                                            <select class="form-control @error('disability') is-invalid @enderror" id="disability" name="disability">
                                                <option value="" disabled selected>Seleccione si tiene discapacidad</option>
                                                <option value="0" {{ old('disability', $vlMinor->disability) == '0' ? 'selected' : '' }}>No</option>
                                                <option value="1" {{ old('disability', $vlMinor->disability) == '1' ? 'selected' : '' }}>Sí</option>
                                            </select>
                                            @error('disability')
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
        
                            <!-- Columna derecha -->
                            <div class="col-md-6">
                                <div class="row">
                                    <!-- Campo: Fecha de Registro -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="registration_date" class="font-weight-bold">
                                                <i class="fas fa-calendar-alt mr-2"></i>Fecha de Registro
                                            </label>
                                            <span class="text-danger">*</span>
                                            <input type="date" class="form-control @error('registration_date') is-invalid @enderror" id="registration_date" name="registration_date" 
                                                   value="{{ old('registration_date', $vlMinor->registration_date ? $vlMinor->registration_date->format('Y-m-d') : '') }}" required>
                                            @error('registration_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Campo: Fecha de Retiro -->
                                    <div class="col-md-6">                                        
                                        <div class="form-group mb-4">
                                            <label for="withdrawal_date" class="font-weight-bold">
                                                <i class="fas fa-calendar-alt mr-2"></i>Fecha de Retiro
                                            </label>
                                            <input type="date" class="form-control @error('withdrawal_date') is-invalid @enderror" id="withdrawal_date" name="withdrawal_date" 
                                                   value="{{ old('withdrawal_date', $vlMinor->withdrawal_date ? $vlMinor->withdrawal_date->format('Y-m-d') : '') }}">
                                            @error('withdrawal_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>   
                                </div>

                                <!-- Campo: Dirección -->
                                <div class="form-group mb-4">
                                    <label for="address" class="font-weight-bold">
                                        <i class="fas fa-map-marker-alt mr-2"></i>Dirección
                                    </label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $vlMinor->address) }}" placeholder="Ej: Av. Principal 123">
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo: Tipo de Vivienda -->
                                <div class="form-group mb-4">
                                    <label for="dwelling_type" class="font-weight-bold">
                                        <i class="fas fa-home mr-2"></i>Tipo de Vivienda
                                    </label>
                                    <select class="form-control @error('dwelling_type') is-invalid @enderror" id="dwelling_type" name="dwelling_type">
                                        <option value="" disabled selected>Seleccione el tipo de vivienda</option>
                                        <option value="Propio" {{ old('dwelling_type', $vlMinor->dwelling_type) == 'Propio' ? 'selected' : '' }}>Propio</option>
                                        <option value="Alquilado" {{ old('dwelling_type', $vlMinor->dwelling_type) == 'Alquilado' ? 'selected' : '' }}>Alquilado</option>
                                    </select>
                                    @error('dwelling_type')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo: Nivel Educativo -->
                                <div class="form-group mb-4">
                                    <label for="education_level" class="font-weight-bold">
                                        <i class="fas fa-graduation-cap mr-2"></i>Nivel Educativo
                                    </label>
                                    <select class="form-control @error('education_level') is-invalid @enderror" id="education_level" name="education_level">
                                        <option value="" disabled selected>Seleccione el nivel educativo</option>
                                        <option value="Ninguno" {{ old('education_level', $vlMinor->education_level) == 'Ninguno' ? 'selected' : '' }}>Ninguno</option>
                                        <option value="Inicial" {{ old('education_level', $vlMinor->education_level) == 'Inicial' ? 'selected' : '' }}>Inicial</option>
                                        <option value="Primaria" {{ old('education_level', $vlMinor->education_level) == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                                        <option value="Secundaria" {{ old('education_level', $vlMinor->education_level) == 'Secundaria' ? 'selected' : '' }}>Secundaria</option>
                                        <option value="Técnico" {{ old('education_level', $vlMinor->education_level) == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                                        <option value="Superior" {{ old('education_level', $vlMinor->education_level) == 'Superior' ? 'selected' : '' }}>Superior</option>
                                    </select>
                                    @error('education_level')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                                               
                                <div class="row">
                                    <!-- Campo: Miembro de Familia -->
                                    <div class="col-md-6"> 
                                        <div class="form-group mb-4">
                                            <label for="vl_family_member_id" class="font-weight-bold">
                                                <i class="fas fa-users mr-2"></i>Miembro de Familia
                                            </label>
                                            <span class="text-danger">*</span>
                                            <select name="vl_family_member_id" id="vl_family_member_id" class="form-control select2 @error('vl_family_member_id') is-invalid @enderror" required>
                                                <option value="">Seleccione un miembro de la familia</option>
                                                @foreach($vlFamilyMembers as $member)
                                                    <option value="{{ $member->id }}" 
                                                        @if(old('vl_family_member_id', $vlMinor->vl_family_member_id) == $member->id) selected @endif>
                                                        {{ $member->id }}  <!-- Mostrar solo el ID del miembro -->
                                                    </option>
                                                @endforeach
                                            </select>                             
                                            @error('vl_family_member_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Campo: Parentesco -->
                                    <div class="col-md-6"> 
                                        <div class="form-group mb-4">
                                            <label for="kinship" class="font-weight-bold">
                                                <i class="fas fa-handshake mr-2"></i>Parentesco
                                            </label>
                                            <span class="text-danger">*</span>
                                            <select name="kinship" id="kinship" class="form-control @error('kinship') is-invalid @enderror" required>
                                                <option value="" disabled selected>Seleccione una relación</option>
                                                <option value="Hijo(a)" {{ old('kinship', $vlMinor->kinship) == 'Hijo(a)' ? 'selected' : '' }}>Hijo(a)</option>
                                                <option value="Socio(a)" {{ old('kinship', $vlMinor->kinship) == 'Socio(a)' ? 'selected' : '' }}>Socio(a)</option>
                                            </select>
                                            @error('kinship')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Campo: Estado -->
                                <div class="form-group mb-4">
                                    <label for="status" class="font-weight-bold">
                                        <i class="fas fa-check-circle mr-2"></i>Estado
                                    </label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="" disabled selected>Seleccione el estado</option>
                                        <option value="1" {{ old('status', $vlMinor->status) == '1' ? 'selected' : '' }}>Activo</option>
                                        <option value="0" {{ old('status', $vlMinor->status) == '0' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                    @error('status')
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
                <button type="submit" class="btn btn-custom">Actualizar Menor</button>
                <a href="{{ route('vl_minors.index') }}" class="btn btn-danger ml-2">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush