@extends('adminlte::page')

@section('title', 'Dashboard SISFOH')

@section('content_header')
    <!-- Header con la imagen grande -->
    @section('content_header')
    <!-- Texto e imagen superior -->
    <div class="px-4 py-3 d-flex justify-content-between align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
        <h3 style="color: gold; font-weight: bold; margin: 0;">Dashboard SISFOH</h3>
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo Visita" class="img-fluid" style="max-height: 80px;">
    </div>
    @stop

    <!-- Panel de Control de SISFOH -->
    <div class="d-flex align-items-center justify-content-between" style="height: 50vh; padding: 0;">

        <!-- Contenedor de Texto -->
        <div
            style="flex: 1; text-align: center; color: #54585A; z-index: 1; padding: 40px; display: flex; justify-content: center; align-items: center; height: 100%; background: #64B5F6;">
            <h1 style="font-family: 'Raleway', serif; font-size: 3rem; font-weight: 300; margin: 0; letter-spacing: 1px;">
                PANEL DE CONTROL DE SISFOH
            </h1>
        </div>

        <!-- Contenedor Multimedia (imagen) -->
        <div
            style="flex: 1; height: 100%; overflow: hidden; position: relative; display: flex; justify-content: center; align-items: center;">
            <img src="{{ asset('Images/sfh_family01_sinfondo.png') }}" alt="Logo Familia"
                style="max-width: 90%; max-height: 90%; object-fit: contain;">
        </div>
    </div>
@stop

@section('content')
<div class="row">
    <!-- Gráfico de Estados de Visitas -->
    <div class="col-lg-6">
        <div class="mb-4 card">
            <div class="text-white card-header bg-primary">
                <h5>Distribución de Estados de Visitas</h5>
            </div>
            <div class="card-body">
                <canvas id="visitStatusChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Gráfico de Tipos de Instrumentos Aplicados -->
    <div class="col-lg-6">
        <div class="mb-4 card">
            <div class="text-white card-header bg-success">
                <h5>Tipos de Instrumentos Aplicados</h5>
            </div>
            <div class="card-body">
                <canvas id="instrumentTypeChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Gráfico de Solicitudes por Fecha (Año/Mes) -->
    <div class="col-lg-6">
        <div class="mb-4 card">
            <div class="text-white card-header bg-warning">
                <h5>Solicitudes de Ayuda por Fecha</h5>
            </div>
            <div class="card-body">
                <canvas id="requestDateChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Gráfico de Estados de Viviendas -->
    <div class="col-lg-6">
        <div class="mb-4 card">
            <div class="text-white card-header bg-danger">
                <h5>Estado de Viviendas</h5>
            </div>
            <div class="card-body">
                <canvas id="dwellingStatusChart"></canvas>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gráfico de Estados de Visitas
    new Chart(document.getElementById('visitStatusChart'), {
        type: 'pie',
        data: {
            labels: @json($visitStatusStats->pluck('status')),
            datasets: [{ data: @json($visitStatusStats->pluck('count')), backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56'] }]
        }
    });

    // Gráfico de Tipos de Instrumentos Aplicados
    new Chart(document.getElementById('instrumentTypeChart'), {
        type: 'bar',
        data: {
            labels: @json($instrumentTypeStats->pluck('type_instruments')),
            datasets: [{ label: 'Cantidad', data: @json($instrumentTypeStats->pluck('count')), backgroundColor: '#4BC0C0' }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // Gráfico de Solicitudes de Ayuda por Fecha
    new Chart(document.getElementById('requestDateChart'), {
        type: 'line',
        data: {
            labels: @json($requestDateStats->pluck('formatted_date')),
            datasets: [{ label: 'Solicitudes', data: @json($requestDateStats->pluck('count')), borderColor: '#FF9F40', fill: false }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // Gráfico de Estados de Viviendas
    new Chart(document.getElementById('dwellingStatusChart'), {
        type: 'bar',
        data: {
            labels: @json($dwellingStatusStats->pluck('status')),
            datasets: [{ label: 'Cantidad', data: @json($dwellingStatusStats->pluck('count')), backgroundColor: '#9966FF' }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
});
</script>
@stop
