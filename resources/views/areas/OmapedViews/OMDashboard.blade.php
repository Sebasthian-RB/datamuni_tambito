@extends('adminlte::page')

@section('title', 'Dashboard - OMAPED')

@section('content_header')
    <h1>Dashboard - OMAPED</h1>
@stop

@section('content')
    <div class="row">
        <!-- Métricas principales -->
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalPersonas }}</h3>
                    <p>Personas Registradas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalCuidadores }}</h3>
                    <p>Cuidadores Registrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalViviendas }}</h3>
                    <p>Viviendas Registradas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-home"></i>
                </div>
                <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Distribución de Discapacidades</h3>
                </div>
                <div class="card-body">
                    <canvas id="discapacidadChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>

        
    </div>
@stop

@section('css')
    <!-- Estilos adicionales -->
    <style>
        .small-box {
            border-radius: 10px;
            color: white;
        }
        .small-box .icon {
            font-size: 70px;
            color: rgba(255, 255, 255, 0.3);
        }
        .small-box:hover .icon {
            color: rgba(255, 255, 255, 0.5);
        }
    </style>
@stop

@section('js')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Gráfico de distribución de discapacidades
        const ctx = document.getElementById('discapacidadChart').getContext('2d');
        const discapacidadChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Leve', 'Moderado', 'Severo'],
                datasets: [{
                    label: 'Nivel de discapacidad',
                    data: [{{ $leve }}, {{ $moderado }}, {{ $severo }}],
                    backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
@stop