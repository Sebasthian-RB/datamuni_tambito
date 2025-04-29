@extends('adminlte::page')

@section('title', 'Dashboard Psicológico')

@section('content_header')
    <div class="diagnostic-banner">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1>Dashboard del Área Psicológica</h1>
            <p class="lead">Métricas y estadísticas clave</p>
        </div>
    </div>
    <a href="{{ route('omdashboard') }}" class="btn btn-outline-light btn-elevate">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
@endsection

@section('content')
    <div class="container-fluid">
        @can('psicologiaOmaped')
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <a href="{{ route('psychological-diagnoses.index') }}"
                        class="btn btn-outline-primary btn-elevate w-100 py-3">
                        <i class="fas fa-brain fa-2x"></i><br>
                        <span class="h5">Ver Diagnósticos</span>
                    </a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="{{ route('psychological-sessions.index') }}"
                        class="btn btn-outline-success btn-elevate w-100 py-3">
                        <i class="fas fa-notes-medical fa-2x"></i><br>
                        <span class="h5">Ver Sesiones</span>
                    </a>
                </div>
            </div>
        @endcan


        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card shadow-lg border-0">
                    <div class="card-header gradient-header">
                        <h5 class="mb-0"><i class="fas fa-user-friends"></i> Personas Derivadas</h5>
                    </div>
                    <div class="card-body text-center py-4">
                        <h2 class="display-4 text-primary">{{ $uniquePeopleCount }}</h2>
                        <p class="text-muted mb-0">Pacientes únicos atendidos</p>
                    </div>
                </div>
            </div>


        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header gradient-header">
                <h5 class="mb-0"><i class="fas fa-filter"></i> Filtros de Fecha</h5>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-calendar-day"></i>
                            </span>
                            <input type="date" name="start_date" class="form-control"
                                value="{{ request('start_date') }}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-calendar-day"></i>
                            </span>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-elevate w-100 py-2">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                    </div>
                </form>
            </div>

        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-lg border-0">
                <div class="card-header gradient-header">
                    <h5 class="mb-0"><i class="fas fa-notes-medical"></i> Sesiones Registradas</h5>
                </div>
                <div class="card-body text-center py-4">
                    <h2 class="display-4 text-success">{{ $totalSessions }}</h2>
                    <p class="text-muted mb-0">Total de intervenciones</p>
                </div>
            </div>
        </div>
        <div class="card shadow-lg border-0 mt-4">
            <div class="card-header gradient-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Sesiones por Fecha</h5>
            </div>
            <div class="card-body">
                <canvas id="sessionsChart" style="height: 400px;"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('css')
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
            padding: 3rem;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .gradient-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
            border-radius: 15px 15px 0 0;
        }

        .btn-elevate {
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(42, 92, 130, 0.2);
            border-radius: 15px;
        }

        .btn-elevate:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(42, 92, 130, 0.3);
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .input-group-text {
            background: var(--primary-color);
            border: none;
        }

        .display-4 {
            font-weight: 600;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('sessionsChart').getContext('2d');
        const sessionsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($sessionsByDate->pluck('date')) !!},
                datasets: [{
                    label: 'Sesiones',
                    data: {!! json_encode($sessionsByDate->pluck('total')) !!},
                    backgroundColor: '#28a745',
                    borderColor: '#1e7e34',
                    borderWidth: 2,
                    borderRadius: 10,
                    hoverBackgroundColor: '#218838'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        grid: {
                            color: '#e9ecef'
                        },
                        ticks: {
                            color: '#6c757d'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6c757d'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#495057',
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
