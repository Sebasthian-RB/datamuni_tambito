@extends('adminlte::page')

@section('title', 'Dashboard - Área de la Mujer')

@section('content_header')
    <h1>Panel de Control</h1>
    <p class="text-muted">Sigue los pasos recomendados para gestionar eficientemente los datos del Área de la Mujer.</p>
@stop

@section('content')
<div class="container">
    <!-- Gestión de Casos -->
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">
            <h3>Gestión de Casos</h3>
        </div>
        <div class="card-body">
            <p>Gestiona información relacionada con personas, casos de violencia y su relación.</p>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="{{ route('am_people.index') }}" class="btn btn-danger btn-block btn-lg">
                        <i class="fas fa-users"></i> Gestión de Personas
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="{{ route('violences.index') }}" class="btn btn-danger btn-block btn-lg">
                        <i class="fas fa-exclamation-circle"></i> Gestión de Casos
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="{{ route('am_person_violences.index') }}" class="btn btn-danger btn-block btn-lg">
                        <i class="fas fa-user-shield"></i> Personas y Casos
                    </a>
                </div>
            </div>
        </div>
        <!-- Estadísticas del Dashboard -->
        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
                <h3>
                    Estadísticas de Casos
                    <button class="btn btn-light btn-sm float-right" data-toggle="collapse" data-target="#dashboardStats" aria-expanded="false" aria-controls="dashboardStats">
                        <i class="fas fa-chart-bar"></i> Ver Estadísticas
                    </button>
                </h3>
            </div>
            <div class="collapse" id="dashboardStats">
                <div class="card-body">
                    <div class="row">
                        <!-- Card para Total de Personas Únicas Registradas -->
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    <h5>Total de Personas Registradas</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h4>{{ $totalUniquePersons }} personas registradas</h4>
                                </div>
                            </div>
                            <!-- Últimas Violencias Registradas -->
                            <div class="card mt-4">
                                <div class="card-header bg-danger text-white">
                                    <h5>Últimas Violencias Registradas</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach($recentViolences as $violence)
                                            <li class="list-group-item">
                                                <strong>{{ $violence->kind_violence }}</strong> - {{ $violence->description }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
        
                        <!-- Card para el Gráfico -->
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    <h5>Cantidad de Personas por Tipo de Violencia</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <canvas id="violenceChart" width="350" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- Card para Total de Violencias-personas (casos) -->
                            <div class="card mt-3">
                                <div class="card-header bg-danger text-white">
                                    <h5>Total de Casos Registrados</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h4>{{ $totalViolences }} casos registrados</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    

    <!-- Gestión de Intervenciones -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-white">
            <h3>Gestión de Intervenciones</h3>
        </div>
        <div class="card-body">
            <p>Administra intervenciones y la relación entre personas e intervenciones.</p>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="{{ route('interventions.index') }}" class="btn btn-warning btn-block btn-lg">
                        <i class="fas fa-handshake"></i> Gestión de Intervenciones
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="{{ route('am_person_interventions.index') }}" class="btn btn-warning btn-block btn-lg">
                        <i class="fas fa-user-friends"></i> Personas e Intervenciones
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Gestión de Programas y Eventos -->
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3>Gestión de Programas y Eventos</h3>
        </div>
        <div class="card-body">
            <p>Gestiona programas, eventos y la relación entre personas y eventos.</p>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="{{ route('programs.index') }}" class="btn btn-success btn-block btn-lg">
                        <i class="fas fa-project-diagram"></i> Gestión de Programas
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="{{ route('events.index') }}" class="btn btn-success btn-block btn-lg">
                        <i class="fas fa-calendar-alt"></i> Gestión de Eventos
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="{{ route('am_person_events.index') }}" class="btn btn-success btn-block btn-lg">
                        <i class="fas fa-user-clock"></i> Personas y Eventos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Datos para el gráfico
            const labels = @json($violenceStats->pluck('kind_violence'));
            const data = @json($violenceStats->pluck('person_count'));
    
            // Crear gráfico de Pie
            const ctx = document.getElementById('violenceChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'], // Colores personalizados
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });
        });
    </script>
@stop
