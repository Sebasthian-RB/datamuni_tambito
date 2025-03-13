@extends('adminlte::page')

@section('title', 'Dashboard CIAM - Adultos por Edad')

@section('content_header')
<div class="px-4 py-3 d-flex justify-content-between align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
    <h3 style="color: gold; font-weight: bold; margin: 0;">Dashboard CIAM - Adultos por Edad</h3>
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo Visita" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')
<div class="row">
    <!-- Gráfico de Cantidad de Adultos por Edad -->
    <div class="col-lg-12">
        <div class="mb-4 card">
            <div class="text-white card-header" style="background-color: #36A2EB;">
                <h5>Cantidad de Adultos por Edad</h5>
            </div>
            <div class="card-body">
                <canvas id="adultsByAgeChart"></canvas>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 🎨 Función para generar colores degradados dinámicamente
        function generateGradientColors(count) {
            let colors = [];
            let startColor = [76, 175, 80]; // Verde inicial (RGB)
            let endColor = [255, 193, 7]; // Amarillo (RGB)

            for (let i = 0; i < count; i++) {
                let r = Math.round(startColor[0] + ((endColor[0] - startColor[0]) * (i / count)));
                let g = Math.round(startColor[1] + ((endColor[1] - startColor[1]) * (i / count)));
                let b = Math.round(startColor[2] + ((endColor[2] - startColor[2]) * (i / count)));
                colors.push(`rgb(${r}, ${g}, ${b})`);
            }
            return colors;
        }

        // 📊 Gráfico de Cantidad de Adultos por Edad
        new Chart(document.getElementById('adultsByAgeChart'), {
            type: 'bar',
            data: {
                labels: @json($adultsByAge -> pluck('age')), // Edades
                datasets: [{
                    label: 'Cantidad de adultos',
                    data: @json($adultsByAge -> pluck('count')), // Cantidad de adultos por edad
                    backgroundColor: generateGradientColors(@json($adultsByAge -> count())) // Colores degradados
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Eje Y comienza en 0
                    }
                },
                responsive: true, // Hacer la gráfica responsive
                maintainAspectRatio: false // No mantener el aspecto ratio para ajustarse al contenedor
            }
        });
    });
</script>
@stop