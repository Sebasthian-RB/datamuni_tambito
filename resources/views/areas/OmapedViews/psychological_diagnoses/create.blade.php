@extends('adminlte::page')

@section('title', 'Nuevo Diagnóstico')

@section('content_header')
<div class="diagnostic-banner">
    <div class="banner-overlay"></div>
    <div class="banner-content">
        <h1>Nuevo Diagnóstico</h1>
        <p class="lead">Registro de evaluaciones psicológicas</p>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg border-0">
        <div class="card-header gradient-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-file-medical"></i> Formulario de Registro</h3>
                <a href="{{ route('psychological-diagnoses.index') }}" class="btn btn-outline-light btn-elevate">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('psychological-diagnoses.store') }}" method="POST" class="diagnosis-form">
                @csrf

                <div class="form-group-enhanced">
                    <label class="form-label">Seleccionar Paciente</label>
                    <div class="patient-select-container">
                        <select name="om_person_id" id="om_person_id" class="form-control select2-enhanced" required>
                            <option value="">-- Buscar paciente --</option>
                            @foreach($people as $person)
                                <option value="{{ $person->id }}">
                                    {{ $person->given_name }} {{ $person->paternal_last_name }} {{ $person->maternal_last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group-enhanced">
                    <label class="form-label">Evaluación Psicológica</label>
                    <div class="diagnosis-input-container">
                        <textarea name="diagnosis" id="diagnosis" class="form-control" rows="6"
                            placeholder="Describa el diagnóstico..."></textarea>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group-enhanced">
                            <label class="form-label">Sesiones Recomendadas</label>
                            <div class="input-container">
                                <i class="fas fa-clock input-icon"></i>
                                <input type="number" name="recommended_sessions" id="recommended_sessions" 
                                    class="form-control" min="1" value="1" required
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
                                    value="{{ now()->toDateString() }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success btn-elevate btn-lg">
                        <i class="fas fa-save"></i> Guardar Diagnóstico
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
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* ========== VARIABLES GLOBALES ========== */
    :root {
        --primary-color: #2A5C82;       /* Azul principal */
        --secondary-color: #5DA9E9;     /* Azul secundario */
        --accent-color: #FF6B6B;        /* Color de acento */
        --soft-bg: #f8f9fa;             /* Fondo suave */
        --success-color: #28a745;       /* Verde éxito */
        --warning-color: #ffc107;       /* Amarillo advertencia */
        --danger-color: #dc3545;        /* Rojo peligro */
    }

    /* ========== ESTILOS GENERALES ========== */
    body {
        background-color: #f8fafc;
    }

    /* ========== BANNER PRINCIPAL ========== */
    .diagnostic-banner {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        height: 250px;
        border-radius: 0 0 30px 30px;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
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
        font-weight: 600;
    }

    .banner-content .lead {
        font-size: 1.4rem;
        opacity: 0.9;
    }

    /* ========== TARJETAS Y ENCABEZADOS ========== */
    .card.shadow-lg {
        border-radius: 15px;
        overflow: hidden;
    }

    .gradient-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1.5rem;
    }

    .gradient-header h3 {
        margin-bottom: 0;
        font-weight: 600;
    }

    /* ========== COMPONENTES DE FORMULARIO ========== */
    .form-control {
        border: 2px solid #dee2e6;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(42, 92, 130, 0.15);
    }

    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }

    /* ========== BOTONES Y EFECTOS ========== */
    .btn-elevate {
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
    }

    .btn-elevate:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .fab-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 6px 20px rgba(42, 92, 130, 0.3);
        z-index: 1000;
        transition: all 0.3s ease;
    }

    /* ========== TABLAS Y ELEMENTOS TABULARES ========== */
    .table-hover tbody tr {
        transition: all 0.2s ease;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(93, 169, 233, 0.05);
        transform: scale(1.01);
    }

    .gradient-table-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
    }

    /* ========== AVATARES Y ELEMENTOS VISUALES ========== */
    .avatar-sm {
        width: 48px;
        height: 48px;
        border: 2px solid var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(93, 169, 233, 0.15);
        font-weight: 600;
        color: var(--primary-color);
    }

    .avatar-initial {
        font-size: 1.2rem;
        text-transform: uppercase;
    }

    /* ========== SELECT2 PERSONALIZADO ========== */
    .select2-enhanced .select2-selection--single {
        border: 2px solid #dee2e6 !important;
        border-radius: 12px !important;
        height: auto !important;
        padding: 1rem 1.5rem;
    }

    .select2-enhanced .select2-selection__arrow {
        height: 100% !important;
        right: 15px !important;
    }

    /* ========== PAGINACIÓN ========== */
    .pagination .page-link {
        border-radius: 12px !important;
        margin: 0 3px;
        border: 1px solid var(--primary-color);
    }

    /* ========== MENSAJES DE ALERTA ========== */
    .alert.shadow-lg {
        border-radius: 12px;
        border: none;
    }

    /* ========== EFECTOS ESPECIALES ========== */
    .hover-scale {
        transition: transform 0.2s ease;
    }

    .hover-scale:hover {
        transform: scale(1.02);
    }

    /* ========== RESPONSIVE DESIGN ========== */
    @media (max-width: 768px) {
        .banner-content {
            padding: 2rem 1rem;
        }

        .banner-content h1 {
            font-size: 2rem;
        }

        .fab-button {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
            bottom: 20px;
            right: 20px;
        }

        .form-control {
            padding: 0.8rem 1rem;
        }
    }

    /* ========== UTILIDADES ========== */
    .bg-soft-primary {
        background-color: rgba(93, 169, 233, 0.15) !important;
    }

    .text-primary {
        color: var(--primary-color) !important;
    }

    .border-primary {
        border-color: var(--primary-color) !important;
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
            minimumResultsForSearch: 3
        }).addClass('select2-enhanced');
    });
</script>
@endpush