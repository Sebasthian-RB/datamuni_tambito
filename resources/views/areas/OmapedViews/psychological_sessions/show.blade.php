@extends('adminlte::page')

@section('title', 'Detalle de la Sesión Psicológica')

@section('content_header')
    <div class="diagnostic-banner">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1>Detalle de la Sesión Psicológica</h1>
            <p class="lead">Información completa del seguimiento terapéutico</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow-lg border-0">
            <div class="card-header gradient-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-file-medical"></i> Detalles de la Sesión</h3>
                    <a href="{{ route('psychological-sessions.index') }}" class="btn btn-outline-light btn-elevate">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row diagnostic-details">
                    <div class="col-md-8">
                        {{-- Sección Paciente --}}
                        <div class="detail-item-patient mb-5">
                            <div class="avatar-lg bg-soft-primary rounded-circle me-5">
                                <span class="avatar-initial-lg">
                                    {{ substr($psychologicalSession->diagnosis->person->full_name, 0, 1) }}
                                </span>
                            </div>
                            <div class="patient-info">
                                <h3 class="text-primary mb-2">{{ $psychologicalSession->diagnosis->person->full_name }}</h3>
                                <span class="badge bg-soft-primary text-primary fs-6">Paciente</span>
                            </div>
                        </div>

                        {{-- Descripción de la Sesión --}}
                        <div class="detail-card diagnosis-box mt-5">
                            <div class="detail-header">
                                <i class="fas fa-stethoscope me-2"></i> Descripción de la Sesión
                            </div>
                            <div class="detail-content">
                                {{ $psychologicalSession->description ?? 'Sin descripción' }}
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar Informativa --}}
                    <div class="col-md-4">
                        <div class="info-card">
                            {{-- Diagnóstico Relacionado --}}
                            <div class="info-item">
                                <div class="info-icon bg-soft-info">
                                    <i class="fas fa-file-medical fa-lg text-info"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Diagnóstico</span>
                                    <span class="info-value fs-5">
                                        {{ \Carbon\Carbon::parse($psychologicalSession->diagnosis->diagnosis_date)->isoFormat('DD MMM YYYY') }}
                                    </span>
                                </div>
                            </div>

                            {{-- Detalles de Sesión --}}
                            <div class="info-item">
                                <div class="info-icon bg-soft-primary">
                                    <i class="fas fa-list-ol fa-lg text-primary"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Número de Sesión</span>
                                    <span class="info-value fs-5 badge bg-soft-primary text-primary">
                                        {{ $psychologicalSession->session_number }}
                                    </span>
                                </div>
                            </div>

                            {{-- Fecha Programada --}}
                            <div class="info-item">
                                <div class="info-icon bg-soft-success">
                                    <i class="fas fa-calendar-day fa-lg text-success"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Fecha Programada</span>
                                    <span class="info-value fs-5">
                                        {{ \Carbon\Carbon::parse($psychologicalSession->scheduled_date)->isoFormat('DD MMM YYYY') }}
                                    </span>
                                </div>
                            </div>

                            {{-- Estado de Asistencia --}}
                            <div class="info-item">
                                <div
                                    class="info-icon bg-soft-{{ $psychologicalSession->attendance_status == 'Asistió'
                                        ? 'success'
                                        : ($psychologicalSession->attendance_status == 'No asistió'
                                            ? 'danger'
                                            : 'warning') }}">
                                    <i
                                        class="fas fa-clipboard-check fa-lg text-{{ $psychologicalSession->attendance_status == 'Asistió'
                                            ? 'success'
                                            : ($psychologicalSession->attendance_status == 'No asistió'
                                                ? 'danger'
                                                : 'warning') }}"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Estado de Asistencia</span>
                                    <span class="info-value fs-5">
                                        {{ $psychologicalSession->attendance_status ?? 'Sin registro' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        /* Añadir estilos específicos si es necesario */
        .bg-soft-danger {
            background-color: rgba(220, 53, 69, 0.15) !important;
        }

        .text-danger {
            color: #dc3545 !important;
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

        /* Sección Paciente Mejorada */
        .detail-item-patient {
            display: flex;
            align-items: center;
            padding: 2rem;
            background: rgba(245, 247, 250, 0.5);
            border-radius: 15px;
            margin-bottom: 2rem;
        }

        .avatar-lg {
            width: 80px;
            height: 80px;
            border: 3px solid var(--primary-color);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .avatar-initial-lg {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            line-height: 2;
            padding-left: 25px;
        }

        .patient-info {
            margin-left: 2rem;
        }

        .patient-info h3 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        /* Cuadro de Diagnóstico */
        .diagnosis-box {
            border: 2px solid var(--primary-color);
            border-radius: 15px;
            overflow: hidden;
            background: white;
        }

        .detail-header {
            background: var(--primary-color);
            color: white;
            padding: 1.5rem;
            font-size: 1.4rem;
            font-weight: 600;
        }

        .detail-content {
            padding: 2rem;
            font-size: 1.1rem;
            line-height: 1.8;
            background: rgba(93, 169, 233, 0.05);
            min-height: 200px;
            white-space: pre-wrap;
        }

        /* Sidebar Informativa */
        .info-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: rgba(245, 247, 250, 0.5);
        }

        .info-item:hover {
            transform: translateX(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            flex-shrink: 0;
        }

        .info-content {
            flex-grow: 1;
        }

        .info-label {
            display: block;
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 0.3rem;
        }

        .info-value {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        /* Botones y Footer */
        .card-footer {
            border-top: 2px solid rgba(255, 255, 255, 0.2);
            padding: 1.5rem;
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

        @media (max-width: 768px) {
            .detail-item-patient {
                flex-direction: column;
                text-align: center;
            }

            .avatar-lg {
                margin-bottom: 1.5rem;
                margin-right: 0;
            }

            .patient-info {
                margin-left: 0;
            }

            .info-item {
                flex-direction: column;
                text-align: center;
            }

            .info-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }
    </style>
@endpush
