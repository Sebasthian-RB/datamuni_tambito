@extends('adminlte::page')

@section('title', 'Dashboard SISFOH')

@section('content_header')
<div class="px-4 py-3 d-flex justify-content-between align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
    <h3 style="color: gold; font-weight: bold; margin: 0;">Dashboard SISFOH</h3>
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo Visita" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')
<div class="row">
    <!-- Gráfico de Estados de Visitas -->
    <div class="col-lg-6">
        <div class="mb-4 card">
            <div class="text-white card-header" style="background-color: #36A2EB;">
                <h5>Distribución de Estados de Visitas</h5>
            </div>
            <div class="card-body">
                <canvas id="visitStatusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Gráfico de Solicitudes de Ayuda por Mes -->
    <div class="col-lg-6">
        <div class="mb-4 card">
            <div class="text-white card-header d-flex align-items-center justify-content-between" style="background-color: #4CAF50;">
                <!-- Selector de Año -->
                <select id="yearSelector" class="form-select" style="width: auto; display: inline-block;">
                    @foreach ($years as $year)
                    <option value="{{ $year }}" {{ $year == now()->year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
                <h5 class="m-0">Solicitudes de Ayuda Atendidas por Mes</h5>
            </div>
            <div class="card-body">
                <canvas id="requestsChart"></canvas>
                <!-- Contenedor para la leyenda -->
                <div id="requestsLegend" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
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

        // 📊 Gráfico de Estados de Visitas
        new Chart(document.getElementById('visitStatusChart'), {
            type: 'pie',
            data: {
                labels: @json($visitStatusStats -> pluck('status')),
                datasets: [{
                    data: @json($visitStatusStats -> pluck('count')),
                    backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56']
                }]
            }
        });

        // 📌 Obtener datos iniciales
        let requestData = @json($requestDateStats);
        let currentYear = document.getElementById('yearSelector').value;

        // 📌 Función para filtrar los datos por año seleccionado
        function filterDataByYear(year) {
            return requestData.filter(item => item.year == year);
        }

        // 📌 Función para formatear el mes en texto
        function getMonthName(monthNumber) {
            const monthNames = [
                "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
            ];
            return monthNames[monthNumber - 1];
        }

        // 📌 Función para actualizar el gráfico y la leyenda
        function updateChart() {
            let filteredData = filterDataByYear(currentYear);
            let labels = filteredData.map(item => getMonthName(item.month));
            let data = filteredData.map(item => item.count);
            let colors = generateGradientColors(labels.length);

            // Actualizar datos del gráfico
            requestsChart.data.labels = labels;
            requestsChart.data.datasets[0].data = data;
            requestsChart.data.datasets[0].backgroundColor = colors;
            requestsChart.update();

            // Generar la nueva leyenda
            let legendContainer = document.getElementById('requestsLegend');
            legendContainer.innerHTML = "";
            labels.forEach((label, index) => {
                let legendItem = document.createElement('div');
                legendItem.style.display = 'flex';
                legendItem.style.alignItems = 'center';
                legendItem.style.marginBottom = '5px';

                let colorBox = document.createElement('span');
                colorBox.style.width = '15px';
                colorBox.style.height = '15px';
                colorBox.style.backgroundColor = colors[index];
                colorBox.style.display = 'inline-block';
                colorBox.style.marginRight = '10px';

                let text = document.createElement('span');
                text.textContent = `${label}: ${data[index]} personas atendidas`;

                legendItem.appendChild(colorBox);
                legendItem.appendChild(text);
                legendContainer.appendChild(legendItem);
            });
        }

        // 📊 Inicializar el gráfico
        const requestsChart = new Chart(document.getElementById('requestsChart'), {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Personas atendidas',
                    data: [],
                    backgroundColor: []
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    } // Ocultar la leyenda de Chart.js
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // 🔄 Actualizar el gráfico cuando se cambie el año
        document.getElementById('yearSelector').addEventListener('change', function() {
            currentYear = this.value;
            updateChart();
        });

        // 🔄 Cargar datos iniciales
        updateChart();
    });
</script>
@stop