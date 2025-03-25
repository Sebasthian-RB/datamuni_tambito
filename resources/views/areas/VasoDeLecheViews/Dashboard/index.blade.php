@extends('adminlte::page')

@section('title', 'PVL Estadísticas')

@section('content_header')
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        :root {
            --color-primary: #3B1E54;
            --color-secondary: #9B7EBD;
            --color-accent: #D4BEE4;
            --color-background: #EEEEEE;
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

        @media (max-width: 768px) {
            .chart-container {
                height: 200px;
            }
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Encabezado -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-0">Programa Vaso de Leche</h2>
                    <p class="mb-0">Panel de gestión integral</p>
                </div>
                <img src="{{ asset('img/logo-municipalidad.png') }}" alt="Logo" style="height: 50px;">
            </div>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="row">
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h5 class="text-muted">Beneficiarios Activos</h5>
                    <h2 class="text-primary">{{ $stats['activeMinors'] }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h5 class="text-muted">Familias Registradas</h5>
                    <h2 class="text-secondary">{{ $stats['families'] }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h5 class="text-muted">Comités Activos</h5>
                    <h2 class="text-success">{{ $stats['committees'] }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h5 class="text-muted">Productos</h5>
                    <h2 class="text-info">{{ $stats['products'] }}</h2>
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
                                    <td>{{ $change->familyMember?->given_name ?? 'N/A' }}</td>
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
@endsection

@section('js')
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
</script>
@endsection