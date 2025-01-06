@extends('adminlte::page')

@section('title', 'Dashboard - Área de la Mujer')

@section('content_header')
    <h1>Panel de Control</h1>
    <p class="text-muted">Sigue los pasos recomendados para gestionar eficientemente los datos del Área de la Mujer.</p>
@stop

@section('content')
<div class="container">
    <!-- Acción Inicial -->
    <div class="card mb-4 border-primary">
        <div class="card-header bg-primary text-white">
            <h3>¡Comienza Aquí!</h3>
        </div>
        <div class="card-body text-center">
            <p>Antes de gestionar casos, intervenciones o eventos, agrega las personas involucradas.</p>
            <a href="{{ route('am_people.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-user-plus"></i> Agregar Nueva Persona
            </a>
        </div>
    </div>

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
    <script>
        console.log('Dashboard cargado correctamente!');
    </script>
@stop
