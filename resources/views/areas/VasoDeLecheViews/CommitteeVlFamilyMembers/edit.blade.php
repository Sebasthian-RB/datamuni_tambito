@extends('adminlte::page')

@section('title', 'Editar Miembro del Comité')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* ===== ESTILOS PRINCIPALES ===== */
        :root {
            --color-primary: #3B1E54;
            --color-secondary: #9B7EBD;
            --color-accent: #D4BEE4;
            --color-background: #EEEEEE;
        }

        .container {
            padding-top: 20px;
        }

        .card {
            border: 1px solid var(--color-accent);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, var(--color-primary), #5A2E7A);
            color: #FFFFFF;
            padding: 25px 20px;
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
        }

        .card-subtitle {
            font-size: 1rem;
            color: var(--color-accent);
            margin-top: 5px;
        }

        .header-logo {
            height: 50px;
            transition: opacity 0.3s ease;
        }

        /* ===== ESTILOS PARA SECCIONES DE INFORMACIÓN ===== */
        .info-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
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
        }

        .info-card-text {
            font-size: 1rem;
            color: #343a40;
            font-weight: 500;
        }

        /* ===== ESTILOS PARA MENORES ===== */
        .minor-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #D4BEE4;
            box-shadow: 0 2px 6px rgba(155, 126, 189, 0.1);
        }

        .minor-alert {
            background: #FFE5E5;
            color: #B71C1C;
            border-left: 5px solid #B71C1C;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        /* ===== ESTILOS PARA FORMULARIOS ===== */
        .form-control {
            border: 1px solid var(--color-accent);
            border-radius: 6px;
            padding: 10px;
        }

        .btn-custom {
            background-color: var(--color-secondary);
            border-color: var(--color-secondary);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--color-primary);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 4px 12px rgba(155, 126, 189, 0.3);
        }

        .btn-secondary:hover {
            background-color: var(--color-primary);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 4px 12px rgba(155, 126, 189, 0.3);
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }
            
            .header-logo {
                margin-top: 10px;
            }
        }
    </style>
    <style>
        /* Estilos adicionales */
        .age-display {
            font-weight: 600;
            font-size: 0.95rem;
            padding: 4px 8px;
            border-radius: 12px;
            display: inline-block;
        }

        .text-danger {
            background: #FFEBEE;
            color: #C62828 !important;
            border: 1px solid #C62828;
        }

        .text-success {
            background: #E8F5E9;
            color: #2E7D32 !important;
            border: 1px solid #2E7D32;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .status-badge.active {
            background: #E8F5E9;
            color: #2E7D32;
            border: 1px solid #2E7D32;
        }

        .status-badge.inactive {
            background: #FFEBEE;
            color: #C62828;
            border: 1px solid #C62828;
        }
    </style>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="header-content">
                    <div>
                        <h1 class="card-title">
                            Editar Miembro del Comité
                            <span class="status-badge badge {{ $committeeVlFamilyMember->status ? 'badge-success' : 'badge-danger' }}">
                                {{ $committeeVlFamilyMember->status ? 'Activo' : 'Inactivo' }}
                            </span>
                        </h1>
                        <p class="card-subtitle">ID Registro: {{ $committeeVlFamilyMember->id }}</p>
                    </div>
                    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
                </div>
            </div>

            <form action="{{ route('committee_vl_family_members.update', $committeeVlFamilyMember->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <!-- Sección de Información Principal -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="info-card-header">
                                    <i class="fas fa-users info-card-icon"></i>
                                    <h5 class="info-card-label">Datos del Comité</h5>
                                </div>
                                <div class="info-card-text">
                                    <div>ID: {{ $committeeVlFamilyMember->committee->id }}</div>
                                    <div>Nombre: {{ $committeeVlFamilyMember->committee->name }}</div>
                                    <div>Ubicación: {{ $committeeVlFamilyMember->committee->location }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="info-card-header">
                                    <i class="fas fa-user info-card-icon"></i>
                                    <h5 class="info-card-label">Datos del Familiar</h5>
                                </div>
                                <div class="info-card-text">
                                    <div>ID: {{ $committeeVlFamilyMember->vlFamilyMember->id }}</div>
                                    <div>Documento: {{ $committeeVlFamilyMember->vlFamilyMember->identity_document }}</div>
                                    <div>Nombres: {{ $committeeVlFamilyMember->vlFamilyMember->full_name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Menores Corregida -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="mb-3" style="color: var(--color-primary); font-weight: 600; border-bottom: 2px solid var(--color-accent); padding-bottom: 10px;">
                                <i class="fas fa-child mr-2"></i>Menores asociados
                                <span class="badge badge-secondary">{{ $committeeVlFamilyMember->vlFamilyMember->vlMinors->count() }}</span>
                            </h5>

                            @forelse($committeeVlFamilyMember->vlFamilyMember->vlMinors as $minor)
                                @php
                                    $birthDate = \Carbon\Carbon::parse($minor->birth_date);
                                    $now = \Carbon\Carbon::now();
                                    $age = $birthDate->diff($now);
                                    $years = $age->y;
                                    $months = $age->m;
                                @endphp
                                
                                <div class="minor-card mb-3">
                                    <div class="row align-items-center">
                                        <!-- Documento -->
                                        <div class="col-md-3">
                                            <div class="info-item">
                                                <div class="text-muted small mb-1">DOCUMENTO</div>
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-2">
                                                        <i class="fas fa-id-card text-muted"></i>
                                                    </div>
                                                    <div>
                                                        <div class="info-value">{{ $minor->id }}</div>
                                                        <small class="text-muted">{{ $minor->identity_document_type }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Nombres -->
                                        <div class="col-md-4">
                                            <div class="info-item">
                                                <div class="text-muted small mb-1">NOMBRES COMPLETOS</div>
                                                <div class="info-value">
                                                    {{ $minor->paternal_last_name }} 
                                                    {{ $minor->maternal_last_name }} 
                                                    {{ $minor->given_name }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edad -->
                                        <div class="col-md-3">
                                            <div class="info-item">
                                                <div class="text-muted small mb-1">EDAD</div>
                                                <div class="age-display {{ ($years > 7) ? 'text-danger' : 'text-success' }}">
                                                    @if($years > 0)
                                                        {{ $years }} año{{ $years != 1 ? 's' : '' }}
                                                        @if($months > 0)
                                                            <span class="text-muted mx-1">•</span>{{ $months }}m
                                                        @endif
                                                    @else
                                                        {{ $months }}m
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Estado -->
                                        <div class="col-md-2">
                                            <div class="info-item">
                                                <div class="text-muted small mb-1">ESTADO</div>
                                                <div class="status-badge {{ $minor->status ? 'active' : 'inactive' }}">
                                                    {{ $minor->status ? 'Activo' : 'Inactivo' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="info-card text-center py-3">
                                    <i class="fas fa-child fa-2x text-muted mb-3"></i>
                                    <div class="text-muted">No se encontraron menores asociados</div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Campos Editables con Validación -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="change_date">
                                    <i class="fas fa-calendar-alt mr-2"></i>Fecha de Cambio *
                                </label>
                                <input type="date" 
                                    class="form-control @error('change_date') is-invalid @enderror" 
                                    name="change_date" 
                                    value="{{ old('change_date', $committeeVlFamilyMember->change_date->format('Y-m-d')) }}"
                                    required>
                                @error('change_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">
                                    <i class="fas fa-toggle-on mr-2"></i>Estado *
                                </label>
                                <select class="form-control @error('status') is-invalid @enderror" 
                                    name="status" 
                                    required>
                                    <option value="1" {{ old('status', $committeeVlFamilyMember->status) ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ !old('status', $committeeVlFamilyMember->status) ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description">
                                    <i class="fas fa-file-alt mr-2"></i>Descripción
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                    name="description" 
                                    rows="1">{{ old('description', $committeeVlFamilyMember->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Menores -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="mb-3" style="color: var(--color-primary); font-weight: 600;">
                                <i class="fas fa-child mr-2"></i>Menores asociados
                                <span class="badge badge-secondary">{{ $committeeVlFamilyMember->vlFamilyMember->vlMinors->count() }}</span>
                            </h5>

                            @forelse($committeeVlFamilyMember->vlFamilyMember->vlMinors as $minor)
                                <!-- Mantener la sección de menores como estaba -->
                            @empty
                                <div class="info-card text-center py-3">
                                    <i class="fas fa-child fa-lg text-muted mb-2"></i>
                                    <div class="text-muted">No hay menores registrados</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-custom">
                        <i class="fas fa-save mr-2"></i>Guardar Cambios
                    </button>
                    <a href="{{ route('committee_vl_family_members.index', ['committee_id' => $committeeVlFamilyMember->committee_id]) }}" 
                        class="btn btn-secondary">
                        <i class="fas fa-times-circle mr-2"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop