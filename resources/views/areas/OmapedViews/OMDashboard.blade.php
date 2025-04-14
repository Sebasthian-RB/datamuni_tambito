@extends('adminlte::page')

@section('title', 'Dashboard OMAPED')

@section('content_header')
    <div class="dashboard-banner">
        <div class="municipal-banner">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" class="municipal-logo" alt="Escudo Municipal">
            <div class="banner-overlay"></div>
        </div>
        <br>
        <h1 class="dashboard-title">
            <span class="title-gradient">Panel de Gestión OMAPED</span>
            <div class="title-line"></div>
        </h1>
    </div>
@stop

@section('content')
    <div class="container-fluid dashboard-container">
        <!-- Tarjeta principal -->
        <div class="main-metric">
            <div class="main-card">
                <div class="metric-content">
                    <i class="fas fa-users"></i>
                    <div class="metric-data">
                        <h2>{{ $totalPersonas }}</h2>
                        <p>Personas Registradas</p>
                    </div>
                </div>
                <a href="{{ route('om-people.index') }}" class="main-button">
                    Administrar Personas
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- botones secundarios -->
        <div class="secondary-actions">
            <div class="action-buttons">
                <a href="{{ route('caregivers.index') }}" class="secondary-button">
                    <i class="fas fa-hands-helping"></i>
                    Cuidadores Registrados
                </a>
                <a href="{{ route('om-dwellings.index') }}" class="secondary-button">
                    <i class="fas fa-home"></i>
                    Viviendas Registradas
                </a>
                <a href="{{ route('disabilities.index') }}" class="secondary-button">
                    <i class="fas fa-wheelchair"></i>
                    Certificados de Discapacidad
                </a>
                <!-- Nuevo botón agregado -->
                <a href="{{ route('psychological-diagnoses.index') }}" class="secondary-button">
                    <i class="fas fa-brain"></i>
                    Diagnósticos Psicológicos
                </a>
            </div>
        </div>
        <!-- Grid de métricas -->
        <div class="metric-grid">
            <!-- Columna 1 -->
            <div class="metric-column">
                <div class="metric-card danger">
                    <h3>Discapacidades</h3>
                    <div class="metric-chart-container">
                        <canvas id="discapacidadChart"></canvas>
                    </div>
                    <div class="metric-stats">
                        <div class="stat-item">
                            <span class="badge leve">Leve</span>
                            <span class="count">{{ $discapacidad['leve'] }}</span>
                        </div>
                        <div class="stat-item">
                            <span class="badge moderado">Moderado</span>
                            <span class="count">{{ $discapacidad['moderado'] }}</span>
                        </div>
                        <div class="stat-item">
                            <span class="badge severo">Severo</span>
                            <span class="count">{{ $discapacidad['severo'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna 2 -->
            <div class="metric-column">
                <div class="metric-card warning">
                    <h3>Seguros Médicos</h3>
                    <div class="metric-chart-container">
                        <canvas id="segurosChart"></canvas>
                    </div>
                    <div class="metric-stats">
                        @foreach (['SIS', 'EsSalud', 'Seguro Privado', 'Ninguno'] as $seguro)
                            <div class="stat-item">
                                <span class="badge">{{ $seguro }}</span>
                                <span class="count">{{ $seguros[$seguro] ?? 0 }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @php
            $totalGeneros = $generos['Masculino'] + $generos['Femenino'];
            $porcMasculino = $totalGeneros > 0 ? ($generos['Masculino'] / $totalGeneros) * 100 : 0;
            $porcFemenino = $totalGeneros > 0 ? ($generos['Femenino'] / $totalGeneros) * 100 : 0;
        @endphp
        <div class="metric-card info">
            <h3>Distribución por Género</h3>
            <div class="metric-chart-container" style="height: 250px; width: 100%;">
                <canvas id="generoChart"></canvas>
            </div>
            <div class="metric-stats">
                <table class="table-data">
                    <thead>
                        <tr>
                            <th>Género</th>
                            <th>Cantidad</th>
                            <th>Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="fas fa-mars"></i> Masculino</td>
                            <td>{{ $generos['Masculino'] ?? 0 }}</td>
                            <td>{{ number_format($porcMasculino, 1) }}%</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-venus"></i> Femenino</td>
                            <td>{{ $generos['Femenino'] ?? 0 }}</td>
                            <td>{{ number_format($porcFemenino, 1) }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <style>
        :root {
            --primary-red: #FF3B30;
            --dark-red: #930813;
            --accent: #FF9F0A;
            --gradient-red: linear-gradient(135deg, var(--primary-red), var(--dark-red));
        }

        .dashboard-banner {
            margin-bottom: 2rem;
            position: relative;
        }

        .municipal-banner {
            background: var(--gradient-red);
            border-radius: 0 0 30px 30px;
            padding: 1rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(147, 8, 19, 0.3);
        }

        .municipal-logo {
            height: 100px;
            filter: drop-shadow(0 2px 5px rgba(0, 0, 0, 0.3));
        }

        .dashboard-title {
            text-align: center;
            margin: 2rem 0;
        }

        .title-gradient {
            background: var(--gradient-red);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2.5rem;
            font-weight: 800;
        }

        .title-line {
            width: 100px;
            height: 4px;
            background: var(--accent);
            margin: 0.5rem auto;
            border-radius: 2px;
        }

        .main-metric {
            margin-bottom: 2rem;
        }

        .main-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(147, 8, 19, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .metric-content {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .metric-content i {
            font-size: 3.5rem;
            color: var(--primary-red);
        }

        .metric-data h2 {
            font-size: 3rem;
            margin: 0;
            color: var(--dark-red);
        }

        .main-button {
            background: var(--gradient-red);
            color: white;
            padding: 1rem 2rem;
            border-radius: 10px;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .main-button:hover {
            transform: translateY(-3px);
            color: white;
        }

        .metric-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .metric-card {
            padding: 1rem;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .metric-card h3 {
            color: var(--dark-red);
            margin-bottom: 1rem;
        }

        .metric-chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem;
            margin: 0.5rem 0;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .badge {
            background: var(--accent);
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .table-data {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .table-data th,
        .table-data td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .table-data th {
            background: #e6e6e6;
        }

        .table-data tr:hover {
            background: #f1f1f1;
        }

        .secondary-actions {
            margin: 2rem 0;
        }

        .action-buttons {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .secondary-button {
            background: linear-gradient(135deg, #FF9F0A, #FF6B00);
            color: #fff !important;
            padding: 1.2rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            box-shadow: 0 4px 15px rgba(255, 107, 0, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.1);
            min-width: 280px;
            justify-content: center;
        }

        .secondary-button i {
            font-size: 1.4rem;
            transition: transform 0.3s ease;
        }

        .secondary-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 107, 0, 0.3);
            background: linear-gradient(135deg, #FF6B00, #FF9F0A);
        }

        .secondary-button:hover i {
            transform: scale(1.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }

            .secondary-button {
                width: 100%;
                min-width: auto;
            }
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        // Debug: Verificar datos
        console.log('Datos Discapacidad:', @json($discapacidad));
        console.log('Datos Seguros:', @json($seguros));
        console.log('Datos Género:', @json($generos));

        // Configuración común
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        };

        // Gráfico de Discapacidad
        new Chart(document.getElementById('discapacidadChart'), {
            type: 'pie',
            data: {
                labels: ['Leve', 'Moderado', 'Severo'],
                datasets: [{
                    data: [
                        {{ $discapacidad['leve'] ?? 0 }},
                        {{ $discapacidad['moderado'] ?? 0 }},
                        {{ $discapacidad['severo'] ?? 0 }}
                    ],
                    backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384']
                }]
            },
            options: chartOptions
        });

        // Gráfico de Seguros
        document.addEventListener("DOMContentLoaded", function() {
            const labels = {!! json_encode(['SIS', 'EsSalud', 'Seguro Privado', 'Ninguno']) !!};
            const dataValues = [
                {{ $seguros['SIS'] ?? 0 }},
                {{ $seguros['EsSalud'] ?? 0 }},
                {{ $seguros['Seguro Privado'] ?? 0 }},
                {{ $seguros['Ninguno'] ?? 0 }}
            ];
            const backgroundColors = ['#3498db', '#2ecc71', '#f39c12', '#e74c3c']; // Colores personalizados
            const borderColors = ['#217dbb', '#27ae60', '#e67e22', '#c0392b'];

            new Chart(document.getElementById('segurosChart'), {
                type: 'bar',
                data: {
                    labels: labels, // Asegura que cada categoría esté bien colocada
                    datasets: [{
                        label: 'Cantidad',
                        data: dataValues,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: {
                                color: '#333', // Color del texto de las categorías
                                font: {
                                    weight: 'bold',
                                    size: 12
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return labels[tooltipItem.dataIndex] + ': ' + tooltipItem.raw;
                                }
                            }
                        },
                        datalabels: {
                            color: '#333',
                            anchor: 'end',
                            align: 'top',
                            font: {
                                weight: 'bold',
                                size: 12
                            },
                            formatter: function(value) {
                                return value; // Muestra el valor encima de cada barra
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Para etiquetas en las barras
            });
        });
    </script>

    <canvas id="generoChart"></canvas>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('generoChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Masculino', 'Femenino'],
                    datasets: [{
                            label: 'Porcentaje',
                            data: [{{ $porcMasculino }}, {{ $porcFemenino }}],
                            backgroundColor: ['#3498db', '#ff69b4'], // Azul y Rosado
                            borderColor: ['#217dbb', '#d63f82'],
                            borderWidth: 1,
                            barPercentage: 0.5,
                            yAxisID: 'y-percentage'
                        },
                        {
                            label: 'Cantidad',
                            data: [{{ $generos['Masculino'] }}, {{ $generos['Femenino'] }}],
                            backgroundColor: ['#2980b9', '#ff4081'], // Azul oscuro y Rosado oscuro
                            borderColor: ['#1f618d', '#d6306d'],
                            borderWidth: 1,
                            barPercentage: 0.5,
                            yAxisID: 'y-count'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    let datasetLabel = tooltipItem.dataset.label || '';
                                    let value = tooltipItem.raw;
                                    return datasetLabel + ': ' + value + (datasetLabel ===
                                        'Porcentaje' ? '%' : '');
                                }
                            }
                        },
                        datalabels: {
                            color: '#333',
                            anchor: 'end',
                            align: 'top',
                            font: {
                                weight: 'bold',
                                size: 12
                            },
                            formatter: function(value, context) {
                                let datasetLabel = context.dataset.label;
                                return datasetLabel === 'Porcentaje' ? value.toFixed(1) + '%' : value;
                            }
                        }
                    },
                    scales: {
                        'y-percentage': {
                            type: 'linear',
                            position: 'left',
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        },
                        'y-count': {
                            type: 'linear',
                            position: 'right',
                            beginAtZero: true
                        }
                    }
                },
                plugins: [ChartDataLabels] // Agregar etiquetas dentro de las barras
            });
        });
    </script>
@stop
