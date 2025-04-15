@extends('adminlte::page')

@section('title', 'Crear Sesión Psicológica')

@section('content_header')
    <div class="diagnostic-banner">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1>Registrar Sesión Psicológica</h1>
            <p class="lead">Gestión de sesiones terapéuticas</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow-lg border-0">
            <div class="card-header gradient-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-comments"></i> Formulario de Sesión</h3>
                    <a href="{{ route('psychological-sessions.index') }}" class="btn btn-outline-light btn-elevate">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('psychological-sessions.store') }}" method="POST" class="session-form">
                    @csrf

                    <div class="form-group-enhanced">
                        <label class="form-label">Seleccionar Diagnóstico</label>
                        <div class="patient-select-container">
                            <select name="diagnosis_id" id="diagnosis_id" class="form-control select2-enhanced" required>
                                <option value="">-- Buscar diagnóstico --</option>
                                @foreach ($diagnoses as $diagnosis)
                                    <option value="{{ $diagnosis->id }}"
                                        data-recommended="{{ $diagnosis->recommended_sessions }}">
                                        {{ $diagnosis->person->given_name }} {{ $diagnosis->person->paternal_last_name }}
                                        {{ $diagnosis->person->maternal_last_name }}
                                        @if ($diagnosis->diagnosis)
                                            || {{ Str::limit($diagnosis->diagnosis, 50) }} ||
                                        @endif
                                        {{ \Carbon\Carbon::parse($diagnosis->diagnosis_date)->format('d/m/Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group-enhanced">
                                <label class="form-label">Número de Sesión</label>
                                <div class="input-container">
                                    <i class="fas fa-sort-numeric-up input-icon"></i>
                                    <select name="session_number" id="session_number" class="form-control" required>
                                        <option value="">-- Seleccione el número --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-enhanced">
                                
                                <label class="form-label">Fecha Programada</label>
                                <div class="input-container">
                                    <input type="date" name="scheduled_date" id="scheduled_date" class="form-control"
                                        value="{{ now()->toDateString() }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group-enhanced">
                                <label class="form-label">Estado de Asistencia</label>
                                <div class="input-container">
                                    <i class="fas fa-clipboard-check input-icon"></i>
                                    <select name="attendance_status" id="attendance_status" class="form-control" required>
                                        <option value="">-- Seleccione estado --</option>
                                        <option value="Asistió">Asistió</option>
                                        <option value="No asistió">No asistió</option>
                                        <option value="Justificó">Justificó</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-enhanced">
                                <label class="form-label">Descripción</label>
                                <div class="input-container">
                                    <i class="fas fa-file-alt input-icon"></i>
                                    <textarea name="description" id="description" class="form-control" rows="3"
                                        placeholder="Detalles de la sesión..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions text-right mt-4">
                        <button type="submit" class="btn btn-success btn-elevate btn-lg">
                            <i class="fas fa-save"></i> Guardar Sesión
                        </button>
                        <a href="{{ route('psychological-sessions.index') }}"
                            class="btn btn-outline-secondary btn-elevate btn-lg">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Mantener todos los estilos CSS del ejemplo original */
        :root {
            --primary-color: #2A5C82;
            --secondary-color: #5DA9E9;
            --accent-color: #FF6B6B;
            --soft-bg: #f8f9fa;
        }

        .diagnostic-banner {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            height: 250px;
            border-radius: 0 0 30px 30px;
            position: relative;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
        }

        .banner-content {
            position: relative;
            z-index: 1;
            color: white;
            padding: 3rem;
            text-align: center;
        }

        .card.shadow-lg {
            border-radius: 15px;
            overflow: hidden;
        }

        .gradient-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
        }

        .form-control {
            border: 2px solid #dee2e6;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            transition: all 0.3s ease;
        }

        .input-container {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            z-index: 2;
        }

        select.form-control {
            padding-left: 45px;
        }

        textarea.form-control {
            padding-left: 45px;
            min-height: 120px;
        }

        .btn-elevate {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            margin-left: 10px;
        }

        .select2-container--default .select2-selection--single {
            height: auto !important;
            padding: 0.8rem 1.5rem;
            border: 2px solid #dee2e6 !important;
            border-radius: 12px !important;
        }

        /* Alinear iconos con Select2 */
        .select2~.input-icon {
            z-index: 3;
            left: 35px;
        }

        /* Ajustar padding para inputs con iconos */
        .select2-selection__rendered {
            padding-left: 25px !important;
        }
    </style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Inicializar Select2 en diagnóstico
        $('#diagnosis_id').select2({
            placeholder: '-- Buscar diagnóstico --',
            allowClear: true,
            width: '100%',
            dropdownParent: $('.session-form'),
            minimumResultsForSearch: 3
        });

        // Inicializar Select2 en número de sesión
        const sessionSelect = $('#session_number').select2({
            placeholder: '-- Seleccione el número --',
            minimumResultsForSearch: Infinity,
            width: '100%',
            dropdownParent: $('.session-form')
        });

        // Inicializar Select2 en estado de asistencia
        $('#attendance_status').select2({
            minimumResultsForSearch: Infinity,
            width: '100%',
            dropdownParent: $('.session-form')
        });

        // Manejar cambio en diagnóstico
        $('#diagnosis_id').on('change', function() {
            const selected = $(this).find('option:selected');
            const recommended = selected.data('recommended');
            
            // Limpiar y cargar opciones
            sessionSelect.empty().append('<option value=""></option>');
            
            if (recommended) {
                for (let i = 1; i <= recommended; i++) {
                    sessionSelect.append(new Option(`Sesión ${i}`, i));
                }
            }
            
            // Actualizar Select2
            sessionSelect.trigger('change');
        });
    });
</script>
@endpush

@push('css')
<style>
    /* Añadir estas reglas CSS */
    .select2-container .select2-selection--single {
        height: 48px !important;
        display: flex !important;
        align-items: center;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 45px !important;
        color: #495057 !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100% !important;
        right: 15px !important;
    }
    
    /* Ajustar posición de iconos con Select2 */
    .select2-container ~ .input-icon {
        z-index: 3;
        left: 35px;
        pointer-events: none;
    }
</style>
@endpush