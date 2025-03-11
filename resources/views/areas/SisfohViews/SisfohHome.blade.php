@extends('adminlte::page')

@section('title', 'Área SISFOH')

@push('css')
<!-- Enlace a Google Fonts para Raleway -->
<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@endpush

@section('content_header')

<!-- Header con la imagen grande -->
<div class="mb-4 card">
    <div class="p-0 card-header d-flex justify-content-center align-items-center"
        style="background-color: #34495E; height: 60px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="height: 100%; width: auto;">
    </div>
</div>

<!-- Contenedor del Video -->
<div class="position-relative" style="height: 45vh; overflow: hidden;">
    <video autoplay loop muted playsinline class="w-100 h-100"
        style="object-fit: cover; object-position: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <source src="{{ asset('Videos/videosisfoh2MT.mp4') }}" type="video/mp4">
        Tu navegador no soporta videos.
    </video>
</div>

<!-- Contenedor de Texto -->
<div style="flex: 1; text-align: center; color: #2C3E50; z-index: 1; padding: 15px; display: flex; justify-content: center; align-items: center; height: 120%; background: #ECF0F1;">
    <h1 style="font-family: 'raleway', serif; font-size: 4rem; font-weight: 300; margin: 0; letter-spacing: 1px;">
        BIENVENIDO A SISFOH
    </h1>
</div>

@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <!-- Generar Personas -->
        <div class="col-md-4">
            <a href="{{ route('sfh_people.index') }}" class="text-decoration-none">
                <div class="small-box" style="background-color: #3498DB; color: white;">
                    <div class="inner">
                        <h3 style="font-size: 1.5rem;">Generar Personas</h3>
                        <p>Registrar nuevos beneficiarios</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <span class="small-box-footer">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </span>
                </div>
            </a>
        </div>

        <!-- Consultar Datos de Viviendas -->
        <div class="col-md-4">
            <a href="{{ route('sfh_dwelling.index') }}" class="text-decoration-none">
                <div class="small-box" style="background-color: #E74C3C; color: white;">
                    <div class="inner">
                        <h3 style="font-size: 1.5rem;">Consultar Viviendas</h3>
                        <p>Gestionar información de viviendas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <span class="small-box-footer">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </span>
                </div>
            </a>
        </div>

        <!-- Generar Encuestadores -->
        <div class="col-md-4">
            <a href="{{ route('enumerators.index') }}" class="text-decoration-none">
                <div class="small-box" style="background-color: #2ECC71; color: white;">
                    <div class="inner">
                        <h3 style="font-size: 1.5rem;">Generar Empadronadores</h3>
                        <p>Registrar nuevos empadronadores</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <span class="small-box-footer">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </span>
                </div>
            </a>
        </div>

        <!-- Consultar Solicitudes -->
        <div class="col-md-4">
            <a href="{{ route('sfh_requests.index') }}" class="text-decoration-none">
                <div class="small-box" style="background-color: #F1C40F; color: white;">
                    <div class="inner">
                        <h3 style="font-size: 1.5rem;">Consultar Solicitudes</h3>
                        <p>Revisar solicitudes de hogares</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-list-alt"></i>
                    </div>
                    <span class="small-box-footer">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </span>
                </div>
            </a>
        </div>

        <!-- Generar Visitas -->
        <div class="col-md-4">
            <a href="{{ route('visits.index') }}" class="text-decoration-none">
                <div class="small-box" style="background-color: #9B59B6; color: white;">
                    <div class="inner">
                        <h3 style="font-size: 1.5rem;">Generar Visitas</h3>
                        <p>Programar visitas domiciliarias</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <span class="small-box-footer">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </span>
                </div>
            </a>
        </div>

        <!-- Consultar Instrumentos -->
        <div class="col-md-4">
            <a href="{{ route('instruments.index') }}" class="text-decoration-none">
                <div class="small-box" style="background-color: #1ABC9C; color: white;">
                    <div class="inner">
                        <h3 style="font-size: 1.5rem;">Consultar Instrumentos</h3>
                        <p>Ver formularios e instrumentos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <span class="small-box-footer">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </span>
                </div>
            </a>
        </div>

        <!-- Dashboard -->
        <div class="col-md-4">
            <a href="{{ route('sfhdashboard') }}" class="text-decoration-none">
                <div class="small-box" style="background-color: #FF5733; color: white;">
                    <div class="inner">
                        <h3 style="font-size: 1.5rem;">Dashboard</h3>
                        <p>Ver estadísticas generales</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <span class="small-box-footer">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </span>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection