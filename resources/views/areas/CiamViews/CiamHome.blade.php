@extends('adminlte::page')

@section('title', 'Área CIAM')

@section('content_header')
<!-- Header con la imagen grande -->
<div class="card mb-4">
    <div class="card-header p-0 d-flex justify-content-center align-items-center"
        style="background-color: #6E8E59; height: 60px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="height: 100%; width: auto;">
    </div>
</div>

<!-- Panel de Control del CIAM -->
<div class="d-flex align-items-center justify-content-between" style="height: 50vh; padding: 0;">

    <!-- Contenedor de Texto Mejorado -->
    <div
        style="flex: 1; text-align: center; color: #6E8E59; z-index: 1; padding: 50px; display: flex; justify-content: center; align-items: center; height: 100%; background: #CAE0BC;">
        <h1 style="font-family: 'Raleway', sans-serif; font-size: 3.5rem; font-weight: 700; margin: 0; letter-spacing: 2px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
            BIENVENIDO A CIAM
        </h1>
    </div>


    <!-- Contenedor Multimedia (imagen) -->
    <div
        style="flex: 1; height: 100%; overflow: hidden; position: relative; display: flex; justify-content: center; align-items: center;">
        <img src="{{ asset('Images/Ciam-homepage.jpeg') }}" alt="Logo CIAM"
            style="max-width: 90%; max-height: 90%; object-fit: contain;">
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Adultos Mayores -->
        <div class="col-md-4">
            <a href="{{ route('elderly_adults.index') }}" class="text-decoration-none">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Adultos Mayores</h3>
                        <p>Gestionar Adultos Mayores</p>
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

        <!-- Guardianes -->
        <div class="col-md-4">
            <a href="{{ route('guardians.index') }}" class="text-decoration-none">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>Guardianes</h3>
                        <p>Administrar Guardianes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <span class="small-box-footer">
                        Ir <i class="fas fa-arrow-circle-right"></i>
                    </span>
                </div>
            </a>
        </div>

        <!-- Dashboard CIAM -->
        <div class="col-md-4">
            <a href="{{ route('ciamdashboard') }}" class="text-decoration-none">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Dashboard</h3>
                        <p>Ver Estadísticas</p>
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