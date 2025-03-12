@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- Header con la imagen grande -->
<div class="card mb-4">
    <div class="card-header p-0 d-flex justify-content-center align-items-center"
        style="background-color: #3fa22f; height: 100px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="height: 100%; width: auto;">
    </div>
</div>
@stop

@section('content')
<!-- Panel de Administración -->
<div class="card mb-4 shadow">
    <div class="card-header bg-gradient-success text-white py-4">
        <h1 class="text-center mb-0">
            <i class="fas fa-user-shield fa-lg mr-3"></i>
            Panel de Administración del Administrador
            <div class="header-line mt-3"></div>
        </h1>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <!-- Sección principal de áreas -->
        <div class="col-md-9">
            <div class="row" style="max-height: 70vh; overflow-y: auto;">
                <!-- Área de la Mujer -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow border-top-0">
                        <div class="card-header bg-gradient-purple text-white py-3">
                            <h5 class="mb-0"><i class="fas fa-female mr-2"></i>Área de la Mujer</h5>
                        </div>
                        <div class="card-img-container p-3">
                            <img src="{{ asset('images/AreaDeLaMujerLogo.png') }}" class="card-img-top img-fluid" 
                                alt="Área de la Mujer" style="height: 150px; object-fit: contain;">
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted">
                                Programa de protección y desarrollo integral para la mujer, promoviendo la igualdad 
                                de género y prevención de violencia.
                            </p>
                            <a href="{{ route('amdashboard') }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <!-- Vaso de Leche -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow border-top-0">
                        <div class="card-header bg-gradient-green text-white py-3">
                            <h5 class="mb-0"><i class="fas fa-mug-hot mr-2"></i>Vaso de Leche</h5>
                        </div>
                        <div class="card-img-container p-3">
                            <img src="{{ asset('images/vaso-de-leche.jpg') }}" class="card-img-top" 
                                alt="Vaso de Leche" style="height: 150px; object-fit: contain;">
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted">
                                Distribución controlada de alimentos complementarios para niños, adultos mayores 
                                y personas en situación de vulnerabilidad.
                            </p>
                            <a href="{{ route('vaso-de-leche.index') }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <!-- OMAPED -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow border-top-0">
                        <div class="card-header bg-gradient-blue text-white py-3">
                            <h5 class="mb-0"><i class="fas fa-wheelchair mr-2"></i>OMAPED</h5>
                        </div>
                        <div class="card-img-container p-3">
                            <img src="{{ asset('images/omaped.png') }}" class="card-img-top" 
                                alt="OMAPED" style="height: 150px; object-fit: contain;">
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted">
                                Oficina Municipal de Atención a la Persona con Discapacidad, promoviendo la inclusión 
                                social y acceso a servicios especializados.
                            </p>
                            <a href="{{ route('omdashboard') }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <!-- SISFOH -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow border-top-0">
                        <div class="card-header bg-gradient-orange text-white py-3">
                            <h5 class="mb-0"><i class="fas fa-clipboard-check mr-2"></i>SISFOH</h5>
                        </div>
                        <div class="card-img-container p-3">
                            <img src="{{ asset('images/sfh_family02_sinfondo.png') }}" class="card-img-top" 
                                alt="SISFOH" style="height: 150px; object-fit: contain;">
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted">
                                Sistema de focalización de hogares para identificación y clasificación socioeconómica 
                                de beneficiarios de programas sociales.
                            </p>
                            <a href="{{ route('sfhdashboard') }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <!-- CIAM -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow border-top-0">
                        <div class="card-header bg-gradient-red text-white py-3">
                            <h5 class="mb-0"><i class="fas fa-city mr-2"></i>CIAM</h5>
                        </div>
                        <div class="card-img-container p-3">
                            <img src="{{ asset('images/Ciam-homepage.jpeg') }}" class="card-img-top" 
                                alt="CIAM" style="height: 150px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted">
                                Centro Integrado de Atención Municipal para trámites administrativos, servicios 
                                ciudadanos y gestión documentaria.
                            </p>
                            <a href="{{ route('CiamHome') }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel lateral con botón de usuarios -->
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-header bg-gradient-indigo text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-user-shield mr-2"></i>Administración</h5>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('users.index') }}" class="btn btn-lg btn-outline-primary w-100 mb-3">
                        <i class="fas fa-users-cog fa-2x"></i>
                        <div class="mt-2">Gestión de Usuarios</div>
                    </a>
                    <hr>
                    <h6 class="text-muted mb-3">Accesos Rápidos</h6>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-tools mr-2"></i>Configuración
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-chart-bar mr-2"></i>Reportes
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-clipboard-list mr-2"></i>Auditoría
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Botón flotante -->
<a href="{{ route('users.create') }}" class="btn btn-danger btn-lg rounded-circle shadow-lg" 
   style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px;">
    <i class="fas fa-user-plus"></i>
</a>
@stop

@section('css')
<style>
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    .bg-gradient-purple {
        background: linear-gradient(45deg, #6f42c1, #8a63d2);
    }

    .bg-gradient-green {
        background: linear-gradient(45deg, #28a745, #3dd965);
    }

    .bg-gradient-blue {
        background: linear-gradient(45deg, #1e88e5, #42a5f5);
    }

    .bg-gradient-orange {
        background: linear-gradient(45deg, #fd7e14, #ff9f43);
    }

    .bg-gradient-red {
        background: linear-gradient(45deg, #dc3545, #ef5350);
    }

    .bg-gradient-indigo {
        background: linear-gradient(45deg, #6610f2, #7c4dff);
    }

    .card-img-container {
        background-color: #f8f9fa;
        text-align: center;
    }

    .list-group-item {
        border: none;
        border-radius: 8px!important;
        margin-bottom: 5px;
        transition: all 0.3s ease;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }
    
</style>
@stop