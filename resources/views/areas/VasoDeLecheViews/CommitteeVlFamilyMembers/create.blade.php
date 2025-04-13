@extends('adminlte::page')

@section('title', 'Agregar Miembro al Comité')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    
    <style>
        /* Estilo para el contenedor principal */
        .bg-light {
            background-color: #f8f9fa !important; /* Fondo claro */
        }

        .rounded-lg {
            border-radius: 15px !important; /* Bordes más redondeados */
        }

        .shadow-sm {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important; /* Sombra suave */
        }
    
        /* Aplica un estilo personalizado para la caja de selección de Select2 */
        .select2-container--default .select2-selection--single {
            height: 45px !important; /* Ajusta la altura del select */
            line-height: 45px !important; /* Alineación vertical del texto */
            font-size: 16px !important; /* Tamaño de fuente */
            background-color: #ffffff !important; /* Color de fondo igual que el card */
            border: 2px solid #9B7EBD !important; /* Borde similar al diseño del card */
            border-radius: 12px !important; /* Bordes redondeados */
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1) !important; /* Sombra suave */
        }
    
        /* Ajuste del padding para el texto */
        .select2-container--default .select2-selection__rendered {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
            color: #3B1E54 !important; /* Color del texto, como en el card */
        }
    
        /* Ajuste del dropdown de opciones */
        .select2-dropdown {
            max-height: 300px !important; /* Define la altura máxima */
            overflow-y: auto !important; /* Permite el scroll si es necesario */
            background-color: #D4BEE4 !important; /* Fondo similar al de la selección */
            border: 2px solid #9B7EBD !important; /* Borde del dropdown */
            border-radius: 12px !important; /* Bordes redondeados */
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1) !important; /* Sombra suave */
        }
    
        /* Estilo para los elementos del dropdown */
        .select2-results__option {
            padding: 10px !important; /* Aumentar padding para mejor clicabilidad */
            font-size: 16px !important; /* Ajustar tamaño de la fuente */
            color: #3B1E54 !important; /* Color del texto en las opciones */
        }
    
        /* Hover sobre los elementos del dropdown */
        .select2-results__option--highlighted {
            background-color: #9B7EBD !important; /* Color de fondo al pasar el mouse */
            color: white !important; /* Color del texto al pasar el mouse */
        }
        
        /* Estilos para campos editables */
        .editable-field {
            background-color: white !important; /* Fondo blanco */
            border: 1px solid #9B7EBD !important; /* Borde con color */
            padding: 10px;
            font-size: 13px !important; /* Tamaño de fuente */
        }

        .editable-field-minor {
            background-color: white !important; /* Fondo blanco */
            border: 1px solid #B8B8B8 !important; /* Borde con color */
            padding: 10px;
            font-size: 13px !important; /* Tamaño de fuente */
        }

        /*Estilos para el boton de agregar familiar*/
        .btn-purple {
            background-color: #9B7EBD !important; /* Color morado */
            border: none !important;
            color: white !important;
            transition: background-color 0.3s ease !important;
        }

        .btn-purple:hover {
            background-color: var(--color-primary) !important;
            border-color: var(--color-primary) !important;
            color: white !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2) !important;
        }

        /*Estilos para el boton de agregar Menor*/
        .button-minor:hover {
            transform: scale(1.02) !important;
            background: linear-gradient(135deg, #7B5E9D, #9B7EBD) !important;
            box-shadow: 0px 8px 20px rgba(155, 126, 189, 0.5) !important;
        }

        .btn-lg {
            padding: 10px 20px !important; /* Botón más grande */
            font-size: 16px !important;
        }

        /* Estilo para el separador visual */
        .text-muted {
            font-size: 18px !important;
            color: #6c757d !important; /* Color gris */
        }

        /* Estilo para el texto descriptivo */
        .text-dark {
            color: #3B1E54 !important; /* Color morado oscuro */
        }

        .font-weight-medium {
            font-weight: 500 !important; /* Texto semi-negrita */
        }
    </style>

    <style>
        /* ===== ESTILOS EXISTENTES ===== */
        :root {
            --color-primary: #3B1E54;
            --color-secondary: #9B7EBD;
            --color-accent: #D4BEE4;
            --color-background: #EEEEEE;
        }

        .card {
            border: 1px solid var(--color-accent);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            padding-top: 20px;
        }

        .card-header {
            background: linear-gradient(135deg, var(--color-primary), #5A2E7A);
            color: #FFFFFF;
            padding: 25px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-highlight {
            font-weight: 800;
            color: #f5f5f5;
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

        label {
            color: var(--color-primary);
            font-weight: bold;
        }

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

        .form-control option {
            color: var(--color-primary);
        }

        .form-control option.placeholder-option {
            color: #999;
            font-style: italic;
        }

        .fas {
            color: var(--color-secondary);
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 12px;
        }

        .btn-custom {
            background-color: #9B7EBD;
            border-color: #9B7EBD;
            color: white;
        }

        .btn-custom:hover,
        .btn-danger:hover {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .vertical-divider {
            width: 1px;
            height: 100%;
            background-color: var(--color-accent);
        }

        @media (max-width: 768px) {
            .col-md-6, .col-md-4, .col-md-8, .col-md-5, .col-md-1 {
                width: 100%;
            }

            .vertical-divider {
                display: none;
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
                width: 100%;
                margin-bottom: 10px;
            }

            .btn-danger {
                margin-left: 0 !important;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-control {
                font-size: 16px;
            }
        }

        /* ===== AJUSTE PARA MODAL ===== */
        .modal-content {
            background: white;
            border: none;
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
    </style>

    <style>
        /* ESTILOS PARA MOSTRAR DATOS DEL COMITÉ */

        /* Estilos para las tarjetas de información */
        .info-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            height: 100%;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .info-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .info-card-icon {
            font-size: 1.2rem;
            color: #8E6AB8;
            margin-right: 8px;
        }

        .info-card-label {
            color: #2c2c2c;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0;
        }

        .info-card-text {
            font-size: 1rem;
            color: #343a40;
            font-weight: 500;
            margin-bottom: 0;
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .info-card {
                margin-bottom: 15px;
            }
        }
    </style>
@stop

@section('content_header')
@stop

@section('content')
    <div class="container">
        <form action="{{ route('committee_vl_family_members.store', ['committee_id' => $committee->id]) }}" method="POST">
            @csrf

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <div class="header-content">
                        <div>
                            <h1 class="card-title">
                                Formulario para agregar miembro al comité <span class="card-highlight">{{ $committee->name ?? 'No disponible' }}</span>
                            </h1>
                            <p class="card-subtitle">Complete el formulario para agregar un nuevo miembro.</p>
                        </div>
                       <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
                    </div>
                </div>
                <div class="card-body">
                    <!-- Campo oculto para el ID del comité -->
                    <input type="hidden" name="committee_id" id="committee_id" value="{{ $committee->id }}">

                    <!-- Campo oculto para la fecha y hora actual -->
                    <input type="hidden" name="change_date" id="change_date" value="{{ now() }}">

                    <!-- Campo oculto para el estado (siempre activo) -->
                    <input type="hidden" name="status" id="status" value="1">

                    <!-- Información del Comité (Solo visible, no editable) -->
                    <div class="row">
                        <!-- Columna 1: Ubicación -->
                        <div class="col-md-3 mb-3">
                            <div class="info-card">
                                <div class="info-card-header">
                                    <i class="fas fa-map-marker-alt info-card-icon"></i>
                                    <label class="info-card-label">Ubicación</label>
                                </div>
                                <p class="info-card-text">{{ $committee->location ?? 'No disponible' }}</p>
                            </div>
                        </div>
                
                        <!-- Columna 2: Presidente(a) -->
                        <div class="col-md-3 mb-3">
                            <div class="info-card">
                                <div class="info-card-header">
                                    <i class="fas fa-user-tie info-card-icon"></i>
                                    <label class="info-card-label">Presidente(a)</label>
                                </div>
                                <p class="info-card-text">{{ $committee->president ?? 'No disponible' }}</p>
                            </div>
                        </div>
                
                        <!-- Columna 3: Urban Core -->
                        <div class="col-md-3 mb-3">
                            <div class="info-card">
                                <div class="info-card-header">
                                    <i class="fas fa-city info-card-icon"></i>
                                    <label class="info-card-label">Urban Core</label>
                                </div>
                                <p class="info-card-text">{{ $committee->urban_core ?? 'No disponible' }}</p>
                            </div>
                        </div>
                
                        <!-- Columna 4: Sector -->
                        <div class="col-md-3 mb-3">
                            <div class="info-card">
                                <div class="info-card-header">
                                    <i class="fas fa-bullseye info-card-icon"></i>
                                    <label class="info-card-label">Sector</label>
                                </div>
                                <p class="info-card-text">{{ $committee->sector->name ?? 'No disponible' }}</p>
                            </div>
                        </div>
                    </div>

                    <hr>
                    
                    <!-- Selección del Miembro de Familia -->
                    <div class="form-group">
                        <label for="vl_family_member_id">
                            <i class="fas fa-user mr-2"></i>Miembro de Familia
                        </label>
                        <span class="text-danger">*</span>
                        <div class="d-flex justify-content-center align-items-center bg-light p-4 rounded-lg shadow-sm m-2">
                            <!-- Opción: Crear uno nuevo -->
                            <div class="d-flex flex-column align-items-center text-center mx-2 mx-md-5">
                                <span class="mb-2 text-dark font-weight-medium">Crear uno nuevo:</span>
                                <button type="button" class="btn btn-purple btn-lg" data-toggle="modal" data-target="#addFamilyMemberModal">
                                    <i class="fas fa-plus text-white"></i> Agregar Nuevo Familiar
                                </button>
                            </div>
                            
                            <!-- Separador visual con menos espacio -->
                            <div class="text-muted mx-3">o</div>
                    
                            <!-- Opción: Agregar familiar existente -->
                            <div class="d-flex flex-column align-items-center text-center mx-2 mx-md-5">
                                <span class="mb-2 text-dark font-weight-medium">Agregar familiar existente:</span>
                                <select class="form-control select2 @error('vl_family_member_id') is-invalid @enderror" id="vl_family_member_id" name="vl_family_member_id" required>
                                    <option value="" disabled selected>Seleccione un miembro de familia</option>
                                    @foreach($vlFamilyMembers as $member)
                                        <option value="{{ $member->id }}" 
                                            data-id="{{ $member->id }}"
                                            data-identity="{{ $member->identity_document }}"
                                            data-given-name="{{ $member->given_name }}"
                                            data-paternal="{{ $member->paternal_last_name }}"
                                            data-maternal="{{ $member->maternal_last_name }}"
                                            data-minors="{{ json_encode($member->vlMinors) }}"
                                            {{ old('vl_family_member_id') == $member->id ? 'selected' : '' }}>
                                            {{ $member->id }} - {{ $member->given_name }} {{ $member->paternal_last_name }} {{ $member->maternal_last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('vl_family_member_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Card Principal para Familiar - Oculto por Defecto -->
                    <div id="family-member-details" class="card" 
                        style="display: none; background-color: #D4BEE4; border: none; border-radius: 12px; 
                            padding: 10px; box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.08); max-width: 900px; 
                            margin: auto; transition: all 0.3s ease;">

                        <div class="card-body">
                            <!-- Título y Botón de Editar -->
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 text-center text-md-start">
                                <h5 class="card-title mb-2 mb-md-0" 
                                    style="color: #3B1E54; font-weight: bold; font-size: clamp(18px, 2vw, 20px);">
                                    🟣 Detalles del Familiar
                                </h5>
                                <button type="button" class="btn btn-sm" 
                                    style="background-color: #3B1E54; color: #FFFFFF; min-width: 90px;" 
                                    id="editFamilyMemberBtn">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                            </div>

                            <div class="row">
                                <!-- Sección 1: ID y Documento -->
                                <div class="col-md-5 mb-3">
                                    <div class="info-box h-100" style="background: white; border-radius: 10px; padding: 15px 20px; border-left: 4px solid #9B7EBD; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);">
                                        <div class="row">
                                            <!-- Columna ID -->
                                            <div class="col-12 mb-2"> 
                                                <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">ID</label>
                                                <input type="text" class="form-control" id="member_id" disabled 
                                                    style="border: none; background: transparent; font-size: 16px; 
                                                        font-weight: bold; color: #3B1E54;">
                                            </div>
                                            
                                            <!-- Columna Documento -->
                                            <div class="col-12"> 
                                                <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">Documento</label>
                                                <input type="text" class="form-control" id="identity_document" disabled 
                                                    style="border: none; background: transparent; font-size: 16px; 
                                                        font-weight: bold; color: #3B1E54;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sección 2: Nombre y Apellidos -->
                                <div class="col-md-7 mb-3">
                                    <div class="info-box h-100"
                                        style="background: white; border-radius: 10px; padding: 15px 20px; 
                                            border-left: 4px solid #9B7EBD; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);">  
                                        <div class="row">
                                            <!-- Apellido Paterno -->
                                            <div class="col-md-6 mb-2">
                                                <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">Apellido Paterno</label>
                                                <input type="text" class="form-control" id="paternal_last_name" disabled 
                                                    style="border: none; background: transparent; font-size: 16px; 
                                                        font-weight: bold; color: #3B1E54;">
                                            </div>
                                            
                                            <!-- Apellido Materno -->
                                            <div class="col-md-6 mb-2">
                                                <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">Apellido Materno</label>
                                                <input type="text" class="form-control" id="maternal_last_name" disabled 
                                                    style="border: none; background: transparent; font-size: 16px; 
                                                        font-weight: bold; color: #3B1E54;">
                                            </div>

                                            <!-- Nombres -->
                                            <div class="col-12">
                                                <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">Nombres</label>
                                                <input type="text" class="form-control" id="given_name" disabled 
                                                    style="border: none; background: transparent; font-size: 16px; 
                                                        font-weight: bold; color: #3B1E54;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones (solo visibles si los campos son editables) -->
                            <div id="saveCancelButtons" class="text-center mt-4" style="display: none;">
                                <button type="button" class="btn btn-custom" id="saveFamilyMemberBtn">Actualizar datos</button>
                                <button type="button" class="btn btn-danger" id="cancelEditBtn">Cancelar</button>
                            </div>   
                        </div>
                    </div>

                    <!-- Contenedor para mostrar menores de edad -->
                    <div id="minor-details-container"></div>

                    <!-- Descripción -->
                    <div class="form-group">
                        <label for="description">
                            <i class="fas fa-sticky-note mr-2"></i>Descripción
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-custom">Guardar Miembro</button>
                    <a href="{{ route('committee_vl_family_members.index', ['committee_id' => $committee->id]) }}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    @if(session()->has('confirmation_needed'))
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background: linear-gradient(45deg, #5A2E7A, #9B4D96); color: white; font:bold">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmación necesaria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Este familiar ya está registrado en otro comité. ¿Está seguro de que desea moverlo?</p>
                        <p class="text-danger"><strong>Nota:</strong> Si confirma, el estado del registro anterior será inactivo y este nuevo será el activo.</p>
                        
                        <!-- Aquí mostramos los datos que recibe el modal -->
                        <hr>
                        <h6>Datos Recibidos:</h6>
                        <ul>
                            <li><strong>Committee ID:</strong> {{ session('committee_id', 'No recibido') }}</li>
                            <li><strong>Familiar ID:</strong> {{ session('existing_member_id', 'No recibido') }}</li>
                            <li><strong>Fecha de Cambio:</strong> {{ session('change_date', 'No recibido') }}</li>
                            <li><strong>Descripción:</strong> {{ session('description', 'No recibido') }}</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <form id="confirmUpdateForm" action="{{ route('committee_vl_family_members.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="committee_id" value="{{ session('committee_id') }}">
                            <input type="hidden" name="vl_family_member_id" value="{{ session('existing_member_id') }}">
                            <input type="hidden" name="change_date" value="{{ session('change_date') }}">
                            <input type="hidden" name="description" value="{{ session('description') }}">
                            <input type="hidden" name="confirm_update" value="1">
                            <input type="hidden" name="status" value="1">

                            <button type="submit" class="btn btn-custom">Sí, actualizar</button>
                        </form>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal para agregar nuevo familiar -->
    <div class="modal fade" id="addFamilyMemberModal" tabindex="-1" role="dialog" aria-labelledby="addFamilyMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="card">
                    <!-- Encabezado -->
                    <div class="card-header">
                        <div class="header-content">
                            <div>
                                <h1 class="card-title">Formulario para agregar miembro de familia</h1>
                                <p class="card-subtitle">Complete los campos para registrar un nuevo miembro de familia.</p>
                            </div>
                            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
                        </div>
                    </div>
    
                    <!-- Cuerpo -->
                    <form id="addFamilyMemberForm" action="{{ route('vl_family_members.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-5">
                                    <div class="row">
                                        <!-- Número de Documento -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="id" class="font-weight-bold">
                                                    <i class="fas fa-hashtag mr-2"></i>Número de Documento
                                                </label>
                                                <span class="text-danger">*</span>
                                                <input type="text" 
                                                    class="form-control @error('id') is-invalid @enderror" 
                                                    id="id" 
                                                    name="id" 
                                                    value="{{ old('id') }}"
                                                    placeholder="Ej: 12345678" 
                                                    required>
                                                @error('id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
    
                                        <!-- Tipo de Documento -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="identity_document" class="font-weight-bold">
                                                    <i class="fas fa-id-card mr-2"></i>Tipo de Documento
                                                </label>
                                                <span class="text-danger">*</span>
                                                <select class="form-control @error('identity_document') is-invalid @enderror" 
                                                        id="identity_document" 
                                                        name="identity_document" 
                                                        required>
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
    
                                <!-- Divisor Vertical -->
                                <div class="col-md-1 d-flex justify-content-center align-items-center">
                                    <div class="vertical-divider"></div>
                                </div>
    
                                <!-- Columna Derecha -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <!-- Apellido Paterno -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="paternal_last_name" class="font-weight-bold">
                                                    <i class="fas fa-user-tag mr-2"></i>Apellido Paterno
                                                </label>
                                                <span class="text-danger">*</span>
                                                <input type="text" 
                                                    class="form-control @error('paternal_last_name') is-invalid @enderror" 
                                                    id="paternal_last_name" 
                                                    name="paternal_last_name" 
                                                    value="{{ old('paternal_last_name') }}"
                                                    placeholder="Ej: Pérez" 
                                                    required>
                                                @error('paternal_last_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
    
                                        <!-- Apellido Materno -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="maternal_last_name" class="font-weight-bold">
                                                    <i class="fas fa-user-tag mr-2"></i>Apellido Materno
                                                </label>
                                                <input type="text" 
                                                    class="form-control @error('maternal_last_name') is-invalid @enderror" 
                                                    id="maternal_last_name" 
                                                    name="maternal_last_name" 
                                                    value="{{ old('maternal_last_name') }}"
                                                    placeholder="Ej: Gómez">
                                                @error('maternal_last_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
    
                                        <!-- Nombres -->
                                        <div class="col-12">
                                            <div class="form-group mb-4">
                                                <label for="given_name" class="font-weight-bold">
                                                    <i class="fas fa-user mr-2"></i>Nombres
                                                </label>
                                                <span class="text-danger">*</span>
                                                <input type="text" 
                                                    class="form-control @error('given_name') is-invalid @enderror" 
                                                    id="given_name" 
                                                    name="given_name" 
                                                    value="{{ old('given_name') }}"
                                                    placeholder="Ej: Juan Carlos" 
                                                    required>
                                                @error('given_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- Pie -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-custom">Guardar Miembro</button>
                            <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Menores -->
    <div class="modal fade" id="minorsModal" tabindex="-1" role="dialog" aria-labelledby="minorsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="card">
                    <!-- Encabezado -->
                    <div class="card-header">
                        <div class="header-content">
                            <div>
                                <h1 class="card-title">Formulario para agregar menor de edad</h1>
                                <p class="card-subtitle">Complete los campos para registrar un nuevo menor.</p>
                            </div>
                            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
                        </div>
                    </div>
    
                    <!-- Cuerpo -->
                    <form id="addMinorForm" action="{{ route('vl_minors.store') }}" method="POST">
                        @csrf
                        <!-- Campo oculto para el estado -->
                        <input type="hidden" name="status" value="1">
                        
                        <!-- Campo oculto para el familiar (se actualizará dinámicamente) -->
                        <input type="hidden" name="vl_family_member_id" id="selected_family_member_id" value="">
                        
                        <div class="card-body">
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
                                                <input type="text" class="form-control @error('id') is-invalid @enderror" 
                                                    name="id" 
                                                    placeholder="Ej: 12345678" 
                                                    required>
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
                                                <select class="form-control @error('identity_document') is-invalid @enderror" 
                                                    name="identity_document" 
                                                    required>
                                                    <option value="" disabled selected>Seleccione un documento</option>
                                                    @foreach($documentTypes as $type)
                                                        <option value="{{ $type }}" {{ $type == 'DNI' ? 'selected' : '' }}>
                                                            {{ $type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('identity_document')
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
                                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                                    name="birth_date" 
                                                    value="{{ old('birth_date') }}" 
                                                    required>
                                                @error('birth_date')
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
                                                    <label class="btn sex-button @error('sex_type') is-invalid @enderror">
                                                        <input type="radio" name="sex_type" value="0" required {{ old('sex_type') == '0' ? 'checked' : '' }}>
                                                        <i class="fas fa-venus mr-2"></i> Femenino
                                                    </label>
                                                    <!-- Botón para Masculino -->
                                                    <label class="btn sex-button @error('sex_type') is-invalid @enderror">
                                                        <input type="radio" name="sex_type" value="1" required {{ old('sex_type') == '1' ? 'checked' : '' }}>
                                                        <i class="fas fa-mars mr-2"></i> Masculino
                                                    </label>
                                                </div>
                                                @error('sex_type')
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
                                                <input type="text" class="form-control" 
                                                    name="paternal_last_name" 
                                                    placeholder="Ej: Pérez" 
                                                    required>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6">
                                            <!-- Campo: Apellido Materno -->
                                            <div class="form-group mb-4">
                                                <label for="maternal_last_name" class="font-weight-bold">
                                                    <i class="fas fa-user mr-2"></i>Apellido Materno
                                                </label>
                                                <input type="text" class="form-control" 
                                                    name="maternal_last_name" 
                                                    placeholder="Ej: Gómez">
                                            </div>
                                        </div>
                                    </div>
    
                                    <!-- Campo: Nombre -->
                                    <div class="form-group mb-4">
                                        <label for="given_name" class="font-weight-bold">
                                            <i class="fas fa-user mr-2"></i>Nombre
                                        </label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" 
                                            name="given_name" 
                                            placeholder="Ej: Juan" 
                                            required>
                                    </div>
                                </div>
                            </div>
    
                            <div style="margin-top: 30px;"></div>
                            <div class="row align-items-center">
                                <!-- Campo: Parentesco -->
                                <div class="col-md-3"> 
                                    <div class="form-group mb-4 d-flex align-items-center">
                                        <div class="d-flex align-items-center mr-2">
                                            <i class="fas fa-handshake mr-2 align-self-center"></i>
                                            <label for="kinship" class="font-weight-bold mb-0">
                                                Parentesco
                                            </label>
                                            <span class="text-danger">*</span>
                                        </div>
                                        
                                        <select name="kinship" class="form-control @error('kinship') is-invalid @enderror" required>
                                            <option value="" disabled selected>Seleccione una relación</option>
                                            @foreach($kinships as $kinship)
                                                <option value="{{ $kinship }}" {{ old('kinship') == $kinship ? 'selected' : '' }}>
                                                    {{ $kinship }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kinship')
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
                                        <select class="form-control @error('condition') is-invalid @enderror" name="condition" required>
                                            <option value="" disabled selected>Seleccione la condición</option>
                                            @foreach($conditions as $condition)
                                                <option value="{{ $condition }}" {{ old('condition') == $condition ? 'selected' : '' }}>
                                                    {{ $condition }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('condition')
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
                                                <input type="radio" name="disability" value="0">
                                                <i class="fas fa-times-circle mr-2"></i> No
                                            </label>
                                            <!-- Opción Sí -->
                                            <label class="btn sex-button">
                                                <input type="radio" name="disability" value="1">
                                                <i class="fas fa-check-circle mr-2"></i> Sí
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-bottom: 30px;"></div>
    

                            <div class="row justify-content-around mt-4">
                                <!-- Campo: Tiene SISFOH -->
                                <div class="col-md-4"> 
                                    <div class="form-group mb-4 d-flex align-items-center">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="d-flex align-items-center mr-2">
                                                <i class="fas fa-file-contract mr-2 align-self-center"></i>
                                                <label for="has_sisfoh" class="font-weight-bold mb-0">
                                                    ¿Tiene SISFOH?
                                                </label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <!-- Opción No -->
                                                <label class="btn sex-button">
                                                    <input type="radio" name="has_sisfoh" value="0">
                                                    <i class="fas fa-times-circle mr-2"></i> No
                                                </label>
                                                <!-- Opción Sí -->
                                                <label class="btn sex-button">
                                                    <input type="radio" name="has_sisfoh" value="1">
                                                    <i class="fas fa-check-circle mr-2"></i> Sí
                                                </label>
                                            </div>
                                        </div>
                                        @error('has_sisfoh')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                                        
                                <!-- Campo: Clasificación SISFOH -->
                                <div class="col-md-6" id="sisfohClassificationContainer">
                                    <div class="form-group mb-4 d-flex align-items-center">
                                        <div class="d-flex align-items-center mr-2">
                                            <i class="fas fa-list-ol mr-2 align-self-center"></i>
                                            <label for="sisfoh_classification" class="font-weight-bold mb-0">
                                                Clasificación SISFOH
                                            </label>
                                        </div>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            @foreach($sisfohClassifications as $classification)
                                                <label class="btn sex-button">
                                                    <input type="radio" name="sisfoh_classification" value="{{ $classification }}">
                                                    {{ $classification }}
                                                </label>
                                            @endforeach
                                        </div>
                                        @error('sisfoh_classification')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
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
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                                    name="address" 
                                                    value="{{ old('address') }}" 
                                                    placeholder="Ej: Av. Principal 123">
                                                @error('address')
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
                                                <select class="form-control @error('dwelling_type') is-invalid @enderror" name="dwelling_type">
                                                    <option value="" disabled selected>Seleccione el tipo de vivienda</option>
                                                    @foreach($dwellingTypes as $dwelling)
                                                        <option value="{{ $dwelling }}" {{ old('dwelling_type') == $dwelling ? 'selected' : '' }}>
                                                            {{ $dwelling }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('dwelling_type')
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
                                                <select class="form-control @error('education_level') is-invalid @enderror" name="education_level">
                                                    <option value="" disabled selected>Seleccione el nivel educativo</option>
                                                    @foreach($educationLevels as $level)
                                                        <option value="{{ $level }}" {{ old('education_level') == $level ? 'selected' : '' }}>
                                                            {{ $level }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('education_level')
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
                                                <input type="date" class="form-control @error('registration_date') is-invalid @enderror" 
                                                    name="registration_date" 
                                                    value="{{ old('registration_date', now()->toDateString()) }}" 
                                                    required>
                                                @error('registration_date')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> 
                                    </div>                                                     
                                </div>
                            </div>
                        </div>
    
                        <!-- Pie -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-custom">Guardar Menor</button>
                            <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Inicialización de Select2 -->
    <script>
        $(document).ready(function() {
            $('#vl_family_member_id').select2({
                placeholder: "Buscar por ID o nombre",
                allowClear: true,
                minimumInputLength: 0,
                matcher: function(params, data) {
                    if ($.trim(params.term) === '') {
                        return data;
                    }

                    if (!data.id || !data.element) {
                        return null;
                    }

                    // Convertir los valores a cadenas y a minúsculas para evitar errores
                    const term = params.term.toLowerCase();
                    const id = String(data.id).toLowerCase();
                    const givenName = (data.element.getAttribute('data-given-name') || '').toLowerCase();
                    const paternalLastName = (data.element.getAttribute('data-paternal') || '').toLowerCase();
                    const maternalLastName = (data.element.getAttribute('data-maternal') || '').toLowerCase();

                    // Comparar con el término de búsqueda
                    if (id.includes(term) || 
                        givenName.includes(term) || 
                        paternalLastName.includes(term) || 
                        maternalLastName.includes(term)) {
                        return data;
                    }

                    return null;
                },
                templateResult: formatResult,
                templateSelection: formatSelection
            });

            function formatResult(member) {
                if (!member.id || !member.element) {
                    return member.text;
                }

                const givenName = member.element.getAttribute('data-given-name') || '';
                const paternalLastName = member.element.getAttribute('data-paternal') || '';
                const maternalLastName = member.element.getAttribute('data-maternal') || '';

                return $(
                    `<div>
                        <strong>ID: ${member.id}</strong><br>
                        <small>Nombre: ${givenName} ${paternalLastName} ${maternalLastName}</small>
                    </div>`
                );
            }

            function formatSelection(member) {
                if (!member.id || !member.element) {
                    return member.text;
                }

                const givenName = member.element.getAttribute('data-given-name') || '';
                const paternalLastName = member.element.getAttribute('data-paternal') || '';
                const maternalLastName = member.element.getAttribute('data-maternal') || '';

                return `${member.id} - ${givenName} ${paternalLastName} ${maternalLastName}`;
            }

            $('#vl_family_member_id').on('select2:clear', function() {
                $(this).select2('close');
                $('#family-member-details').fadeOut();
                $('#minor-details-container').fadeOut().empty();
            });

            let preventOpening = false;
            $('#vl_family_member_id').on('select2:unselecting', function() {
                preventOpening = true;
            });

            $('#vl_family_member_id').on('select2:opening', function(e) {
                if (preventOpening) {
                    e.preventDefault();
                    preventOpening = false;
                }
            });
        });
    </script>


    <!-- Script para el modal -->
    @if(session()->has('confirmation_needed'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                console.log("Mostrando modal con los siguientes datos:");
                console.log("Committee ID:", "{{ session('committee_id') }}");
                console.log("Familiar ID:", "{{ session('existing_member_id') }}");
                console.log("Fecha de Cambio:", "{{ session('change_date') }}");
                console.log("Descripción:", "{{ session('description') }}");
                $('#confirmationModal').modal('show'); // Muestra el modal automáticamente
            });
        </script>
    @endif

    <!-- Script para mostrar datos del familiar -->
    <script>
        $(document).ready(function() {
            let originalValues = {}; // Objeto para almacenar los valores originales

            $('#vl_family_member_id').on('change', function() {
                const selected = $(this).find(':selected');

                // Si no hay selección, ocultar la tarjeta de datos del familiar
                if (!selected.val()) {
                    $('#family-member-details').fadeOut();
                    $('#minor-details-container').fadeOut(function() {
                        $(this).empty(); // Limpia completamente el contenido
                    });
                    return;
                }
                
                // Guardar valores originales correctamente
                originalValues = {
                    id: selected.attr('data-id') || '',
                    identity_document: selected.attr('data-identity') || '',
                    given_name: selected.attr('data-given-name') || '',
                    paternal_last_name: selected.attr('data-paternal') || '',
                    maternal_last_name: selected.attr('data-maternal') || '',
                    minors: JSON.parse(selected.attr('data-minors') || '[]')
                };

                // Asignar los valores a los campos del formulario
                $('#member_id').val(originalValues.id).prop('disabled', true).css('background-color', '#e9ecef');
                $('#identity_document').val(originalValues.identity_document).prop('disabled', true).css('background-color', '#e9ecef');
                $('#given_name').val(originalValues.given_name).prop('disabled', true).css('background-color', '#e9ecef');
                $('#paternal_last_name').val(originalValues.paternal_last_name).prop('disabled', true).css('background-color', '#e9ecef');
                $('#maternal_last_name').val(originalValues.maternal_last_name).prop('disabled', true).css('background-color', '#e9ecef');

                // Ajustar ancho original
                $('#given_name, #paternal_last_name, #maternal_last_name').css('width', '')

                // Ocultar mensajes de error si existen
                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');

                // Mostrar la tarjeta con los datos
                $('#family-member-details').show();
            });

            // Al hacer clic en "Editar"
            $('#editFamilyMemberBtn').on('click', function() {
                // Guardar valores actuales antes de editar
                originalValues.id = $('#member_id').val();
                originalValues.identity_document = $('#identity_document').val();
                originalValues.given_name = $('#given_name').val();
                originalValues.paternal_last_name = $('#paternal_last_name').val();
                originalValues.maternal_last_name = $('#maternal_last_name').val();

                // Habilitar edición en los otros campos
                $('#given_name, #paternal_last_name, #maternal_last_name')
                    .prop('disabled', false)
                    .css('background-color', 'white')
                    .addClass('editable-field');

                $('#saveCancelButtons').show();
                $(this).hide();
            });

            // Al hacer clic en "Cancelar"
            $('#cancelEditBtn').on('click', function() {
                // Restaurar los valores originales
                $('#member_id').val(originalValues.id).prop('disabled', true).removeClass('editable-field');
                $('#identity_document').val(originalValues.identity_document);
                $('#given_name').val(originalValues.given_name).prop('disabled', true).css('background-color', '#e9ecef').removeClass('editable-field');
                $('#paternal_last_name').val(originalValues.paternal_last_name).prop('disabled', true).css('background-color', '#e9ecef').removeClass('editable-field');
                $('#maternal_last_name').val(originalValues.maternal_last_name).prop('disabled', true).css('background-color', '#e9ecef').removeClass('editable-field');

                $('#saveCancelButtons').hide();
                $('#editFamilyMemberBtn').show();

                // Ocultar mensajes de error si existen
                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');
            });

            // Al hacer clic en "Guardar"
            $('#saveFamilyMemberBtn').on('click', function() {
                const memberId = $('#member_id').val();

                if (!memberId) {
                    alert("Error: No se ha seleccionado un miembro de familia.");
                    return;
                }

                const updateUrl = `{{ url('vl_family_members') }}/${memberId}`;

                const updatedData = {
                    _token: "{{ csrf_token() }}",
                    _method: "PUT",
                    id: memberId,
                    identity_document: $('#identity_document').val(),
                    given_name: $('#given_name').val(),
                    paternal_last_name: $('#paternal_last_name').val(),
                    maternal_last_name: $('#maternal_last_name').val(),
                };

                $.ajax({
                    url: updateUrl,
                    type: "POST",
                    data: updatedData,
                    success: function(response) {
                        alert('Datos actualizados correctamente');
                        $('#saveCancelButtons').hide();
                        $('#editFamilyMemberBtn').show();
                        $('#member_id, #identity_document, #given_name, #paternal_last_name, #maternal_last_name').prop('disabled', true).removeClass('editable-field').css('background-color', '#e9ecef');
                        
                        // Ocultar mensajes de error si existen
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');
                    },
                    error: function(xhr) {
                        
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            // Eliminar mensajes de error previos
                            $('.invalid-feedback').remove();
                            $('.is-invalid').removeClass('is-invalid');

                            $.each(errors, function(key, messages) {
                                let inputField = $('#' + key);

                                // Agregar clase de error al input
                                inputField.addClass('is-invalid');

                                // Mostrar el mensaje de error debajo del campo
                                inputField.after(`<div class="invalid-feedback">${messages[0]}</div>`);
                            });
                        } else {
                            console.log(xhr.responseText);
                            alert('Error al actualizar los datos: ' + xhr.responseText);
                        }
                    }
                });
            });
        });
    </script>

    <!-- Script para mostrar datos del menor de edad -->
    <script>
        // Función para convertir fechas a formato YYYY-MM-DD
        function formatDate(inputDate) {
            const date = new Date(inputDate);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');  // Asegura que el mes tenga 2 dígitos
            const day = String(date.getDate()).padStart(2, '0');  // Asegura que el día tenga 2 dígitos
            return `${year}-${month}-${day}`;
        }

        $(document).ready(function() {
            let originalMinorValues = {}; // Objeto para almacenar los valores originales del menor
        
            $('#vl_family_member_id').on('change', function() {
                const selected = $(this).find(':selected');
                const minorsData = JSON.parse(selected.attr('data-minors') || '[]'); // Obtener los menores asociados
        
                // Limpiar los detalles de los menores previos
                $('#minor-details-container').empty(); // Limpiar todos los cards existentes
        
                if (minorsData.length > 0) {
                    // Crear una fila (row) para los cards
                    const rowHTML = $('<div class="row row-cols-1 g-4"></div>'); // row-cols-md-2 para 2 cards por fila
        
                    minorsData.forEach(function(minor) {
                        originalMinorValues[minor.id] = { ...minor }; // Guardar valores originales

                        // Validar si birth_date está definido y tiene formato correcto
                        let age = 0;
                        if (minor.birth_date) {
                            let birthDate = new Date(minor.birth_date);
                            
                            if (!isNaN(birthDate.getTime())) { // Asegura que la fecha sea válida
                                const today = new Date();
                                age = today.getFullYear() - birthDate.getFullYear();
                                const monthDiff = today.getMonth() - birthDate.getMonth();
                                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                                    age--; // Ajustar si aún no ha cumplido años este año
                                }
                            } else {
                                console.warn(`Fecha inválida para el menor ID: ${minor.id} - Fecha recibida: ${minor.birth_date}`);
                            }
                        } else {
                            console.warn(`El menor con ID ${minor.id} no tiene fecha de nacimiento.`);
                        }

                        // Generar alerta si el menor tiene más de 7 años
                        const ageAlert = age > 7 ? `
                            <div class="d-flex align-items-center justify-content-center p-3" 
                                style="background: #FFE5E5; 
                                    color: #B71C1C; 
                                    border-left: 5px solid #B71C1C; 
                                    border-radius: 10px; 
                                    box-shadow: 0px 4px 10px rgba(183, 28, 28, 0.2); 
                                    font-weight: 600; 
                                    font-size: 16px; 
                                    padding: 15px; 
                                    margin-bottom: 15px;">
                                <i class="fas fa-exclamation-circle fa-lg me-2"></i>
                                <span>Advertencia: Este menor tiene <strong>${age}</strong> años.</span>
                            </div>


                        ` : '';

                        const cardHTML = `
                            <div id="minor-details-${minor.id}" class="col-12" style="padding: 25px">
                                <div class="card" style="background-color: #EEEEEE; border: none; border-radius: 12px;
                                    padding: 10px; box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; width: 100%;">
                                    
                                    <div class="card-body">
                                        ${ageAlert} <!-- Alerta si el menor tiene más de 7 años -->

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title text-center" style="color: #3B1E54; font-weight: bold; font-size: 20px; margin-bottom: 0;">
                                                ⚫ Detalles del Menor
                                            </h5>
                                            <button type="button" class="btn btn-warning btn-sm editMinorBtn" style="background-color: #3B1E54; color: #FFFFFF" data-id="${minor.id}">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </button>
                                        </div>

                                        <!-- Contenedor para las dos columnas -->
                                        <div class="row">
                                            <!-- Columna 1: Información básica + Apellidos y nombres -->
                                            <div class="col-md-6">
                                                <!-- Información básica -->
                                                <div class="info-box d-flex justify-content-between align-items-center" style="background: white; border-radius: 10px; padding: 15px 20px; border-left: 4px solid #B8B8B8; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);">
                                                    <div>
                                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                            <i class="fas fa-id-card"></i> ID
                                                        </label>
                                                        <input type="text" class="form-control" id="minor_id_${minor.id}" disabled value="${minor.id}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                    </div>
                                                    <div>
                                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                            <i class="fas fa-file-alt"></i> Documento
                                                        </label>
                                                        <input type="text" class="form-control" id="identity_document_${minor.id}" disabled value="${minor.identity_document}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                    </div>
                                                </div>

                                                <!-- Apellidos y nombres -->
                                                <div class="info-box d-flex flex-column mt-4" style="background: white; border-radius: 10px; padding: 15px 20px; border-left: 4px solid #B8B8B8; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                                Apellido Paterno
                                                            </label>
                                                            <input type="text" class="form-control" id="paternal_last_name_${minor.id}" disabled value="${minor.paternal_last_name}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                        </div>
                                                        <div>
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                                Apellido Materno
                                                            </label>
                                                            <input type="text" class="form-control" id="maternal_last_name_${minor.id}" disabled value="${minor.maternal_last_name}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                        </div>
                                                    </div>

                                                    <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                        Nombres
                                                    </label>
                                                    <input type="text" class="form-control" id="given_name_${minor.id}" disabled value="${minor.given_name}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                </div>

                                                <!-- Información SISFOH -->
                                                <div class="info-box d-flex flex-column mt-4" style="background: white; border-radius: 10px; padding: 15px 20px; border-left: 4px solid #B8B8B8; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);">
                                                    <div class="row g-3 align-items-center">
                                                        <div class="col-md-6">
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                                <i class="fas fa-file-contract"></i> ¿Tiene SISFOH?
                                                            </label>
                                                            <select class="form-control" id="has_sisfoh_${minor.id}" disabled 
                                                                style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                                <option value="1" ${minor.has_sisfoh ? 'selected' : ''}>Sí</option>
                                                                <option value="0" ${!minor.has_sisfoh ? 'selected' : ''}>No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                                <i class="fas fa-list-ol"></i> Clasificación
                                                            </label>
                                                            <select class="form-control" id="sisfoh_classification_${minor.id}" disabled 
                                                                style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                                <option value="">No especificado</option>
                                                                ${@json($sisfohClassifications).map(classification => 
                                                                    `<option value="${classification}" ${minor.sisfoh_classification === classification ? 'selected' : ''}>${classification}</option>`
                                                                ).join('')}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Columna 2: Información adicional -->
                                            <div class="col-md-6">
                                                <div class="info-box d-flex flex-column" style="background: white; border-radius: 10px; padding: 15px 20px; border-left: 4px solid #B8B8B8; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);">
                                                    
                                                    <div class="row g-3 align-items-center">
                                                        <div class="col-md-6 mb-3">
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                                <i class="fas fa-calendar-alt"></i> Fecha de Nacimiento
                                                            </label>
                                                            <input type="date" class="form-control" id="birth_date_${minor.id}" disabled value="${formatDate(minor.birth_date)}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                                <i class="fas fa-venus-mars"></i> Sexo
                                                            </label>
                                                            <select class="form-control" id="sex_type_${minor.id}" disabled 
                                                                style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                                ${Object.entries(@json($sexTypes)).map(([sex, value]) => 
                                                                    `<option value="${sex}" ${minor.sex_type == sex ? 'selected' : ''}>${value}</option>`
                                                                ).join('')}
                                                            </select>                                                   
                                                        </div>
                                                    </div>

                                                    <div class="row g-3 align-items-center">
                                                        <div class="col-md-4 mb-3">
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                                <i class="fas fa-clipboard-list"></i> Condición
                                                            </label>
                                                            <select class="form-control" id="condition_${minor.id}" disabled 
                                                                style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                                ${@json($conditions).map(condition => 
                                                                    `<option value="${condition}" ${minor.condition === condition ? 'selected' : ''}>${condition}</option>`
                                                                ).join('')}
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                                <i class="fas fa-users"></i> Relación
                                                            </label>
                                                            <select class="form-control" id="kinship_${minor.id}" disabled 
                                                                style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                                ${@json($kinships).map(kinship => 
                                                                    `<option value="${kinship}" ${minor.kinship === kinship ? 'selected' : ''}>${kinship}</option>`
                                                                ).join('')}
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                                <i class="fas fa-wheelchair"></i> Discapacidad
                                                            </label>
                                                            <select class="form-control" id="disability_${minor.id}" disabled 
                                                                style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                                ${Object.entries(@json($disabilities)).map(([disability, value]) => 
                                                                    `<option value="${disability}" ${minor.disability == disability ? 'selected' : ''}>${value}</option>`
                                                                ).join('')}
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                            <i class="fas fa-map-marker-alt"></i> Dirección
                                                        </label>
                                                        <input type="text" class="form-control" id="address_${minor.id}" disabled value="${minor.address}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                    </div>

                                                    <div class="row g-3 align-items-center">
                                                        <div class="col-md-6 mb-3">
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                                <i class="fas fa-home"></i> Tipo de Vivienda
                                                            </label>
                                                            <select class="form-control" id="dwelling_type_${minor.id}" disabled 
                                                                style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                                ${@json($dwellingTypes).map(dwelling => 
                                                                    `<option value="${dwelling}" ${minor.dwelling_type === dwelling ? 'selected' : ''}>${dwelling}</option>`
                                                                ).join('')}
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="col-md-6 mb-3">
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                                <i class="fas fa-graduation-cap"></i> Nivel de Educación
                                                            </label>
                                                            <select class="form-control" id="education_level_${minor.id}" disabled 
                                                                style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                                ${@json($educationLevels).map(level => 
                                                                    `<option value="${level}" ${minor.education_level === level ? 'selected' : ''}>${level}</option>`
                                                                ).join('')}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="saveCancelButtons_${minor.id}" class="text-center mt-4" style="display: none;">
                                            <button type="button" class="btn btn-success" id="saveMinorBtn_${minor.id}" data-id="${minor.id}" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">
                                                <i class="fas fa-save"></i> Actualizar datos
                                            </button>
                                            <button type="button" class="btn btn-secondary" id="cancelEditBtn_${minor.id}">
                                                <i class="fas fa-times-circle"></i> Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        // Añadir el card al contenedor de la fila
                        rowHTML.append(cardHTML);
                    });
        
                    // Añadir la fila completa al contenedor principal
                    $('#minor-details-container').append(rowHTML);
        
                    // Agregar botón después de los cards
                    $('#minor-details-container').append(`
                        <div class="text-center mt-4">
                            <button type="button" 
                                    class="btn button-minor btn-lg d-flex align-items-center justify-content-center gap-2 w-90 mx-auto py-3"
                                    data-toggle="modal" 
                                    data-target="#minorsModal"
                                    style="background: linear-gradient(135deg, #9B7EBD, #D4BEE4);
                                        border: 2px solid #FFFFFF;
                                        color: white;
                                        font-weight: 700;
                                        font-size: 18px;
                                        border-radius: 12px;
                                        box-shadow: 0px 6px 15px rgba(155, 126, 189, 0.3);
                                        letter-spacing: 0.5px;
                                        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
                                        transition: all 0.2s ease;">
                                <i class="fas fa-child fa-1x text-white mr-1"></i>
                                <span>¿DESEA AGREGAR UN MENOR DE EDAD?</span>
                            </button>
                        </div>
                    `);
                    // Mostrar la sección de detalles
                    $('#minor-details-container').show();
                } else {
                    $('#minor-details-container').html(`
                        <div class="d-flex flex-column align-items-center justify-content-center p-4"
                            style="background: #f5f5f5; 
                                color: #4a4a4a; 
                                border-radius: 10px; 
                                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); 
                                font-weight: 600; 
                                font-size: 16px; 
                                text-align: center; 
                                max-width: 400px; 
                                margin: 20px auto;">
                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                            <span>No hay menores asociados a este familiar.</span>
                        </div>

                        <button type="button" 
                                class="btn button-minor btn-lg d-flex align-items-center justify-content-center gap-2 w-90 mx-auto py-3"
                                data-toggle="modal" 
                                data-target="#minorsModal"
                                style="background: linear-gradient(135deg, #9B7EBD, #D4BEE4);
                                    border: 2px solid #FFFFFF;
                                    color: white;
                                    font-weight: 700;
                                    font-size: 18px;
                                    border-radius: 12px;
                                    box-shadow: 0px 6px 15px rgba(155, 126, 189, 0.3);
                                    letter-spacing: 0.5px;
                                    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
                                    transition: all 0.2s ease;">
                            <i class="fas fa-child fa-1x text-white mr-1"></i>
                            <span>¿DESEA AGREGAR UN MENOR DE EDAD?</span>
                        </button>
                    `).fadeIn();
                }
            });

            // Evento para editar los datos del menor
            $(document).on('click', '.editMinorBtn', function() {
                const minorId = $(this).data('id');

                // Habilitar todos los campos EXCEPTO ID y Documento de Identidad
                $(`#given_name_${minorId}, #paternal_last_name_${minorId}, #maternal_last_name_${minorId}, 
                #birth_date_${minorId}, #sex_type_${minorId}, #address_${minorId}, 
                #dwelling_type_${minorId}, #education_level_${minorId}, #condition_${minorId}, #kinship_${minorId}, #disability_${minorId}, #has_sisfoh_${minorId}, #sisfoh_classification_${minorId}`)
                    .prop('disabled', false)
                    .css('background-color', 'white')
                    .addClass('editable-field-minor');

                $(`#minor_id_${minorId}, #identity_document_${minorId}`)
                    .css('background-color', '#e9ecef');

                // Mostrar los botones de guardar y cancelar
                $(`#saveCancelButtons_${minorId}`).show();
                
                // Ocultar el botón de edición
                $(this).hide();
            });

            // Al hacer clic en "Cancelar"
            $(document).on('click', '[id^="cancelEditBtn_"]', function() {
                const minorId = $(this).attr('id').split('_')[1]; // Extraer el ID del menor a partir del id del botón

                // Restaurar los valores originales para este menor
                $(`#minor_id_${minorId}, #identity_document_${minorId}`)
                    .css('background-color', 'transparent');

                if (originalMinorValues[minorId]) {
                    $(`#given_name_${minorId}`).val(originalMinorValues[minorId].given_name).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#paternal_last_name_${minorId}`).val(originalMinorValues[minorId].paternal_last_name).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#maternal_last_name_${minorId}`).val(originalMinorValues[minorId].maternal_last_name).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#birth_date_${minorId}`).val(formatDate(originalMinorValues[minorId].birth_date)).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    
                    // Restaurar el valor de sexo con formato correcto
                    const sexValue = originalMinorValues[minorId].sex_type ? '1' : '0';
                    $(`#sex_type_${minorId}`).val(sexValue).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    
                    $(`#address_${minorId}`).val(originalMinorValues[minorId].address).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#dwelling_type_${minorId}`).val(originalMinorValues[minorId].dwelling_type).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#education_level_${minorId}`).val(originalMinorValues[minorId].education_level).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#condition_${minorId}`).val(originalMinorValues[minorId].condition).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#kinship_${minorId}`).val(originalMinorValues[minorId].kinship).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    
                    // Restaurar el valor de discapacidad con formato correcto
                    const disabilityValue = originalMinorValues[minorId].disability ? '1' : '0';
                    $(`#disability_${minorId}`).val(disabilityValue).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    
                    // Restaurar valor de has_sisfoh (formato booleano)
                    const hasSisfohValue = originalMinorValues[minorId].has_sisfoh ? '1' : '0';
                    $(`#has_sisfoh_${minorId}`).val(hasSisfohValue).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');

                    // Restaurar clasificación SISFOH
                    $(`#sisfoh_classification_${minorId}`).val(originalMinorValues[minorId].sisfoh_classification || '').prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');

                } else {
                    console.log("No se encontraron valores originales para este menor.");
                }

                // Ocultar botones de guardar/cancelar y mostrar el de editar
                $(`#saveCancelButtons_${minorId}`).fadeOut();
                $(`.editMinorBtn[data-id="${minorId}"]`).fadeIn();

                // Restablecer los estilos y elementos que estaban modificados
                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');
            });

            // Evento para guardar los cambios
            $(document).on('click', '[id^="saveMinorBtn_"]', function() {
                const minorId = $(this).data('id');

                const updateUrl = `{{ url('vl_minors') }}/${minorId}`;

                const updatedData = {
                    _token: "{{ csrf_token() }}",
                    _method: "PUT",
                    id: String(minorId), // Convertir a string porque en la BD es VARCHAR
                    identity_document: $(`#identity_document_${minorId}`).val() || originalMinorValues[minorId]?.identity_document || null,
                    given_name: $(`#given_name_${minorId}`).val() || originalMinorValues[minorId]?.given_name || null,
                    paternal_last_name: $(`#paternal_last_name_${minorId}`).val() || originalMinorValues[minorId]?.paternal_last_name || null,
                    maternal_last_name: $(`#maternal_last_name_${minorId}`).val() || originalMinorValues[minorId]?.maternal_last_name || null,
                    birth_date: formatDate($(`#birth_date_${minorId}`).val() || originalMinorValues[minorId]?.birth_date),
                    sex_type: $(`#sex_type_${minorId}`).val() !== undefined ? parseInt($(`#sex_type_${minorId}`).val()) : (originalMinorValues[minorId]?.sex_type ? 1 : 0),
                    registration_date: formatDate($(`#registration_date_${minorId}`).val() || originalMinorValues[minorId]?.registration_date),
                    withdrawal_date: formatDate($(`#withdrawal_date_${minorId}`).val() || originalMinorValues[minorId]?.withdrawal_date),
                    address: $(`#address_${minorId}`).val() || originalMinorValues[minorId]?.address || null,
                    dwelling_type: $(`#dwelling_type_${minorId}`).val() || originalMinorValues[minorId]?.dwelling_type || null,
                    education_level: $(`#education_level_${minorId}`).val() || originalMinorValues[minorId]?.education_level || null,
                    condition: $(`#condition_${minorId}`).val() || originalMinorValues[minorId]?.condition || null,
                    disability: $(`#disability_${minorId}`).val() !== undefined ? parseInt($(`#disability_${minorId}`).val()) : (originalMinorValues[minorId]?.disability ? 1 : 0),
                    kinship: $(`#kinship_${minorId}`).val() || originalMinorValues[minorId]?.kinship || null,
                    has_sisfoh: $(`#has_sisfoh_${minorId}`).val() !== undefined ? parseInt($(`#has_sisfoh_${minorId}`).val()) : (originalMinorValues[minorId]?.has_sisfoh ? 1 : 0),
                    sisfoh_classification: $(`#sisfoh_classification_${minorId}`).val() || originalMinorValues[minorId]?.sisfoh_classification || null,
                    vl_family_member_id: $(`#vl_family_member_id_${minorId}`).val() || originalMinorValues[minorId]?.vl_family_member_id || null,
                    status: $(`#status_${minorId}`).val() !== undefined ? parseInt($(`#status_${minorId}`).val()) : (originalMinorValues[minorId]?.status ? 1 : 0),
                };

                // Función para formatear fechas correctamente
                function formatDate(date) {
                    if (!date) return null;
                    return date.split("T")[0]; // Extraer solo la parte "YYYY-MM-DD"
                }

                // Verificar los datos antes de enviarlos
                console.log("Datos a enviar:", updatedData);

                $.ajax({
                    url: updateUrl,
                    type: "POST",
                    data: updatedData,
                    success: function(response) {
                        alert('Datos del menor actualizados correctamente');

                        // Deshabilitar los campos nuevamente
                        $(`#given_name_${minorId}, #paternal_last_name_${minorId}, #maternal_last_name_${minorId}, 
                        #birth_date_${minorId}, #sex_type_${minorId}, #address_${minorId}, 
                        #dwelling_type_${minorId}, #education_level_${minorId}, #condition_${minorId}, #kinship_${minorId}, #disability_${minorId}, #has_sisfoh_${minorId}, #sisfoh_classification_${minorId}`)
                            .prop('disabled', true)
                            .removeClass('editable-field-minor')
                            .css('background-color', 'transparent');

                        // Ocultar botones de guardar/cancelar y mostrar el de editar
                        $(`#saveCancelButtons_${minorId}`).hide();
                        $(`.editMinorBtn[data-id="${minorId}"]`).show();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            // Eliminar mensajes previos
                            $(`#minor-details-${minorId} .invalid-feedback`).remove();
                            $(`#minor-details-${minorId} .is-invalid`).removeClass('is-invalid');

                            // Mostrar nuevos errores
                            $.each(errors, function(key, messages) {
                                let inputField = $(`#${key}_${minorId}`);
                                inputField.addClass('is-invalid');
                                inputField.after(`<div class="invalid-feedback">${messages[0]}</div>`);
                            });
                        } else {
                            console.error('Error:', xhr.responseText);
                            alert('Error al actualizar los datos.');
                        }
                    }
                });
            });

        });
    </script>

    <!-- Script para el modal de creación de familiar -->
    <script>
        $(document).ready(function() {
            $('#addFamilyMemberForm').on('submit', function(e) {
                e.preventDefault();
                
                var form = $(this);
                var url = form.attr('action');
                
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // Crear nueva opción en el select2
                        const newOption = new Option(
                            `${response.given_name} ${response.paternal_last_name} ${response.maternal_last_name}`,
                            response.id,
                            true,
                            true
                        );
                        
                        // Agregar datos adicionales
                        $(newOption).attr({
                            'data-id': response.id,
                            'data-identity': response.identity_document,
                            'data-given-name': response.given_name,
                            'data-paternal': response.paternal_last_name,
                            'data-maternal': response.maternal_last_name,
                            'data-minors': JSON.stringify([])
                        });
                        
                        // Agregar y actualizar select2
                        $('#vl_family_member_id').append(newOption).trigger('change');
                        $('#vl_family_member_id').val(response.id).trigger('change');
                        
                        // Cerrar modal y resetear
                        $('#addFamilyMemberModal').modal('hide');
                        $('.modal-backdrop').remove();
                        form[0].reset();
                        
                        // Limpiar errores
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            $('.invalid-feedback').remove();
                            $('.is-invalid').removeClass('is-invalid');
                            
                            // Mostrar errores
                            Object.keys(errors).forEach(function(field) {
                                const input = $(`[name="${field}"]`);
                                input.addClass('is-invalid');
                                input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                            });
                        } else {
                            alert('Error inesperado: ' + xhr.responseText);
                        }
                    }
                });
            });
        });
    </script>

    <!-- Script para el modal de creación de menor -->
    <script>
        $(document).ready(function() {
            $('#minorsModal').on('show.bs.modal', function() {
                const selectedFamilyId = $('#vl_family_member_id').val();
                $('#selected_family_member_id').val(selectedFamilyId);
            });
    
            $('#addMinorForm').on('submit', function(e) {
                e.preventDefault();
                
                const form = $(this);
                const url = form.attr('action');
    
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $('#minorsModal').modal('hide');

                        setTimeout(() => {
                            form[0].reset();
                            $('.invalid-feedback').remove();
                            $('.is-invalid').removeClass('is-invalid');
                        }, 300);

                        // Verificar que la respuesta contiene los datos esperados
                        if (!response.data) {
                            console.error('❌ Error: No se recibieron datos válidos del servidor.');
                            toastr.error('Error al registrar el menor. Inténtalo de nuevo.');
                            return;
                        }

                        const minorData = response.data;
                        console.log("✅ Datos del menor:", minorData);

                        // Verificar que los atributos obligatorios están presentes
                        const requiredFields = ['id', 'identity_document', 'given_name', 'paternal_last_name', 'birth_date', 'sex_type', 'condition', 'kinship', 'has_sisfoh'];
                        const missingFields = requiredFields.filter(field => minorData[field] === undefined || minorData[field] === null || minorData[field] === '');
                        
                        if (missingFields.length > 0) {
                            console.error('❌ Faltan los siguientes campos obligatorios:', missingFields);
                            toastr.error('Error en los datos recibidos. Faltan campos obligatorios.');
                            return;
                        }

                        const selectedOption = $('#vl_family_member_id option:selected');
                        const currentMinors = JSON.parse(selectedOption.attr('data-minors') || '[]');

                        currentMinors.push({
                            id: minorData.id,  // Obligatorio, no se asigna valor por defecto
                            identity_document: minorData.identity_document,
                            given_name: minorData.given_name,
                            paternal_last_name: minorData.paternal_last_name,
                            maternal_last_name: minorData.maternal_last_name ?? null, // Nullable
                            birth_date: minorData.birth_date.split('T')[0], 
                            sex_type: Boolean(minorData.sex_type),
                            registration_date: new Date().toISOString().split('T')[0], // Fecha actual
                            condition: minorData.condition,
                            kinship: minorData.kinship,
                            has_sisfoh: Boolean(minorData.has_sisfoh),
                            // Campos opcionales
                            address: minorData.address || '',
                            dwelling_type: minorData.dwelling_type ?? null,
                            education_level: minorData.education_level ?? null,
                            disability: minorData.disability !== undefined ? Boolean(minorData.disability) : null,
                            status: true, // Siempre activo por defecto
                            vl_family_member_id: selectedOption.val(),
                            sisfoh_classification: minorData.sisfoh_classification ?? null,
                        });

                        selectedOption.attr('data-minors', JSON.stringify(currentMinors));
                        $('#vl_family_member_id').trigger('change');

                        toastr.success(response.message || 'Menor registrado exitosamente');
                    },

                    error: function(xhr) {
                        if(xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            $('.invalid-feedback').remove();
                            $('.is-invalid').removeClass('is-invalid');
                            
                            Object.keys(errors).forEach(field => {
                                const input = form.find(`[name="${field}"]`);
                                input.addClass('is-invalid');
                                input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                            });
                        } else {
                            toastr.error(xhr.responseJSON.message || 'Error inesperado al procesar la solicitud');
                        }
                    }
                });
            });
    
            // Limpiar el formulario al cerrar el modal
            $('#minorsModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');
                
                // 2. Limpiar clases activas de TODOS los grupos de botones
    $(this).find('.btn-group .btn').each(function() {
        $(this).removeClass('active'); // Elimina la clase visual
        $(this).find('input[type="radio"]').prop('checked', false); // Asegura deselección
    });

                // Eliminar backdrop residual
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open').css('padding-right', '');
            });
        });
    </script>
@stop