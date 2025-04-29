@extends('adminlte::page')

@section('title', 'Sesiones Psicológicas')

@section('content_header')
<div class="diagnostic-banner">
    <div class="banner-overlay"></div>
    <div class="banner-content">
        <h1>Sesiones Psicológicas</h1>
        <p class="lead">Gestión integral de seguimiento terapéutico</p>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-lg">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-header gradient-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-filter"></i> Filtros Avanzados</h3>
                <a href="{{ route('psydashboard') }}" class="btn btn-outline-light btn-elevate">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <a href="{{ route('psychological-sessions.create') }}" class="btn btn-success btn-elevate fab-button">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <form method="GET" action="{{ route('psychological-sessions.index') }}" class="mt-4">
                <div class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" name="search" class="form-control form-control-lg" 
                                placeholder="Buscar paciente..." 
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-5">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-info text-white">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            <input type="text" name="date_range" class="form-control form-control-lg daterange" 
                                placeholder="Rango de fechas" 
                                value="{{ request('date_range') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block btn-elevate">
                                <i class="fas fa-search"></i> Filtrar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive rounded-3">
                <table class="table table-hover align-middle">
                    <thead class="gradient-table-header">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Persona</th>
                            <th class="text-center">Sesión</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Asistencia</th>
                            <th>Descripción</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $session)
                            <tr class="hover-scale">
                                <td class="text-center fw-bold text-primary">#{{ $session->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-soft-primary rounded-circle me-3">
                                            <span class="avatar-initial">
                                                {{ substr($session->diagnosis->person->full_name ?? '?', 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $session->diagnosis->person->full_name ?? 'Sin nombre' }}</h6>
                                            <small class="text-muted">
                                                Diagnóstico: {{ Str::limit($session->diagnosis->diagnosis ?? 'No disponible', 40) }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center fw-bold">{{ $session->session_number }}</td>
                                <td class="text-center">
                                    <span class="text-success">
                                        {{ \Carbon\Carbon::parse($session->scheduled_date)->isoFormat('DD MMM YYYY') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @switch($session->attendance_status)
                                        @case('Asistió')
                                            <span class="badge bg-soft-success text-success p-2">✓ Asistió</span>
                                            @break
                                        @case('No asistió')
                                            <span class="badge bg-soft-danger text-danger p-2">✗ No asistió</span>
                                            @break
                                        @case('Justificó')
                                            <span class="badge bg-soft-warning text-warning p-2">⚠ Justificó</span>
                                            @break
                                        @default
                                            <span class="badge bg-soft-secondary text-muted p-2">Sin registro</span>
                                    @endswitch
                                </td>
                                <td>
                                    <div class="diagnosis-preview">
                                        {{ $session->description ? Str::limit($session->description, 50) : '—' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('psychological-sessions.show', $session) }}" 
                                           class="btn btn-sm btn-soft-info btn-icon" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('psychological-sessions.edit', $session) }}" 
                                           class="btn btn-sm btn-soft-warning btn-icon" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('psychological-sessions.destroy', $session) }}" 
                                              method="POST" class="d-inline delete-form">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-soft-danger btn-icon" 
                                                    title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if($sessions->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-comments fa-3x text-muted"></i>
                                        <h4 class="mt-3">No hay sesiones registradas</h4>
                                        <p class="text-muted">Comience creando una nueva sesión</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if($sessions->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $sessions->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    :root {
            --primary-color: #2A5C82;
            --secondary-color: #5DA9E9;
            --accent-color: #FF6B6B;
            --soft-bg: #f8f9fa;
        }

        .diagnostic-banner {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            height: 150px;
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
            padding: 2rem;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .gradient-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 1.5rem;
        }

        .btn-elevate {
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(42, 92, 130, 0.2);
        }

        .btn-elevate:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(42, 92, 130, 0.3);
        }

        .hover-scale tr {
            transition: transform 0.2s ease;
        }

        .hover-scale tr:hover {
            transform: scale(1.02);
            background: var(--soft-bg);
        }

        .avatar-sm {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(93, 169, 233, 0.15) !important;
            border: 2px solid var(--primary-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-right: 1.5rem !important;
            min-width: 48px;
        }

        .avatar-initial {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            font-weight: 600;
            color: var(--primary-color);
            text-transform: uppercase;
        }

        .diagnosis-preview {
            position: relative;
            max-width: 300px;
        }

        .diagnosis-preview::after {
            content: "";
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 30px;
            background: linear-gradient(to right, transparent, white);
        }

        .empty-state {
            opacity: 0.7;
            padding: 2rem;
        }

        .btn-icon {
            padding: 0.375rem;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .btn-icon:hover {
            transform: translateY(-1px);
            border-color: rgba(0, 0, 0, 0.1);
        }

        .btn-outline-info {
            color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-outline-warning {
            color: #ffc107;
            border-color: #ffc107;
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }

        .btn-group .btn {
            border-radius: 8px !important;
            padding: 0.5rem 1rem;
        }

        .btn-group .btn-outline-secondary {
            border-color: #dee2e6;
        }

        .btn-soft-info {
            background-color: rgba(93, 169, 233, 0.1);
            color: var(--secondary-color);
        }

        .btn-soft-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .btn-soft-danger {
            background-color: rgba(255, 107, 107, 0.1);
            color: var(--accent-color);
        }

        .daterangepicker td.active {
            background-color: var(--primary-color) !important;
        }

        .fab-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50% !important;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 6px 20px rgba(42, 92, 130, 0.3);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .fab-button:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 8px 25px rgba(42, 92, 130, 0.4);
        }

        @media (max-width: 768px) {
            .fab-button {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
                margin-right: 1rem !important;
                min-width: 40px;
            }

            .avatar-sm {
                width: 40px;
                height: 40px;
            }

            .avatar-initial {
                font-size: 1.2rem;
            }
        }

    .badge.bg-soft-success {
        background-color: rgba(40, 167, 69, 0.15) !important;
    }

    .badge.bg-soft-danger {
        background-color: rgba(220, 53, 69, 0.15) !important;
    }

    .badge.bg-soft-warning {
        background-color: rgba(255, 193, 7, 0.15) !important;
    }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready(function() {
    // SweetAlert2 para eliminación
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: '¿Confirmar eliminación?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2A5C82',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Date Range Picker
    $('.daterange').daterangepicker({
        autoUpdateInput: false,
        opens: 'left',
        drops: 'auto',
        locale: {
            format: 'DD/MM/YYYY',
            cancelLabel: 'Limpiar',
            applyLabel: 'Aplicar',
            daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            firstDay: 1
        }
    });

    $('.daterange').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

    $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
});
</script>
@endpush