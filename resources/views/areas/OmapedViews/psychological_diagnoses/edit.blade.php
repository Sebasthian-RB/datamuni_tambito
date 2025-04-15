@extends('adminlte::page')

@section('title', 'Editar Diagnóstico')

@section('content_header')
<div class="diagnostic-banner">
    <div class="banner-overlay"></div>
    <div class="banner-content">
        <h1>Editar Diagnóstico</h1>
        <p class="lead">Actualización de información del diagnóstico psicológico</p>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg border-0">
        <div class="card-header gradient-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-edit"></i> Formulario de Edición</h3>
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-elevate">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('psychological-diagnoses.update', $psychologicalDiagnosis) }}" method="POST" class="diagnosis-form">
                @csrf
                @method('PUT')

                <div class="form-group-enhanced">
                    <label class="form-label">Seleccionar Paciente</label>
                    <div class="patient-select-container">
                        <select name="om_person_id" id="om_person_id" class="form-control select2-enhanced" required>
                            <option value="">-- Buscar paciente --</option>
                            @foreach($people as $person)
                                <option value="{{ $person->id }}" 
                                    {{ $psychologicalDiagnosis->om_person_id == $person->id ? 'selected' : '' }}
                                    data-avatar="{{ substr($person->full_name, 0, 1) }}">
                                    {{ $person->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group-enhanced">
                    <label class="form-label">Evaluación Psicológica</label>
                    <div class="diagnosis-input-container">
                        <textarea name="diagnosis" id="diagnosis" class="form-control" rows="8"
                            placeholder="Ingrese el diagnóstico detallado">{{ old('diagnosis', $psychologicalDiagnosis->diagnosis) }}</textarea>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group-enhanced">
                            <label class="form-label">Sesiones Recomendadas</label>
                            <div class="input-container">
                                <i class="fas fa-clock input-icon"></i>
                                <input type="number" name="recommended_sessions" id="recommended_sessions" 
                                    class="form-control" min="1" 
                                    value="{{ old('recommended_sessions', $psychologicalDiagnosis->recommended_sessions) }}" 
                                    placeholder="Ej: 12">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group-enhanced">
                            <label class="form-label">Fecha del Diagnóstico</label>
                            <div class="input-container">
                                <i class="fas fa-calendar-day input-icon"></i>
                                <input type="date" name="diagnosis_date" id="diagnosis_date" 
                                    class="form-control" 
                                    value="{{ old('diagnosis_date', $psychologicalDiagnosis->diagnosis_date) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-elevate btn-lg">
                        <i class="fas fa-save"></i> Actualizar Diagnóstico
                    </button>
                    <a href="{{ route('psychological-diagnoses.index') }}" class="btn btn-outline-secondary btn-elevate btn-lg">
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
    /* Select2 Mejorado */
    
    .select2-enhanced .select2-selection--single {
        height: auto !important;
        padding: 0.2rem 0.5rem;
        border: 2px solid #dee2e6 !important;
        border-radius: 12px !important;
        background: white;
        min-height: 56px; /* Altura mínima aumentada */
        display: flex;
        align-items: center;
    }

    .select2-enhanced .select2-selection__rendered {
        padding: 0 !important;
        font-size: 1rem;
        line-height: 1.5;
        color: var(--primary-color);
    }

    .select2-enhanced .select2-selection__placeholder {
        color: #6c757d !important;
    }

    .select2-enhanced .select2-selection__arrow {
        height: 100% !important;
        right: 15px !important;
        transform: translateY(-50%);
        top: 50%;
    }

    .select2-results__option {
        padding: 1rem 1.5rem !important;
        font-size: 1rem;
        line-height: 1.4;
        transition: all 0.2s ease;
    }

    .select2-results__option--highlighted {
        background-color: var(--primary-color) !important;
        color: white !important;
    }

    .select2-results__options {
        border-radius: 12px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
        margin-top: 8px !important;
        border: none !important;
    }

    .select2-dropdown {
        border: none !important;
    }
</style>
<style>
    :root {
        --primary-color: #2A5C82;
        --secondary-color: #5DA9E9;
        --accent-color: #FF6B6B;
        --soft-bg: #f8f9fa;
    }

    /* Estilos del Banner */
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
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .banner-content h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .banner-content .lead {
        font-size: 1.4rem;
    }

    /* Formulario Mejorado */
    .diagnosis-form {
        padding: 2rem 1.5rem;
    }

    .form-group-enhanced {
        margin-bottom: 2rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 1rem;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }

    .form-control {
        border: 2px solid #dee2e6;
        border-radius: 12px;
        padding: 0.2rem 0.5rem;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(42, 92, 130, 0.15);
    }

    /* Campos con Iconos */
    .input-container {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary-color);
        z-index: 2;
    }

    .input-container .form-control {
        padding-left: 50px;
    }

    /* Textarea Mejorado */
    textarea.form-control {
        min-height: 250px;
        resize: vertical;
        line-height: 1.6;
        padding: 1.5rem !important;
        background: rgba(93, 169, 233, 0.05);
        border-color: rgba(93, 169, 233, 0.3) !important;
    }

    /* Botones de Acción */
    .form-actions {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid rgba(0, 0, 0, 0.05);
        text-align: right;
    }

    .btn-elevate {
        padding: 1rem 2rem;
        font-size: 1.1rem;
        border-radius: 12px;
        margin-left: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-elevate:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .banner-content {
            padding: 2rem;
        }

        .banner-content h1 {
            font-size: 2rem;
        }

        .form-actions {
            text-align: center;
        }

        .btn-elevate {
            width: 100%;
            margin: 0.5rem 0;
        }

        .input-icon {
            left: 15px;
        }

        .input-container .form-control {
            padding-left: 45px;
        }
    }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#om_person_id').select2({
            placeholder: '-- Buscar paciente --',
            allowClear: true,
            width: '100%',
            dropdownParent: $('.diagnosis-form'),
            minimumResultsForSearch: 3 // Muestra la búsqueda solo si hay 3+ opciones
        }).addClass('select2-enhanced');

        // Ajustar altura del dropdown
        $('.select2-results__options').css({
            'max-height': '300px',
            'overflow-y': 'auto'
        });
    });
</script>
@endpush