@extends('adminlte::page')

@section('title', 'Dashboard - Área de la Mujer')

@section('content_header')
    <!-- Header con la imagen grande -->
    <div class="card mb-4">
        <div class="card-header p-0 d-flex justify-content-center align-items-center"
            style="background-color: #f67280; height: 60px;">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
                style="height: 100%; width: auto;">
        </div>
    </div>

    <!-- Panel de Control del Área de la Mujer -->
    <div class="d-flex align-items-center justify-content-between" style="height: 50vh; padding: 0;">

        <!-- Contenedor de Texto -->
        <div
            style="flex: 1; text-align: center; color: #926756; z-index: 1; padding: 40px; display: flex; justify-content: center; align-items: center; height: 100%; background: #f8b195;">
            <h1 style="font-family: 'Raleway', serif; font-size: 3rem; font-weight: 300; margin: 0; letter-spacing: 1px;">
                PANEL DE CONTROL DEL ÁREA DE LA MUJER
            </h1>
        </div>

        <!-- Contenedor Multimedia (imagen) -->
        <div
            style="flex: 1; height: 100%; overflow: hidden; position: relative; display: flex; justify-content: center; align-items: center;">
            <img src="{{ asset('Images/AreaDeLaMujerLogo.png') }}" alt="Logo Mujer"
                style="max-width: 90%; max-height: 90%; object-fit: contain;">
        </div>
    </div>
@endsection

@section('content')

    <!-- Gestión de Pestañas -->

    <div class="card">
        <!-- Cabecera con nuevo color de fondo -->
        <div class="card-header" style="background-color: #355c7d;">
            <!-- Pestañas -->
            <ul class="nav nav-tabs" id="tabMenu" role="tablist" style="border-bottom: 2px solid #f8b195;">
                <li class="nav-item">
                    <!-- Pestaña activa con texto claro -->
                    <a class="nav-link active" id="casos-tab" data-toggle="tab" href="#casos" role="tab"
                        aria-controls="casos" aria-selected="true" style="color: white; font-weight: bold;">
                        Gestión de Casos
                    </a>
                </li>
                <li class="nav-item">
                    <!-- Pestaña inactiva -->
                    <a class="nav-link" id="intervenciones-tab" data-toggle="tab" href="#intervenciones" role="tab"
                        aria-controls="intervenciones" aria-selected="false" style="color: white; font-weight: bold;">
                        Gestión de Intervenciones
                    </a>
                </li>
                <li class="nav-item">
                    <!-- Pestaña inactiva -->
                    <a class="nav-link" id="eventos-tab" data-toggle="tab" href="#eventos" role="tab"
                        aria-controls="eventos" aria-selected="false" style="color: white; font-weight: bold;">
                        Gestión de Eventos
                    </a>
                </li>
            </ul>
        </div>
        <!-- Contenido de las pestañas -->
        <div class="card-body" style="background-color: #ffffff; color: #000000; font-family: 'Playfair Display', serif;">
            <div class="tab-content" id="tabContent">
                <!-- Gestión de Casos -->
                <div class="tab-pane fade show active" id="casos" role="tabpanel" aria-labelledby="casos-tab"
                    style="background-color: #ffe5d9; padding: 20px; border-radius: 12px; font-family: 'Poppins', sans-serif; color: #6b4226;">
                    <h2 style="font-family: 'Playfair Display', serif; color: #b23a48; font-weight: bold;">Gestión de Casos
                    </h2>
                    <p style="color: #6b4226;">Gestiona información relacionada con personas, casos de violencia y su
                        relación.</p>

                    <!-- Botones de Gestión -->
                    <div class="row g-3 text-center">
                        <!-- Gestión de Personas -->
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('am_people.index') }}" class="btn btn-lg btn-gradient w-100 shadow-sm"
                                style="background: linear-gradient(to right, #ff6f61, #de6262); color: #fff; font-weight: bold; border-radius: 8px;">
                                <i class="fas fa-users"></i> Gestión de Personas
                            </a>
                        </div>
                        <!-- Gestión de Casos -->
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('violences.index') }}" class="btn btn-lg btn-gradient w-100 shadow-sm"
                                style="background: linear-gradient(to right, #f76c5e, #d8474d); color: #fff; font-weight: bold; border-radius: 8px;">
                                <i class="fas fa-exclamation-circle"></i> Gestión de Casos
                            </a>
                        </div>
                        <!-- Personas y Casos -->
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('am_person_violences.index') }}"
                                class="btn btn-lg btn-gradient w-100 shadow-sm"
                                style="background: linear-gradient(to right, #f27a70, #d94c50); color: #fff; font-weight: bold; border-radius: 8px;">
                                <i class="fas fa-user-shield"></i> Personas y Casos
                            </a>
                        </div>
                    </div>

                    <!-- Estadísticas de Casos -->
                    <div class="card mt-4 shadow-sm">
                        <div class="card-header text-white"
                            style="background: linear-gradient(to right, #b23a48, #8a2a37); border-radius: 12px 12px 0 0;">
                            <h3 class="mb-0 d-flex justify-content-between align-items-center">
                                Estadísticas de Casos
                                <button class="btn btn-light btn-sm float-right custom-btn" data-toggle="collapse"
        data-target="#dashboardStats" aria-expanded="false" aria-controls="dashboardStats">
    <i class="fas fa-chart-bar"></i> Ver Estadísticas
</button>
                            </h3>
                        </div>
                        <div class="collapse" id="dashboardStats">
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Total de Personas Registradas -->
                                    <div class="col-lg-6">
                                        <div class="card shadow-sm">
                                            <div class="card-header text-white"
                                                style="background: linear-gradient(to right, #de6262, #ff6f61);">
                                                <h5>Total de Personas Registradas</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <h4 style="color: #6b4226;">{{ $totalUniquePersons }} personas registradas
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Gráfico: Cantidad de Personas por Tipo de Violencia -->
                                    <div class="col-lg-6">
                                        <div class="card shadow-sm">
                                            <div class="card-header text-white"
                                                style="background: linear-gradient(to right, #d8474d, #f76c5e);">
                                                <h5>Cantidad de Personas por Tipo de Violencia</h5>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="violenceChart" width="350" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mt-3">
                                    <!-- Últimas Violencias Registradas -->
                                    <div class="col-lg-6">
                                        <div class="card shadow-sm">
                                            <div class="card-header text-white"
                                                style="background: linear-gradient(to right, #b23a48, #8a2a37);">
                                                <h5>Últimas Violencias Registradas</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group">
                                                    @foreach ($recentViolences as $violence)
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center">
                                                            <span><strong>{{ $violence->kind_violence }}</strong> -
                                                                {{ $violence->description }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total de Casos Registrados -->
                                    <div class="col-lg-6">
                                        <div class="card shadow-sm">
                                            <div class="card-header text-white"
                                                style="background: linear-gradient(to right, #d94c50, #f27a70);">
                                                <h5>Total de Casos Registrados</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <h4 style="color: #6b4226;">{{ $totalViolences }} casos registrados</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Gestión de Intervenciones -->
                <div class="tab-pane fade" id="intervenciones" role="tabpanel" aria-labelledby="intervenciones-tab"
                    style="background-color: #ffe5d9; padding: 20px; border-radius: 12px; font-family: 'Poppins', sans-serif; color: #6b4226;">
                    <h2 style="font-family: 'Playfair Display', serif; color: #b23a48; font-weight: bold;">Gestión de
                        Intervenciones</h2>
                    <p style="color: #6b4226;">Aquí puedes gestionar las intervenciones.</p>

                    <!-- Tarjeta: Gestión de Intervenciones -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header"
                            style="background: linear-gradient(to right, #b23a48, #8a2a37); color: white;">
                            <h3>Gestión de Intervenciones</h3>
                        </div>
                        <div class="card-body">
                            <p style="color: #6b4226;">Administra intervenciones y la relación entre personas e
                                intervenciones.</p>
                            <div class="row text-center">
                                <!-- Botón: Gestión de Intervenciones -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <a href="{{ route('interventions.index') }}" class="btn btn-lg w-100 shadow-sm"
                                        style="background: linear-gradient(to right, #f76c5e, #d8474d); color: white; font-weight: bold; border-radius: 8px;">
                                        <i class="fas fa-handshake"></i> Gestión de Intervenciones
                                    </a>
                                </div>
                                <!-- Botón: Personas e Intervenciones -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <a href="{{ route('am_person_interventions.index') }}"
                                        class="btn btn-lg w-100 shadow-sm"
                                        style="background: linear-gradient(to right, #f27a70, #d94c50); color: white; font-weight: bold; border-radius: 8px;">
                                        <i class="fas fa-user-friends"></i> Personas e Intervenciones
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta: Estadísticas de Intervenciones -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header"
                            style="background: linear-gradient(to right, #b23a48, #8a2a37); color: white;">
                            <h3>
                                Estadísticas de Intervenciones
                                <button class="btn btn-light btn-sm float-right custom-btn" data-toggle="collapse"
        data-target="#dashboardStats" aria-expanded="false" aria-controls="dashboardStats">
    <i class="fas fa-chart-bar"></i> Ver Estadísticas
</button>
                            </h3>
                        </div>
                        <div class="collapse" id="dashboardStatsIn">
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Card: Total de Intervenciones -->
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow-sm">
                                            <div class="card-header"
                                                style="background: linear-gradient(to right, #de6262, #ff6f61); color: white;">
                                                <h5>Total de Intervenciones Registradas</h5>
                                            </div>
                                            <div class="card-body text-center" style="color: #6b4226;">
                                                <h4>{{ $totalInterventions }}</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card: Personas Únicas en Intervenciones -->
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow-sm">
                                            <div class="card-header"
                                                style="background: linear-gradient(to right, #f76c5e, #d8474d); color: white;">
                                                <h5>Personas Únicas Participando</h5>
                                            </div>
                                            <div class="card-body text-center" style="color: #6b4226;">
                                                <h4>{{ $totalUniquePersonsInInterventions }}</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card: Intervenciones por Estado -->
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow-sm">
                                            <div class="card-header"
                                                style="background: linear-gradient(to right, #d94c50, #f27a70); color: white;">
                                                <h5>Intervenciones por Estado</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group">
                                                    @foreach ($interventionStatusStats as $status)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                                            style="color: #6b4226;">
                                                            {{ $status->status }}
                                                            <span class="badge"
                                                                style="background-color: #f67280; color: white;">{{ $status->count }}</span>
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
                                        <div class="card shadow-sm">
                                            <div class="card-header"
                                                style="background: linear-gradient(to right, #b23a48, #8a2a37); color: white;">
                                                <h5>Últimas Intervenciones - Personas</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group">
                                                    @foreach ($recentPersonInterventions as $relation)
                                                        <li class="list-group-item" style="color: #6b4226;">
                                                            <strong>Persona:</strong>
                                                            {{ $relation->given_name }}
                                                            {{ $relation->paternal_last_name }}
                                                            {{ $relation->maternal_last_name }}<br>
                                                            <strong>Cita:</strong> {{ $relation->appointment }}<br>
                                                            <strong>Fecha:</strong>
                                                            {{ \Carbon\Carbon::parse($relation->appointment_date)->format('d/m/Y H:i') }}<br>
                                                            <strong>Estado:</strong>
                                                            <span
                                                                class="badge badge-{{ $relation->status == 'Completado' ? 'success' : ($relation->status == 'En progreso' ? 'warning' : 'danger') }}">
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



                <!-- Gestión de Eventos -->
                <div class="tab-pane fade" id="eventos" role="tabpanel" aria-labelledby="eventos-tab"
                    style="background-color: #ffe5d9; padding: 20px; border-radius: 12px; font-family: 'Poppins', sans-serif; color: #6b4226;">
                    <h2 style="font-family: 'Playfair Display', serif; color: #b23a48; font-weight: bold;">Gestión de
                        Programas y Eventos</h2>
                    <p style="color: #6b4226;">Gestiona programas, eventos y la relación entre personas y eventos.</p>

                    <!-- Tarjeta: Gestión de Programas y Eventos -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header"
                            style="background: linear-gradient(to right, #de6262, #ff6f61); color: white;">
                            <h3>Gestión de Programas y Eventos</h3>
                        </div>
                        <div class="card-body">
                            <p style="color: #6b4226;">Gestiona programas, eventos y la relación entre personas y eventos.
                            </p>
                            <div class="row text-center">
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <a href="{{ route('programs.index') }}"
                                        class="btn btn-lg btn-gradient w-100 shadow-sm"
                                        style="background: linear-gradient(to right, #ff6f61, #de6262); color: white; font-weight: bold; border-radius: 8px;">
                                        <i class="fas fa-project-diagram"></i> Gestión de Programas
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <a href="{{ route('events.index') }}" class="btn btn-lg btn-gradient w-100 shadow-sm"
                                        style="background: linear-gradient(to right, #f76c5e, #d8474d); color: white; font-weight: bold; border-radius: 8px;">
                                        <i class="fas fa-calendar-alt"></i> Gestión de Eventos
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <a href="{{ route('am_person_events.index') }}"
                                        class="btn btn-lg btn-gradient w-100 shadow-sm"
                                        style="background: linear-gradient(to right, #f27a70, #d94c50); color: white; font-weight: bold; border-radius: 8px;">
                                        <i class="fas fa-user-clock"></i> Personas y Eventos
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta: Estadísticas de Eventos -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header"
                            style="background: linear-gradient(to right, #b23a48, #8a2a37); color: white;">
                            <h3>Estadísticas de Eventos
                                <button class="btn btn-light btn-sm float-right custom-btn" data-toggle="collapse"
        data-target="#dashboardStats" aria-expanded="false" aria-controls="dashboardStats">
    <i class="fas fa-chart-bar"></i> Ver Estadísticas
</button>
                            </h3>
                        </div>
                        <div class="collapse" id="dashboardStatsEv">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Total de Eventos -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card shadow">
                                            <div class="card-header"
                                                style="background: linear-gradient(to right, #de6262, #ff6f61); color: white;">
                                                <h5>Total de Eventos</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <h4 style="color: #6b4226;">{{ $totalEvents }}</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <!-- Eventos Recientes -->
                                        <div class="col-lg-12">
                                            <div class="card shadow mb-4">
                                                <div class="card-header"
                                                    style="background: linear-gradient(to right, #f76c5e, #d8474d); color: white;">
                                                    <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Eventos
                                                        Recientes</h5>
                                                    <button class="btn btn-sm btn-light" data-toggle="collapse"
                                                        data-target="#recentEventsTable" aria-expanded="true"
                                                        aria-controls="recentEventsTable">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                </div>
                                                <div class="collapse show" id="recentEventsTable">
                                                    <div class="card-body">
                                                        @if ($recentEvents->isEmpty())
                                                            <p class="text-center text-muted">No hay eventos recientes
                                                                registrados.</p>
                                                        @else
                                                            <div class="table-responsive">
                                                                <table
                                                                    class="table table-hover table-bordered align-middle text-center">
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
                                                                                <td class="font-weight-bold text-primary">
                                                                                    {{ $event->name }}</td>
                                                                                <td>{{ $event->place }}</td>
                                                                                <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}
                                                                                </td>
                                                                                <td>
                                                                                    @switch($event->status)
                                                                                        @case('Pendiente')
                                                                                            <span
                                                                                                class="badge badge-warning px-3 py-2">{{ $event->status }}</span>
                                                                                        @break

                                                                                        @case('Finalizado')
                                                                                            <span
                                                                                                class="badge badge-success px-3 py-2">{{ $event->status }}</span>
                                                                                        @break

                                                                                        @case('En proceso')
                                                                                            <span
                                                                                                class="badge badge-info px-3 py-2">{{ $event->status }}</span>
                                                                                        @break

                                                                                        @case('Cancelado')
                                                                                            <span
                                                                                                class="badge badge-danger px-3 py-2">{{ $event->status }}</span>
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
                                            <div class="card-header"
                                                style="background: linear-gradient(to right, #f27a70, #d94c50); color: white;">
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
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <style>
        /* Estilo de pestaña activa */
        .nav-tabs .nav-link.active {
            background-color: #f67280;
            color: white;
            border: 1px solid white;
        }

        /* Estilo de pestañas inactivas */
        .nav-tabs .nav-link {
            border: 1px solid white;
            margin-right: 5px;
            border-radius: 5px;
            color: #f67280;
        }

        /* Efecto hover para pestañas */
        .nav-tabs .nav-link:hover {
            background-color: #c06c84;
            color: white;
        }

        /* Bordes decorativos de la cabecera */
        .card-header {
            border-bottom: 2px solid white;
        }

        /* Estilo personalizado para el botón */
        .custom-btn {
            width: 15em;
            height: 3em;
            border-radius: 24em;
            font-size: 13px;
            font-family: inherit;
            border: none;
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: 2px 2px 5px #c5c5c5, -2px -2px 5px #ffffff;
            transition: all 0.2s ease-in-out;
        }

        .custom-btn::before {
            content: '';
            width: 0;
            height: 3em;
            border-radius: 24em;
            position: absolute;
            top: 0;
            left: 0;
            background-image: linear-gradient(to right, #b869fd 0%, #ff8cfd 100%);
            transition: .5s ease;
            display: block;
            z-index: -1;
        }

        .custom-btn:hover::before {
            width: 15em;
        }

        .custom-btn i {
            margin-right: 8px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                            '#9966FF'
                        ], // Colores personalizados
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
        document.addEventListener('DOMContentLoaded', function() {
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
                            '#FFCE56' // Amarillo para Finalizado
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
