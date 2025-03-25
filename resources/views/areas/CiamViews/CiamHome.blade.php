@extends('adminlte::page')

@section('title', 'Área CIAM')

@push('css')
<!-- Enlace a Google Fonts para Merriweather -->
<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@endpush

@section('content_header')

<!-- Header con la imagen grande -->
<div class="card mb-4">
    <div class="card-header p-0 d-flex justify-content-center align-items-center"
        style="background-color: #6E8E59; height: 60px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="height: 100%; width: auto;">
    </div>
</div>

<!-- Contenedor del Video -->
<div class="position-relative" style="height: 45vh; overflow: hidden;">
    <video autoplay loop muted playsinline class="w-100 h-100"
        style="object-fit: cover; object-position: top; position: absolute; left: 0;">
        <source src="{{ asset('videos/CIAM-elderlyadultvideo.mp4') }}" type="video/mp4">
        Tu navegador no soporta videos.
    </video>
</div>

<!-- Contenedor de Texto 
<div style="flex: 1; text-align: center; color: #3B1E54; z-index: 1; padding: 40px; display: flex; justify-content: center; align-items: center; height: 100%; background: #D4BEE4;">
    <h1 style="font-family: 'raleway', serif; font-size: 4rem; font-weight: 300; margin: 0; letter-spacing: 1px;">
        BIENVENIDO A VASO DE LECHE
    </h1>
</div> -->

<!-- Contenedor de Texto -->
<div style="flex: 1; text-align: center; color: #780C28; z-index: 1; padding: 15px; display: flex; justify-content: center; align-items: center; height: 120%; background: #CAE0BC;">
    <h1 style="font-family: 'raleway', serif; font-size: 4rem; font-weight: 300; margin: 0; letter-spacing: 1px;">
        BIENVENIDO A CIAM
    </h1>
</div>

<!-- Sección de Bienvenida 
<div class="d-flex align-items-center justify-content-center text-center"
    style="height: 120px; background-color: #CAE0BC;">
    <h1 style="font-family: 'Playfair Display', serif; font-size: 4rem; font-weight: bold; color: #780C28;">
        BIENVENIDO A CIAM
    </h1>
</div>-->
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <!-- Adultos Mayores -->
        <div class="col-md-4">
            <a href="{{ route('elderly_adults.index') }}" class="text-decoration-none">
                <div class="small-box" style="background-color: #6E8E59; color: white;">
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
                <div class="small-box" style="background-color: #780C28; color: white;">
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
                <div class="small-box" style="background-color: #CAE0BC; color: #333;">
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