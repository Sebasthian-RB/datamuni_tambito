@extends('adminlte::page')

@section('title', 'PVL Estadísticas')

@section('content_header')
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <style>
        :root {
            --color-primary: #3B1E54;
            --color-secondary: #9B7EBD;
            --color-accent: #D4BEE4;
            --color-background: #EEEEEE;
            --color-gray: #6c757d; /* Color gris para el botón de Volver */
        }

        .card {
            border: 1px solid var(--color-accent);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: linear-gradient(135deg, var(--color-primary), #5A2E7A);
            color: white;
            padding: 1.25rem;
        }

        .stat-card {
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(212, 190, 228, 0.1);
        }

        .badge-primary {
            background-color: var(--color-primary);
        }

        .text-pvl-primary {
            color: var(--color-primary);
        }

        @media (max-width: 768px) {
            .chart-container {
                height: 200px;
            }
        }
    </style>

    <!-- Estilos para modal -->
    <style>
        /* Nuevos estilos para el botón y modal */
        .btn-pvl-gradient {
            background: linear-gradient(135deg, var(--color-accent), var(--color-secondary));
            color: white;
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 30, 84, 0.2);
        }

        .btn-pvl-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 30, 84, 0.3);
            color: white;
            background: linear-gradient(135deg, #5A2E7A, var(--color-primary));
        }

        .modal-header {
            background: linear-gradient(135deg, var(--color-primary), #5A2E7A);
            border-radius: 8px 8px 0 0;
        }

        .modal-content {
            border: 2px solid var(--color-accent);
            border-radius: 10px;
        }

        #committeeStats {
            transition: opacity 0.3s ease;
        }
    </style>

    <style>
        /* Estilos personalizados para Select2 */
        .select2-container--default .select2-selection--single {
            height: 45px !important;
            line-height: 45px !important;
            font-size: 16px !important;
            background-color: #ffffff !important;
            border: 2px solid #9B7EBD !important;
            border-radius: 12px !important;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1) !important;
        }

        .select2-container--default .select2-selection__rendered {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
            color: #3B1E54 !important;
        }

        .select2-dropdown {
            max-height: 300px !important;
            overflow-y: auto !important;
            background-color: #D4BEE4 !important;
            border: 2px solid #9B7EBD !important;
            border-radius: 12px !important;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1) !important;
        }

        .select2-results__option {
            padding: 10px !important;
            font-size: 16px !important;
            color: #3B1E54 !important;
        }

        .select2-results__option--highlighted {
            background-color: #9B7EBD !important;
            color: white !important;
        }

        /* Asegurar altura de los gráficos en el modal */
        #committeeAgeChart, #committeeConditionChart {
            height: 300px !important;
            width: 100% !important;
        }
        /* Estilos para los botones principales */
        .btn-main {
            display: inline-flex;
            align-items: center;
            justify-content: center; /* Centra el contenido */
            gap: 8px;
            padding: 12px 24px; /* Aumenté el padding para más espacio */
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            width: 100%; /* Ocupa el 100% del ancho en móviles */
            margin-top: 10px;
            margin-bottom: 10px; /* Separa los botones verticalmente */
        }

        .btn-secondary {
            background-color: var(--color-gray); /* Color gris para el botón de Volver */
            color: white;
        }

        .btn-main:hover {
            background-color: var(--color-primary); /* Mismo color para todos los hovers */
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
        }

        /* Estilos responsivos */
        @media (min-width: 768px) {
            .btn-main {
                width: auto; /* Ancho automático en pantallas grandes */
                margin-bottom: 0; /* Elimina el margen inferior */
                margin-right: 10px; /* Separa los botones horizontalmente */
            }
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Botón "Volver" -->
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3 mb-4">
        <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-secondary btn-main">
            <i class="fas fa-arrow-left me-2"></i> <!-- Ícono más grande y descriptivo -->
            <span>Volver</span>
        </a>
    </div>

    <!-- Encabezado -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-0">Programa Vaso de Leche</h2>
                    <p class="mb-0">Panel de gestión integral</p>
                </div>
                <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo" style="height: 50px;">
            </div>
        </div>
    </div>

    <!-- Botón para modal -->
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <button type="button" class="btn btn-block btn-pvl-gradient py-4" data-toggle="modal" data-target="#committeeModal">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-chart-bar fa-3x mr-3"></i>
                    <div class="text-left">
                        <div class="h5 mb-1">¿Desea ver estadísticas detalladas por comité?</div>
                        <div class="h3 font-weight-bold">Ver Información Específica</div>
                    </div>
                </div>
            </button>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="row">
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h5 class="text-muted">Beneficiarios Activos</h5>
                    <h2 class="text-pvl-primary">{{ $stats['activeMinors'] }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h5 class="text-muted">Apoderados/Socios Registrados</h5>
                    <h2 class="text-pvl-primary">{{ $stats['families'] }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h5 class="text-muted">Comités Activos</h5>
                    <h2 class="text-pvl-primary">{{ $stats['committees'] }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h5 class="text-muted">Productos</h5>
                    <h2 class="text-pvl-primary">{{ $stats['products'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Distribución por Sectores</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="sectorChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Distribución por Condición</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="conditionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Datos para Contraloría -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Beneficiarios por Condición</h5>
                </div>
                <div class="card-body">
                    <!-- Gráfico arriba -->
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="urbanConditionChart"></canvas>
                    </div>
                
                    <!-- Tabla debajo -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th rowspan="2" class="align-middle">Condición</th>
                                    <th colspan="2" class="text-center">Núcleo Urbano</th>
                                    <th rowspan="2" class="align-middle">Total</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Urbano</th>
                                    <th class="text-center">Rural</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $conditions = collect();
                                    foreach($chartData['urbanCoreConditions'] as $type => $items) {
                                        foreach($items as $item) {
                                            $conditions->push($item->condition);
                                        }
                                    }
                                    $conditions = $conditions->unique()->sort();
                                    
                                    $totalUrban = 0;
                                    $totalRural = 0;
                                @endphp
                                
                                @foreach($conditions as $condition)
                                    @php
                                        $urban = isset($chartData['urbanCoreConditions']['Urbano']) ? 
                                            collect($chartData['urbanCoreConditions']['Urbano'])->where('condition', $condition)->sum('total') : 0;
                                        $rural = isset($chartData['urbanCoreConditions']['Rural']) ? 
                                            collect($chartData['urbanCoreConditions']['Rural'])->where('condition', $condition)->sum('total') : 0;
                                        $total = $urban + $rural;
                                        
                                        $totalUrban += $urban;
                                        $totalRural += $rural;
                                    @endphp
                                    <tr>
                                        <td>{{ $condition }}</td>
                                        <td class="text-center">{{ $urban }}</td>
                                        <td class="text-center">{{ $rural }}</td>
                                        <td class="text-center font-weight-bold">{{ $total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-active">
                                    <th>Total General</th>
                                    <th class="text-center">{{ $totalUrban }}</th>
                                    <th class="text-center">{{ $totalRural }}</th>
                                    <th class="text-center">{{ $totalUrban + $totalRural }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Beneficiarios Elegibles en SISFOH</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="sisfohTable">
                            <thead class="thead-light">
                                <tr>
                                    <th rowspan="2" class="align-middle">Indicador</th>
                                    <th colspan="2" class="text-center">Beneficiarios</th>
                                    <th rowspan="2" class="align-middle">Total</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Antiguos</th>
                                    <th class="text-center">Nuevos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Fila 1: N° de atendidos -->
                                <tr>
                                    <td>N° de atendidos</td>
                                    <td class="text-center">{{ $sisfohStats['total']['antiguos'] }}</td>
                                    <td class="text-center">{{ $sisfohStats['total']['nuevos'] }}</td>
                                    <td class="text-center font-weight-bold">{{ $sisfohStats['total']['antiguos'] + $sisfohStats['total']['nuevos'] }}</td>
                                </tr>
                                
                                <!-- Fila 2: N° de beneficiarios con DNI -->
                                <tr>
                                    <td>N° de beneficiarios con DNI</td>
                                    <td class="text-center">{{ $sisfohStats['con_dni']['antiguos'] }}</td>
                                    <td class="text-center">{{ $sisfohStats['con_dni']['nuevos'] }}</td>
                                    <td class="text-center font-weight-bold">{{ $sisfohStats['con_dni']['antiguos'] + $sisfohStats['con_dni']['nuevos'] }}</td>
                                </tr>
                                
                                <!-- Fila 3: Valor porcentual (DNI) -->
                                <tr>
                                    <td>Valor porcentual (DNI)</td>
                                    <td class="text-center" id="porcDniAntiguos">0%</td>
                                    <td class="text-center" id="porcDniNuevos">0%</td>
                                    <td class="text-center font-weight-bold" id="porcDniTotal">0%</td>
                                </tr>
                                
                                <!-- Fila 4: N° de beneficiarios con clasificación socioeconómica -->
                                <tr>
                                    <td>N° con clasificación socioeconómica</td>
                                    <td class="text-center">{{ $sisfohStats['con_sisfoh']['antiguos'] }}</td>
                                    <td class="text-center">{{ $sisfohStats['con_sisfoh']['nuevos'] }}</td>
                                    <td class="text-center font-weight-bold">{{ $sisfohStats['con_sisfoh']['antiguos'] + $sisfohStats['con_sisfoh']['nuevos'] }}</td>
                                </tr>
                                
                                <!-- Fila 5: Valor porcentual (SISFOH) -->
                                <tr>
                                    <td>Valor porcentual (SISFOH)</td>
                                    <td class="text-center" id="porcSisfohAntiguos">0%</td>
                                    <td class="text-center" id="porcSisfohNuevos">0%</td>
                                    <td class="text-center font-weight-bold" id="porcSisfohTotal">0%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="chart-container">
                                <div class="col-md-10">
                                    <p style="text-align: center; 
                                                font-size: 1rem; 
                                                font-weight: 600; 
                                                color: #3B1E54;
                                                margin-bottom: 0.1rem;
                                                padding-top: 0.5rem;
                                                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                        Total de Benef. con DNI (%)
                                    </p>
                                </div>
                                <canvas id="dniDoughnutChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="chart-container">
                                <div class="col-md-11">
                                    <p style="text-align: center; 
                                                font-size: 1rem; 
                                                font-weight: 600; 
                                                color: #3B1E54;
                                                margin-bottom: 0.1rem;
                                                padding-top: 0.5rem;
                                                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                        Total de Beneficiarios con SISFOH (%)
                                    </p>
                                </div>
                                <canvas id="sisfohDoughnutChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tablas recientes -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Últimos Beneficiarios</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Edad</th>
                                    <th>Sector</th>
                                    <th>Condición</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestRecords['minors'] as $minor)
                                <tr>
                                    <td>{{ $minor->given_name }} {{ $minor->paternal_last_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($minor->birth_date)->age }}</td>
                                    <td>
                                        @if($minor->vlFamilyMember && $minor->vlFamilyMember->committees->isNotEmpty())
                                            {{ $minor->vlFamilyMember->committees->first()->sector->name }}
                                        @else
                                            <span class="text-muted">Sin asignar</span>
                                        @endif
                                    </td>
                                    <td><span class="badge badge-primary">{{ $minor->condition }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Últimos Cambios</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Familiar</th>
                                    <th>Comité</th>
                                    <th>Sector</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestRecords['committeeChanges'] as $change)
                                <tr>
                                    <!-- Verificación en cadena completa -->
                                    <td>{{ $change->vlFamilyMember?->id ?? 'N/A' }}</td>
                                    <td>{{ $change->committee?->name ?? 'Comité no encontrado' }}</td>
                                    <td>{{ $change->committee?->sector?->name ?? 'Sector no asignado' }}</td>
                                    <td>{{ $change->change_date->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para selección de comité -->
<div class="modal fade" id="committeeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-chart-pie mr-2"></i>Estadísticas del Comité
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select class="form-control select2-committee" id="committeeSelect">
                        <option value=""></option>
                        @foreach($committees as $committee)
                        <option value="{{ $committee->id }}">
                            {{ $committee->name }} - {{ $committee->sector->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                <div id="committeeStats" class="d-none">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card stat-card">
                                <div class="card-body text-center">
                                    <h5 class="text-muted">Beneficiarios Activos</h5>
                                    <h2 class="text-pvl-primary" id="statsBeneficiarios">0</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card stat-card">
                                <div class="card-body text-center">
                                    <h5 class="text-muted">Miembros Registrados</h5>
                                    <h2 class="text-pvl-primary" id="statsMiembros">0</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card stat-card">
                                <div class="card-body text-center">
                                    <h5 class="text-muted">Proporción por Edad</h5>
                                    <h4 class="text-pvl-primary" id="statsProporcion">0% / 0%</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="committeeAgeChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="committeeConditionChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de sectores
    new Chart(document.getElementById('sectorChart'), {
        type: 'bar',
        data: {
            labels: @json($chartData['sectors']),
            datasets: [{
                label: 'Beneficiarios',
                data: @json($chartData['sectorCounts']),
                backgroundColor: '#3B1E54',
                borderColor: '#5A2E7A',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Gráfico de condiciones
    new Chart(document.getElementById('conditionChart'), {
        type: 'doughnut',
        data: {
            labels: @json($chartData['conditions']->pluck('condition')),
            datasets: [{
                data: @json($chartData['conditions']->pluck('total')),
                backgroundColor: ['#3B1E54', '#9B7EBD', '#D4BEE4']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' }
            }
        }
    });

    // Nuevo gráfico de condiciones por núcleo urbano
    document.addEventListener('DOMContentLoaded', function() {
        // Preparar datos para el gráfico apilado
        const conditions = @json($chartData['conditions']->pluck('condition'));
        const urbanData = [];
        const ruralData = [];
        
        // Obtener datos urbanos y rurales para cada condición
        conditions.forEach(condition => {
            let urbanCount = 0;
            let ruralCount = 0;
            
            if(@json(isset($chartData['urbanCoreConditions']['Urbano']))) {
                const urban = @json($chartData['urbanCoreConditions']['Urbano'] ?? []);
                urbanCount = urban.filter(item => item.condition === condition)
                                .reduce((sum, item) => sum + item.total, 0);
            }
            
            if(@json(isset($chartData['urbanCoreConditions']['Rural']))) {
                const rural = @json($chartData['urbanCoreConditions']['Rural'] ?? []);
                ruralCount = rural.filter(item => item.condition === condition)
                                .reduce((sum, item) => sum + item.total, 0);
            }
            
            urbanData.push(urbanCount);
            ruralData.push(ruralCount);
        });

        // Crear gráfico de barras apiladas
        new Chart(document.getElementById('urbanConditionChart'), {
            type: 'bar',
            data: {
                labels: conditions,
                datasets: [
                    {
                        label: 'Urbano',
                        data: urbanData,
                        backgroundColor: '#3B1E54',
                        borderColor: '#3B1E54',
                        borderWidth: 1
                    },
                    {
                        label: 'Rural',
                        data: ruralData,
                        backgroundColor: '#9B7EBD',
                        borderColor: '#9B7EBD',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true,
                        ticks: { color: '#3B1E54' }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        ticks: { color: '#3B1E54' }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { color: '#3B1E54' }
                    },
                    tooltip: {
                        callbacks: {
                            afterBody: function(context) {
                                const total = context[0].parsed._stacks.y[context[0].datasetIndex];
                                return `Total: ${total}`;
                            }
                        }
                    }
                }
            }
        });

        // Calcular y mostrar porcentajes SISFOH
        function calculatePercentages() {
            try {
                // Datos desde PHP
                const stats = @json($sisfohStats);
                console.log('Datos SISFOH:', stats); // Para depuración
                
                // Calcular totales
                const totalAntiguos = stats.total.antiguos;
                const totalNuevos = stats.total.nuevos;
                const totalGeneral = totalAntiguos + totalNuevos;
                
                // Función auxiliar para calcular porcentajes seguros
                const safePercentage = (part, total) => {
                    if (total <= 0) return 0;
                    const percentage = (part / total) * 100;
                    return Math.round(percentage * 10) / 10; // Redondea a 1 decimal
                };
                
                // Porcentajes DNI
                const porcDniAntiguos = safePercentage(stats.con_dni.antiguos, totalAntiguos);
                const porcDniNuevos = safePercentage(stats.con_dni.nuevos, totalNuevos);
                const porcDniTotal = safePercentage(
                    (stats.con_dni.antiguos + stats.con_dni.nuevos), 
                    totalGeneral
                );
                
                // Porcentajes SISFOH
                const porcSisfohAntiguos = safePercentage(stats.con_sisfoh.antiguos, totalAntiguos);
                const porcSisfohNuevos = safePercentage(stats.con_sisfoh.nuevos, totalNuevos);
                const porcSisfohTotal = safePercentage(
                    (stats.con_sisfoh.antiguos + stats.con_sisfoh.nuevos), 
                    totalGeneral
                );
                
                // Actualizar DOM
                const updateElement = (id, value) => {
                    const element = document.getElementById(id);
                    if (element) element.textContent = `${value}%`;
                };
                
                updateElement('porcDniAntiguos', porcDniAntiguos);
                updateElement('porcDniNuevos', porcDniNuevos);
                updateElement('porcDniTotal', porcDniTotal);
                
                updateElement('porcSisfohAntiguos', porcSisfohAntiguos);
                updateElement('porcSisfohNuevos', porcSisfohNuevos);
                updateElement('porcSisfohTotal', porcSisfohTotal);
                
            } catch (error) {
                console.error('Error al calcular porcentajes:', error);
            }
        }

        // Función para crear los gráficos de dona
        function createDoughnutCharts() {
            try {
                // Obtener valores porcentuales del DOM
                const getPercentageValue = (id) => {
                    const element = document.getElementById(id);
                    return element ? parseFloat(element.textContent.replace('%', '')) : 0;
                };

                // Configuración común para los gráficos de dona
                const doughnutOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                color: '#3B1E54',
                                font: {
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw}%`;
                                }
                            }
                        }
                    }
                };

                // Gráfico de DNI (Dona)
                new Chart(document.getElementById('dniDoughnutChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Con DNI', 'Sin DNI'],
                        datasets: [{
                            data: [
                                getPercentageValue('porcDniTotal'),
                                100 - getPercentageValue('porcDniTotal')
                            ],
                            backgroundColor: [
                                'rgba(59, 30, 84, 0.8)',
                                'rgba(212, 190, 228, 0.8)'
                            ],
                            borderColor: [
                                'rgba(59, 30, 84, 1)',
                                'rgba(212, 190, 228, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: doughnutOptions
                });

                // Gráfico de SISFOH (Dona)
                new Chart(document.getElementById('sisfohDoughnutChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['En SISFOH', 'No en SISFOH'],
                        datasets: [{
                            data: [
                                getPercentageValue('porcSisfohTotal'),
                                100 - getPercentageValue('porcSisfohTotal')
                            ],
                            backgroundColor: [
                                'rgba(155, 126, 189, 0.8)',
                                'rgba(228, 218, 238, 0.8)'
                            ],
                            borderColor: [
                                'rgba(155, 126, 189, 1)',
                                'rgba(228, 218, 238, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: doughnutOptions
                });

            } catch (error) {
                console.error('Error al crear gráficos de dona:', error);
            }
        }

        calculatePercentages();
        createDoughnutCharts();        
    });
</script>

<!-- Script para Modal -->
<script>
    let ageChart = null;
    let conditionChart = null;

    $(document).ready(function() {
        // Inicializar Select2 con configuración extendida
        $('.select2-committee').select2({
            placeholder: "Seleccione un comité",
            allowClear: true,
            dropdownParent: $('#committeeModal'),
            templateResult: formatCommittee,
            templateSelection: formatCommittee
        });

        function formatCommittee(committee) {
            if (!committee.id) return committee.text;
            return $('<div class="d-flex align-items-center">')
                .append($('<div class="select2-committee-text">').text(committee.text));
        }

        // Manejar cambio de selección
        $('#committeeSelect').on('change', function() {
            const committeeId = $(this).val();
            
            if(committeeId) {
                $.ajax({
                    url: window.location.href,
                    method: 'GET',
                    data: { committee_id: committeeId },
                    success: function(response) {
                        $('#committeeStats').removeClass('d-none');
                        
                        // Actualizar estadísticas
                        updateStats(response);
                        
                        // Actualizar gráficos
                        updateCharts(response);
                    },
                    error: function() {
                        alert('Error al cargar datos del comité');
                    }
                });
            } else {
                $('#committeeStats').addClass('d-none');
                destroyCharts();
            }
        });

        // Configuración inicial de gráficos vacíos
        initializeEmptyCharts();
    });

    function updateStats(data) {
        $('#statsBeneficiarios').text(data.total_beneficiarios);
        $('#statsMiembros').text(data.total_miembros);
        
        const total = data.age_distribution.under7 + data.age_distribution.over7;
        const under7Percent = total > 0 ? Math.round((data.age_distribution.under7 / total) * 100) : 0;
        const over7Percent = total > 0 ? Math.round((data.age_distribution.over7 / total) * 100) : 0;
        $('#statsProporcion').text(`${under7Percent}% / ${over7Percent}%`);
    }

    function updateCharts(data) {
        destroyCharts();
        
        // Gráfico de Edades
        ageChart = new Chart(document.getElementById('committeeAgeChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Menores de 7 años', '7 años o más'],
                datasets: [{
                    label: 'Distribución por Edad',
                    data: [data.age_distribution.under7, data.age_distribution.over7],
                    backgroundColor: ['#3B1E54', '#9B7EBD'],
                    borderColor: ['#3B1E54', '#9B7EBD'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#3B1E54' }
                    },
                    x: {
                        ticks: { color: '#3B1E54' }
                    }
                }
            }
        });

        // Gráfico de Condiciones
        conditionChart = new Chart(document.getElementById('committeeConditionChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(data.condition_distribution),
                datasets: [{
                    data: Object.values(data.condition_distribution),
                    backgroundColor: ['#3B1E54', '#9B7EBD', '#D4BEE4'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { color: '#3B1E54' }
                    }
                }
            }
        });
    }

    function destroyCharts() {
        if(ageChart) { ageChart.destroy(); ageChart = null; }
        if(conditionChart) { conditionChart.destroy(); conditionChart = null; }
    }

    function initializeEmptyCharts() {
        // Inicializar gráficos con datos vacíos
        ageChart = new Chart(document.getElementById('committeeAgeChart').getContext('2d'), {
            type: 'bar',
            data: { labels: [], datasets: [] },
            options: { responsive: true }
        });

        conditionChart = new Chart(document.getElementById('committeeConditionChart').getContext('2d'), {
            type: 'doughnut',
            data: { labels: [], datasets: [] },
            options: { responsive: true }
        });
    }
</script>
@endsection