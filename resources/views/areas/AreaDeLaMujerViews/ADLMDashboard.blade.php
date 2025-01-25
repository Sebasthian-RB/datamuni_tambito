@extends('adminlte::page')

@section('title', 'Dashboard - Área de la Mujer')

@section('content_header')
    <!-- Header con la imagen grande -->
    <div class="card mb-4">
        <div class="card-header bg-success p-0 d-flex justify-content-center align-items-center" style="height: 60px;">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="height: 100%; width: auto;">
        </div>
    </div>
    
    <!-- Panel de Control del Área de la Mujer -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="h3 mb-0 text-gray-800">Panel de Control del Área de la Mujer</h1>
                    <p class="text-muted">Sigue los pasos recomendados para gestionar eficientemente los datos del Área de la Mujer.</p>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <img src="{{ asset('Images/AreaDeLaMujerLogo.png') }}" alt="Logo Mujer" class="img-fluid" style="height: 150px; width: auto;">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Alerta de información -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle"></i> Recuerda revisar las actualizaciones recientes y mantener los datos al día.
            </div>
        </div>
    </div>
@endsection

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
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                <h3>
                    Estadísticas de Intervenciones
                    <button class="btn btn-light btn-sm float-right" data-toggle="collapse" data-target="#dashboardStatsIn" aria-expanded="false" aria-controls="dashboardStatsIn">
                        <i class="fas fa-chart-bar"></i> Ver Estadísticas
                    </button>
                </h3>
            </div>
            <div class="collapse" id="dashboardStatsIn">
                <div class="card-body">
                    <div class="row">
                        <!-- Card: Total de Intervenciones -->
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-header bg-warning text-white">
                                    <h5>Total de Intervenciones Registradas</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h4>{{ $totalInterventions }}</h4>
                                </div>
                            </div>
                        </div>
                
                        <!-- Card: Personas Únicas en Intervenciones -->
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-header bg-warning text-white">
                                    <h5>Personas Únicas Participando</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h4>{{ $totalUniquePersonsInInterventions }}</h4>
                                </div>
                            </div>
                        </div>
                
                        <!-- Card: Intervenciones por Estado -->
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-header bg-warning text-white">
                                    <h5>Intervenciones por Estado</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach($interventionStatusStats as $status)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $status->status }}
                                                <span class="badge badge-primary badge-pill">{{ $status->count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="row mt-4">
                        <!-- Card: Últimas Relaciones entre Intervenciones y Personas -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-warning text-white">
                                    <h5>Últimas Intervenciones - Personas</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach($recentPersonInterventions as $relation)
                                            <li class="list-group-item">
                                                <strong>Persona:</strong> 
                                                {{ $relation->given_name }} {{ $relation->paternal_last_name }} {{ $relation->maternal_last_name }}<br>
                                                <strong>Cita:</strong> {{ $relation->appointment }}<br>
                                                <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($relation->appointment_date)->format('d/m/Y H:i') }}<br>
                                                <strong>Estado:</strong> 
                                                <span class="badge badge-{{ $relation->status == 'Completado' ? 'success' : ($relation->status == 'En progreso' ? 'warning' : 'danger') }}">
                                                    {{ $relation->status }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h3>
                Estadísticas de Eventos
                <button class="btn btn-light btn-sm float-right" data-toggle="collapse" data-target="#dashboardStatsEv" aria-expanded="false" aria-controls="dashboardStatsEv">
                    <i class="fas fa-chart-bar"></i> Ver Estadísticas
                </button>
            </h3>
        </div>
        <div class="collapse" id="dashboardStatsEv">
            <div class="card-body">
                <div class="row">
                    <!-- Total de Eventos -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">
                                <h4>Total de Eventos</h4>
                                <p class="h3">{{ $totalEvents }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Eventos Recientes -->
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Eventos Recientes</h5>
                                    <button class="btn btn-sm btn-light" data-toggle="collapse" data-target="#recentEventsTable" aria-expanded="true" aria-controls="recentEventsTable">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div class="collapse show" id="recentEventsTable">
                                    <div class="card-body">
                                        @if ($recentEvents->isEmpty())
                                            <p class="text-center text-muted">No hay eventos recientes registrados.</p>
                                        @else
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered align-middle text-center">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Nombre del Evento</th>
                                                            <th>Lugar</th>
                                                            <th>Fecha de Inicio</th>
                                                            <th>Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($recentEvents as $event)
                                                            <tr>
                                                                <td class="font-weight-bold text-primary">{{ $event->name }}</td>
                                                                <td>{{ $event->place }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}</td>
                                                                <td>
                                                                    @switch($event->status)
                                                                        @case('Pendiente')
                                                                            <span class="badge badge-warning px-3 py-2">{{ $event->status }}</span>
                                                                            @break
                                                                        @case('Finalizado')
                                                                            <span class="badge badge-success px-3 py-2">{{ $event->status }}</span>
                                                                            @break
                                                                        @case('En proceso')
                                                                            <span class="badge badge-info px-3 py-2">{{ $event->status }}</span>
                                                                            @break
                                                                        @case('Cancelado')
                                                                            <span class="badge badge-danger px-3 py-2">{{ $event->status }}</span>
                                                                            @break
                                                                    @endswitch
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                
                    <!-- Gráfico de Estados de Eventos -->
                    <div class="col-lg-9">
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h5>Distribución de Estados por Evento</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="eventStatusChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Datos del gráfico
            const labels = @json($eventStatusStats->pluck('status'));
            const data = @json($eventStatusStats->pluck('count'));
    
            // Configuración del gráfico
            const ctx = document.getElementById('eventStatusChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Cambiar a 'pie' si prefieres un gráfico de pastel
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cantidad de Eventos',
                        data: data,
                        backgroundColor: [
                            '#36A2EB', // Azul para Pendiente
                            '#4BC0C0', // Verde para En proceso
                            '#FF6384', // Rojo para Cancelado
                            '#FFCE56'  // Amarillo para Finalizado
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false, // Ocultar leyenda
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@stop
