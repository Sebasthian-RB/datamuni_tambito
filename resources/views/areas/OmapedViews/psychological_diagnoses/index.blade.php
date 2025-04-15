@extends('adminlte::page')

@section('title', 'Diagnósticos Psicológicos')

@section('content_header')
    <h1>Listado de Diagnósticos Psicológicos</h1>
@endsection

@section('content_header')
    <div class="diagnostic-banner">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1>Diagnósticos Psicológicos</h1>
            <p class="lead">Gestión integral de evaluaciones psicológicas</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        @if (session('success'))
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
                    <a href="{{ route('psychological-diagnoses.create') }}" class="btn btn-success btn-elevate fab-button">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <form method="GET" action="{{ route('psychological-diagnoses.index') }}" class="mt-4">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" name="search" class="form-control form-control-lg"
                                    placeholder="Buscar paciente..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-info text-white">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                <input type="text" name="date_range" class="form-control form-control-lg daterange"
                                    placeholder="Seleccionar rango de fechas" value="{{ request('date_range') }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg btn-block btn-elevate">
                                    <i class="fas fa-search"></i> Buscar
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
                                <th class="text-center">ID</th>
                                <th>Paciente</th>
                                <th>Evaluación</th>
                                <th class="text-center">Sesiones</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($diagnoses as $diagnostic)
                                <tr class="hover-scale">
                                    <td class="text-center fw-bold text-primary">#{{ $diagnostic->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-soft-primary rounded-circle me-4">
                                                <span
                                                    class="avatar-initial">{{ substr($diagnostic->person->full_name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $diagnostic->person->full_name }}</h6>
                                                <small class="text-muted">Última actualización:
                                                    {{ $diagnostic->updated_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="diagnosis-preview">
                                            {{ Str::limit($diagnostic->diagnosis, 50) }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-soft-primary text-primary p-2 fs-6">
                                            {{ $diagnostic->recommended_sessions }} Sesiones
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-success fw-bold">
                                            {{ \Carbon\Carbon::parse($diagnostic->diagnosis_date)->isoFormat('DD MMM YYYY') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('psychological-diagnoses.show', $diagnostic) }}"
                                                class="btn btn-sm btn-soft-info btn-icon" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('psychological-diagnoses.edit', $diagnostic) }}"
                                                class="btn btn-sm btn-soft-warning btn-icon" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('psychological-diagnoses.destroy', $diagnostic) }}"
                                                method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-soft-danger btn-icon"
                                                    title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-clipboard-list fa-3x text-muted"></i>
                                            <h4 class="mt-3">No se encontraron diagnósticos</h4>
                                            <p class="text-muted">Comience creando un nuevo diagnóstico</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($diagnoses->hasPages())
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $diagnoses->appends(request()->query())->links('pagination::bootstrap-5') }}
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
            height: 200px;
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
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('.daterange').daterangepicker({
                autoUpdateInput: false,
                opens: 'left',
                drops: 'auto',
                locale: {
                    format: 'DD/MM/YYYY',
                    applyLabel: 'Aplicar',
                    cancelLabel: 'Limpiar',
                    customRangeLabel: 'Personalizado',
                    daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                    firstDay: 1
                }
            });

            $('.daterange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                    'DD/MM/YYYY'));
            });

            $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configuración general de SweetAlert
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-elevate btn-danger',
                cancelButton: 'btn btn-elevate btn-secondary'
            },
            buttonsStyling: false
        });

        // Manejar todos los formularios de eliminación
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                swalWithBootstrapButtons.fire({
                    title: '¿Confirmar eliminación?',
                    text: "¡Esta acción no se puede deshacer!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true,
                    backdrop: `
                        rgba(42, 92, 130, 0.1)
                        url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%232A5C82' fill-opacity='0.1'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E")
                    `
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush