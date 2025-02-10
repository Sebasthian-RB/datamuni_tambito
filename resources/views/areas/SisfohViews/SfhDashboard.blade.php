@extends('adminlte::page')

@section('title', 'Dashboard SISFOH')

@section('content_header')
    <h1>Dashboard SISFOH</h1>
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
