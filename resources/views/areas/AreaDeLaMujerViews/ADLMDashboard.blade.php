@extends('adminlte::page')

@section('title', 'Dashboard - Área de la Mujer')

@section('content_header')
    <h1>Panel de Control</h1>
@stop

@section('content')
<div class="row">
    <!-- Botón para Casos -->
    <div class="col-lg-4 col-md-6">
        <a href="{{ route('violences.index') }}" class="btn btn-primary btn-block btn-lg">
            <i class="fas fa-exclamation-circle"></i> Gestión de Casos
        </a>
    </div>

    <!-- Botón para Eventos -->
    <div class="col-lg-4 col-md-6">
        <a href="{{ route('events.index') }}" class="btn btn-success btn-block btn-lg">
            <i class="fas fa-calendar-alt"></i> Gestión de Eventos
        </a>
    </div>

    <!-- Botón para Intervenciones -->
    <div class="col-lg-4 col-md-6">
        <a href="{{ route('interventions.index') }}" class="btn btn-warning btn-block btn-lg">
            <i class="fas fa-handshake"></i> Gestión de Intervenciones
        </a>
    </div>

    <!-- Botón para Programas -->
    <div class="col-lg-4 col-md-6 mt-4">
        <a href="{{ route('programs.index') }}" class="btn btn-info btn-block btn-lg">
            <i class="fas fa-project-diagram"></i> Gestión de Programas
        </a>
    </div>

    <!-- Botón para Personas -->
    <div class="col-lg-4 col-md-6 mt-4">
        <a href="{{ route('am_people.index') }}" class="btn btn-danger btn-block btn-lg">
            <i class="fas fa-users"></i> Gestión de Personas
        </a>
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
