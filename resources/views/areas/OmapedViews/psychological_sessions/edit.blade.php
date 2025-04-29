@extends('adminlte::page')

@section('title', 'Editar Sesión Psicológica')

@section('content_header')
<div class="diagnostic-banner">
    <div class="banner-overlay"></div>
    <div class="banner-content">
        <h1>Editar Sesión Psicológica</h1>
        <p class="lead">Actualización de información de seguimiento terapéutico</p>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg border-0">
        <div class="card-header gradient-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-edit"></i> Formulario de Edición</h3>
                <a href="{{ route('psychological-sessions.index') }}" class="btn btn-outline-light btn-elevate">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('psychological-sessions.update', $psychologicalSession->id) }}" method="POST" class="diagnosis-form">
                @csrf
                @method('PUT')

                <div class="form-group-enhanced">
                    <label class="form-label">Diagnóstico Relacionado</label>
                    <select name="diagnosis_id" id="diagnosis_id" class="form-control select2-enhanced" required>
                        <option value="">-- Seleccione un diagnóstico --</option>
                        @foreach ($diagnoses as $diagnosis)
                            <option value="{{ $diagnosis->id }}"
                                data-recommended="{{ $diagnosis->recommended_sessions }}"
                                {{ $psychologicalSession->diagnosis_id == $diagnosis->id ? 'selected' : '' }}>
                                {{ $diagnosis->person->full_name }}
                                @if ($diagnosis->diagnosis)
                                    || {{ Str::limit($diagnosis->diagnosis, 50) }} 
                                @endif
                                || {{ \Carbon\Carbon::parse($diagnosis->diagnosis_date)->isoFormat('DD/MM/YYYY') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group-enhanced">
                            <label class="form-label">Número de Sesión</label>
                            <div class="input-container">
                                <i class="fas fa-list-ol input-icon"></i>
                                <select name="session_number" id="session_number" class="form-control" required>
                                    <option value="">-- Seleccione sesión --</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group-enhanced">
                            <label class="form-label">Fecha Programada</label>
                            <div class="input-container">
                                <i class="fas fa-calendar-day input-icon"></i>
                                <input type="date" name="scheduled_date" id="scheduled_date" 
                                    class="form-control" 
                                    value="{{ $psychologicalSession->scheduled_date }}">
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
                                    <option value="Asistió" {{ $psychologicalSession->attendance_status == 'Asistió' ? 'selected' : '' }}>✓ Asistió</option>
                                    <option value="No asistió" {{ $psychologicalSession->attendance_status == 'No asistió' ? 'selected' : '' }}>✗ No asistió</option>
                                    <option value="Justificó" {{ $psychologicalSession->attendance_status == 'Justificó' ? 'selected' : '' }}>⚠ Justificó</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group-enhanced">
                    <label class="form-label">Descripción de la Sesión</label>
                    <div class="input-container">
                        <textarea name="description" id="description" class="form-control" 
                            rows="5" placeholder="Detalles de la sesión...">{{ $psychologicalSession->description }}</textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-elevate btn-lg">
                        <i class="fas fa-save"></i> Actualizar Sesión
                    </button>
                    <a href="{{ route('psychological-sessions.index') }}" class="btn btn-outline-secondary btn-elevate btn-lg">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .select2-enhanced {
        border: 2px solid #dee2e6;
        border-radius: 12px;
        padding: 0.8rem 1.2rem;
        width: 100%;
        transition: all 0.3s ease;
    }

    .select2-enhanced:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(42, 92, 130, 0.15);
    }

    textarea.form-control {
        min-height: 150px;
        resize: vertical;
        background: rgba(93, 169, 233, 0.05);
        border: 2px solid rgba(93, 169, 233, 0.3);
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary-color);
        z-index: 2;
    }

    .input-container {
        position: relative;
    }

    .input-container .form-control {
        padding-left: 45px;
    }

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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const diagnosisSelect = document.getElementById('diagnosis_id');
    const sessionSelect = document.getElementById('session_number');
    const initialSessionNumber = {{ $psychologicalSession->session_number }};

    function renderSessions(recommended, selectedNumber = null) {
        sessionSelect.innerHTML = '<option value="">-- Seleccione el número de sesión --</option>';
        if (recommended) {
            const total = parseInt(recommended);
            for (let i = 1; i <= total; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                if (selectedNumber && i === selectedNumber) {
                    option.selected = true;
                }
                sessionSelect.appendChild(option);
            }
        }
    }

    // Carga inicial
    const selectedDiagnosis = diagnosisSelect.options[diagnosisSelect.selectedIndex];
    const recommended = selectedDiagnosis.getAttribute('data-recommended');
    renderSessions(recommended, initialSessionNumber);

    // Evento de cambio
    diagnosisSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const recommended = selectedOption.getAttribute('data-recommended');
        renderSessions(recommended);
    });
});
</script>
@endpush