@extends('adminlte::page')

@section('title', 'Vaso de Leche')

@push('css')
    <!-- Enlace a Google Fonts para Merriweather -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@endpush

@section('content_header')
    <div class="d-flex align-items-center justify-content-between" style="height: 50vh; padding: 0;">

        <!-- Contenedor de Texto -->
        <div style="flex: 1; text-align: center; color: #3B1E54; z-index: 1; padding: 40px; display: flex; justify-content: center; align-items: center; height: 100%; background: #D4BEE4;">
            <h1 style="font-family: 'raleway', serif; font-size: 4rem; font-weight: 300; margin: 0; letter-spacing: 1px;">
                BIENVENIDO A VASO DE LECHE
            </h1>
        </div>

        <!-- Video -->
        <div style="flex: 1; height: 100%; overflow: hidden; position: relative;">
            <video autoplay loop muted style="object-fit: cover; width: 100%; height: 100%; position: absolute;">
                <source src="{{ asset('videos/vaso-de-leche-01.mp4') }}" type="video/mp4">
                Tu navegador no soporta el elemento de video.
            </video>

            <!-- Filtro oscuro sobre el video -->
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4);"></div>
        </div>
    </div>
@stop


@section('content')
<div class="wrapper">
    <!-- BOTONES DE CONFIGURACION -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Carrusel Circular -->
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <!-- Items del carrusel -->
                    <div class="carousel-inner">
                        <!-- Primer slide -->
                        <div class="carousel-item active">
                            <div class="row justify-content-center"> 
                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="{{ route('products.index') }}" class="small-box" style="display: block; background-color: #9B7EBD; text-align: center; padding: 12px 10px; color: white; text-decoration: none; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); transition: background-color 0.3s;">
                                        <i class="fas fa-box" style="font-size: 1.5rem;"></i>
                                        <p style="font-size: 0.9rem; margin-top: 8px; margin-bottom: 0;">Configurar Productos</p>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="{{ route('sectors.index') }}" class="small-box" style="display: block; background-color: #9B7EBD; text-align: center; padding: 12px 10px; color: white; text-decoration: none; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); transition: background-color 0.3s;">
                                        <i class="fas fa-bullseye" style="font-size: 1.5rem;"></i>
                                        <p style="font-size: 0.9rem; margin-top: 8px; margin-bottom: 0;">Configurar Sectores</p>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="{{ route('committees.index') }}" class="small-box" style="display: block; background-color: #9B7EBD; text-align: center; padding: 12px 10px; color: white; text-decoration: none; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); transition: background-color 0.3s;">
                                        <i class="fas fa-flag" style="font-size: 1.5rem;"></i>
                                        <p style="font-size: 0.9rem; margin-top: 8px; margin-bottom: 0;">Configurar Comités</p>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="{{ route('vl_family_members.index') }}" class="small-box" style="display: block; background-color: #9B7EBD; text-align: center; padding: 12px 10px; color: white; text-decoration: none; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); transition: background-color 0.3s;">
                                        <i class="fas fa-users" style="font-size: 1.5rem;"></i>
                                        <p style="font-size: 0.9rem; margin-top: 8px; margin-bottom: 0;">Configurar Familiares</p>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="{{ route('vl_minors.index') }}" class="small-box" style="display: block; background-color: #9B7EBD; text-align: center; padding: 12px 10px; color: white; text-decoration: none; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); transition: background-color 0.3s;">
                                        <i class="fas fa-child" style="font-size: 1.5rem;"></i>
                                        <p style="font-size: 0.9rem; margin-top: 8px; margin-bottom: 0;">Configurar Menores</p>
                                    </a>
                                </div>
                            </div>
                        </div>
    
                        <!-- Segundo slide -->
                        <div class="carousel-item">
                            <div class="row justify-content-center"> 
                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="{{ route('committees.create') }}" class="small-box" style="display: block; background-color: #EEEEEE; text-align: center; padding: 12px 10px; color: #3B1E54; text-decoration: none; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); transition: background-color 0.3s;">
                                        <i class="fas fa-chart-line" style="font-size: 1.5rem;"></i>
                                        <p style="font-size: 0.9rem; margin-top: 8px; margin-bottom: 0;">Estadísticas</p>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="{{ route('committees.create') }}" class="small-box" style="display: block; background-color: #EEEEEE; text-align: center; padding: 12px 10px; color: #3B1E54; text-decoration: none; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); transition: background-color 0.3s;">
                                        <i class="fas fa-file-export" style="font-size: 1.5rem;"></i>
                                        <p style="font-size: 0.9rem; margin-top: 8px; margin-bottom: 0;">Exportar</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Botones -->
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev" style="background-color: #3B1E54; border-color: #3B1E54; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: absolute; top: 50%; transform: translateY(-50%);">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #3B1E54; width: 20px; height: 20px; border-radius: 50%;"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next" style="background-color: #3B1E54; border-color: #3B1E54; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: absolute; top: 50%; transform: translateY(-50%); right: 0;">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #3B1E54; width: 20px; height: 20px; border-radius: 50%;"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg rounded-lg border-0" style="background-color: white;">
                    <div class="card-header text-white text-center" style="background-color: #3B1E54;">
                        <h3 class="card-title">Filtrar Comités</h3>
                    </div>
                    <div class="card-body bg-light p-4">
                        <form action="{{ route('committees.index') }}" method="GET">
                            <div class="row g-3 justify-content-between">
                                <!-- Filtro de Nombre del Comité -->
                                <div class="col-12 col-md-2">
                                    <div class="input-group">
                                        <input type="text" name="name" id="name" class="form-control shadow-sm border-0 rounded-3" placeholder="Nombre del Comité" value="{{ request('name') }}" style="height: 40px; font-size: 0.875rem;">
                                        <span class="input-group-text" style="background-color: #9B7EBD; color: white; border-radius: 0 30px 30px 0;">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
    
                                <!-- Filtro de Presidente -->
                                <div class="col-12 col-md-2">
                                    <div class="input-group">
                                        <input type="text" name="president" id="president" class="form-control shadow-sm border-0 rounded-3" placeholder="Presidente" value="{{ request('president') }}" style="height: 40px; font-size: 0.875rem;">
                                        <span class="input-group-text" style="background-color: #9B7EBD; color: white; border-radius: 0 30px 30px 0;">
                                            <i class="fas fa-user-tie"></i>
                                        </span>
                                    </div>
                                </div>
    
                                <!-- Filtro de Núcleo Urbano -->
                                <div class="col-12 col-md-2">
                                    <div class="input-group">
                                        <select name="urban_core" id="urban_core" class="form-control shadow-sm border-0 rounded-3" style="height: 40px; font-size: 0.875rem; background-color: #f0f0f0;">
                                            <option value="">Seleccionar núcleo urbano</option>
                                            <!-- Aquí podrías agregar las opciones del núcleo urbano dinámicamente -->
                                            <option value="1" {{ request('urban_core') == '1' ? 'selected' : '' }}>Núcleo 1</option>
                                            <option value="2" {{ request('urban_core') == '2' ? 'selected' : '' }}>Núcleo 2</option>
                                            <option value="3" {{ request('urban_core') == '3' ? 'selected' : '' }}>Núcleo 3</option>
                                        </select>
                                        <span class="input-group-text" style="background-color: #9B7EBD; color: white; border-radius: 0 30px 30px 0;">
                                            <i class="fas fa-city"></i>
                                        </span>
                                    </div>
                                </div>
    
                                <!-- Filtro de Número de Beneficiarios -->
                                <div class="col-12 col-md-2">
                                    <div class="input-group">
                                        <input type="number" name="beneficiaries_count" id="beneficiaries_count" class="form-control shadow-sm border-0 rounded-3" placeholder="Beneficiarios" value="{{ request('beneficiaries_count') }}" style="height: 40px; font-size: 0.875rem;">
                                        <span class="input-group-text" style="background-color: #9B7EBD; color: white; border-radius: 0 30px 30px 0;">
                                            <i class="fas fa-users"></i>
                                        </span>
                                    </div>
                                </div>
    
                                <!-- Filtro de Sector -->
                                <div class="col-12 col-md-2">
                                    <div class="input-group">
                                        <select name="sector_id" id="sector_id" class="form-control shadow-sm border-0 rounded-3" style="height: 40px; font-size: 0.875rem; background-color: #f0f0f0;">
                                            <option value="">Seleccione un sector</option>
                                            @foreach($sectors as $sector)
                                                <option value="{{ $sector->id }}" {{ request('sector_id') == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text" style="background-color: #9B7EBD; color: white; border-radius: 0 30px 30px 0;">
                                            <i class="fas fa-briefcase"></i>
                                        </span>
                                    </div>
                                </div>
    
                                <!-- Botón de Aplicar Filtro más pequeño (menos ancho) -->
                                <div class="col-12 col-md-1 d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn w-75 rounded-3 py-1 shadow-sm" style="background-color: #3B1E54; color: white; font-size: 0.9rem;">
                                        <i class="fas fa-filter me-2"></i> Filtrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Tarjetas de Comités -->
    <div class="row">
        @foreach($committees as $committee)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                <div class="card" style="border-radius: 10px; background: linear-gradient(180deg, #D4BEE4, #D4BEE4); color: white; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);">
    
                    <!-- Parte superior: iconos de acción -->
                    <div class="d-flex justify-content-end p-2">
                        <a href="{{ route('committees.show', $committee->id) }}" style="font-size: 0.9rem; color: white;" target="_blank">
                            <i class="fas fa-eye" style="font-size: 0.9rem;"></i>
                        </a>
                        <a href="{{ route('committees.edit', $committee->id) }}" style="font-size: 0.9rem; color: white; margin-left: 10px;" target="_blank">
                            <i class="fas fa-pen" style="font-size: 0.9rem;"></i>
                        </a>
                    </div>
    
                    <!-- Imagen de fondo -->
                    <div class="card-header text-center" style="background-color: rgba(0, 0, 0, 0.1); padding: 12px 10px 6px 10px;">
                        <h3 style="font-family: 'Raleway', sans-serif; font-size: 1rem; font-weight: 600; color: white; text-transform: capitalize; margin-bottom: 2px;">
                            {{ $committee->name }}
                        </h3>
                        <p style="font-size: 0.8rem; font-weight: 300; color: white; margin-top: 2px; margin-bottom: 0;">
                            Comité N° {{ $committee->id }}
                        </p>
                    </div>


                    <!-- Cuerpo de la tarjeta: detalles del comité -->
                    <div class="card-body" style="padding: 24px 12px 1px 12px;">
                        <div class="row">
                            <!-- Sección de Beneficiarios -->
                            <div class="col-12 col-md-6 mb-2">
                                <div class="info-box" style="background-color: #EEEEEE; padding: 12px; border-radius: 8px; display: flex; align-items: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    <i class="fas fa-users" style="font-size: 1.2rem; color: #3B1E54; margin-right: 16px;"></i> <!-- Aumento del margen entre el ícono y el texto -->
                                    <div>
                                        <p style="font-size: 0.8rem; font-weight: 400; color: #3B1E54; margin-bottom: 0;">Beneficiarios</p>
                                        <h5 style="font-size: 1rem; font-weight: 500; color: #3B1E54; margin-top: 2px;">
                                            {{ $committee->beneficiaries_count }}
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de Sector -->
                            <div class="col-12 col-md-6 mb-2">
                                <div class="info-box" style="background-color: #EEEEEE; padding: 12px; border-radius: 8px; display: flex; align-items: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    <i class="fas fa-briefcase" style="font-size: 1.2rem; color: #3B1E54; margin-right: 16px;"></i> <!-- Aumento del margen entre el ícono y el texto -->
                                    <div>
                                        <p style="font-size: 0.8rem; font-weight: 400; color: #3B1E54; margin-bottom: 0;">Sector</p>
                                        <h5 style="font-size: 1rem; font-weight: 500; color: #3B1E54; margin-top: 2px;">
                                            {{ $committee->sector->name }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Segunda fila: Sección de Presidente(a) -->
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-12 mb-2" style="margin-bottom: 0;">
                                <div class="info-box" style="background-color: #EEEEEE; padding: 12px; border-radius: 8px; display: flex; align-items: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    <i class="fas fa-user-tie" style="font-size: 1.2rem; color: #3B1E54; margin-right: 16px;"></i> <!-- Aumento del margen entre el ícono y el texto -->
                                    <div>
                                        <p style="font-size: 0.8rem; font-weight: 400; color: #3B1E54; margin-bottom: 0;">Presidente(a)</p>
                                        <h5 style="font-size: 1rem; font-weight: 500; color: #3B1E54; margin-top: 2px;">
                                            {{ $committee->president_paternal_surname }} 
                                            @if($committee->president_maternal_surname) {{ $committee->president_maternal_surname }} @endif,
                                            {{ $committee->president_given_name }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Pie de la tarjeta: botones -->
                    <div class="card-footer" style="background-color: #9B7EBD; padding: 8px 10px;">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <!-- Botón Padrón de Beneficiarios -->
                            <a href="#" class="btn btn-gradient-primary w-100 py-2 mb-0 rounded-lg font-weight-bold text-white text-center transition-all duration-300 hover:bg-primary hover:shadow-xl d-flex flex-column align-items-center justify-content-center" style="transition: transform 0.3s ease; padding: 6px;">
                                <i class="fas fa-users mb-2" style="font-size: 1rem;"></i>
                                <span style="font-size: 0.8rem;">Padrón de Beneficiarios</span>
                            </a>
                    
                            <!-- Línea Divisoria Blanca -->
                            <div class="vr" style="border-left: 2px solid #ffffff; height: 40px; margin-top: 0px; margin: 0px 8px 0px 8px;"></div>
                    
                            <!-- Botón Distribución de Productos -->
                            <a href="#" class="btn btn-gradient-secondary w-100 py-2 mb-0 rounded-lg font-weight-bold text-white text-center transition-all duration-300 hover:bg-secondary hover:shadow-xl d-flex flex-column align-items-center justify-content-center" style="transition: transform 0.3s ease; padding: 6px;">
                                <i class="fas fa-box-open mb-2" style="font-size: 1rem;"></i>
                                <span style="font-size: 0.8rem;">Distribución de Productos</span>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        @endforeach
    </div>
     
    <!-- Enlaces de paginación -->
    <div class="d-flex justify-content-center mt-4">
        @if ($committees->hasPages())
            <ul class="pagination">
                <!-- Página anterior -->
                @if ($committees->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link" style="color: #9B7EBD;">Anterior</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $committees->previousPageUrl() }}" rel="prev" style="color: #9B7EBD;">Anterior</a>
                    </li>
                @endif
    
                <!-- Páginas numeradas -->
                @foreach ($committees->getUrlRange(1, $committees->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $committees->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}" 
                           style="color: {{ $page == $committees->currentPage() ? 'white' : '#9B7EBD' }}; 
                           background-color: {{ $page == $committees->currentPage() ? '#9B7EBD' : 'transparent' }};">
                           {{ $page }}
                        </a>
                    </li>
                @endforeach
    
                <!-- Página siguiente -->
                @if ($committees->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $committees->nextPageUrl() }}" rel="next" style="color: #9B7EBD;">Siguiente</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link" style="color: #9B7EBD;">Siguiente</span>
                    </li>
                @endif
            </ul>
        @endif
    </div>
    



    <!-- Gráfico de estadísticas -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gráfico de Distribución Mensual</h3>
                </div>
                <div class="card-body">
                    <canvas id="distributionChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop


@section('js')
    <!-- Script del gráfico -->
    <script src="{{ asset('vendor/adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        $(function () {
            // Gráfico de distribución mensual
            var ctx = $('#distributionChart').get(0).getContext('2d');
            var distributionChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                    datasets: [{
                        label: 'Litros Distribuidos',
                        data: [120, 180, 150, 200, 170, 250],
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

    <!-- Script para agrandar los botones al pasar el cursor -->
    <script>
        $(document).ready(function () {
            // Agregar el efecto de agrandamiento al pasar el cursor
            const buttons = $('.btn'); // Seleccionamos todos los botones con la clase "btn"
            buttons.each(function () {
                $(this).on('mouseenter', function () {
                    $(this).css('transform', 'scale(1.1)');
                });

                $(this).on('mouseleave', function () {
                    $(this).css('transform', 'scale(1)');
                });
            });
        });
    </script>
@stop

