@extends('adminlte::page')

@section('title', 'Dashboard CIAM')

@section('content_header')
<div class="px-4 py-3 d-flex justify-content-between align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
    <h3 style="color: gold; font-weight: bold; margin: 0;">Dashboard CIAM</h3>
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Logo Visita" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')
<div class="row">
    <!-- Carrusel de Dashboards -->
    <div class="col-lg-12">
        <div class="mb-4 card">
            <div class="card-header" style="background-color: #028a0f;">
                <h5 style="color: gold;">Selecciona un Dashboard</h5>
            </div>
            <div class="card-body" style="background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 5px;">
                <!-- Carrusel de Bootstrap -->
                <div id="dashboardCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Controles del carrusel (flechas) -->
                    <div class="carousel-inner">
                        <!-- Primer grupo de botones -->
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-around">
                                <button class="btn btn-ciam dashboard-btn" data-target="adultsByAge">
                                    <i class="fas fa-user-friends fa-2x"></i><br>
                                    Adultos por Edad
                                </button>
                                <button class="btn btn-ciam dashboard-btn" data-target="adultsByDisability">
                                    <i class="fas fa-wheelchair fa-2x"></i><br>
                                    Adultos por Enfermedad
                                </button>
                                <button class="btn btn-ciam dashboard-btn" data-target="birthdaysByMonth">
                                    <i class="fas fa-birthday-cake fa-2x"></i><br>
                                    Cumpleaños por Mes
                                </button>
                            </div>
                        </div>
                        <!-- Segundo grupo de botones -->
                        <div class="carousel-item">
                            <div class="d-flex justify-content-around">
                                <button class="btn btn-ciam dashboard-btn" data-target="adultsByState">
                                    <i class="fas fa-toggle-on fa-2x"></i><br>
                                    Adultos Activos/No Activos
                                </button>
                                <button class="btn btn-ciam dashboard-btn" data-target="adultsBySex">
                                    <i class="fas fa-venus-mars fa-2x"></i><br>
                                    Adultos por Sexo
                                </button>
                                <button class="btn btn-ciam dashboard-btn" data-target="adultsBySocialProgram">
                                    <i class="fas fa-hand-holding-heart fa-2x"></i><br>
                                    Adultos por Programa Social
                                </button>
                            </div>
                        </div>
                        <!-- Tercer grupo de botones -->
                        <div class="carousel-item">
                            <div class="d-flex justify-content-around">
                                <button class="btn btn-ciam dashboard-btn" data-target="adultsByInsurance">
                                    <i class="fas fa-shield-alt fa-2x"></i><br>
                                    Adultos por Tipo de Seguro
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Flechas de navegación -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>

                <!-- Botón para exportar todas las gráficas -->
                <button id="exportAllCharts" class="btn btn-success mt-3">
                    <i class="fas fa-download"></i> Exportar Todas las Gráficas
                </button>
            </div>
        </div>
    </div>

    <!-- Contenedor para los gráficos -->
    <div class="col-lg-12">
        <div class="mb-4 card">
            <div class="card-body">
                <!-- Gráfico actual -->
                <canvas id="currentChart"></canvas>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<!-- Estilos personalizados -->
<style>
    /* Estilo para los botones del carrusel */
    .btn-ciam {
        background-color: #028a0f;
        /* Verde de CIAM */
        color: gold;
        /* Texto dorado */
        border: none;
        padding: 15px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px;
        border-radius: 5px;
        width: 250px;
        /* Ancho más grande */
        height: 100px;
        /* Altura reducida */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .btn-ciam:hover {
        background-color: #026a0b;
        /* Verde más oscuro al pasar el mouse */
    }

    /* Iconos dentro de los botones */
    .btn-ciam i {
        margin-bottom: 5px;
        /* Reducir separación entre icono y texto */
    }

    /* Espaciado para las flechas del carrusel */
    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        /* Aumentar tamaño de las flechas */
        height: 50px;
        background-color: rgba(0, 0, 0, 0.3);
        /* Fondo semitransparente */
        border-radius: 50%;
        top: 50%;
        /* Centrar verticalmente */
        transform: translateY(-50%);
    }

    .carousel-control-prev {
        left: -25px;
        /* Ajustar posición de la flecha izquierda */
    }

    .carousel-control-next {
        right: -25px;
        /* Ajustar posición de la flecha derecha */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 30px;
        /* Aumentar tamaño de los íconos de las flechas */
        height: 30px;
    }
</style>
@stop

@section('js')
<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Incluir Bootstrap JS (necesario para el carrusel) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Incluir FontAwesome para los iconos -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables globales
        let currentChartInstance = null; // Instancia del gráfico actual

        // Función para cargar un gráfico
        function loadChart(target) {
            // Destruir el gráfico actual si existe
            if (currentChartInstance) {
                currentChartInstance.destroy();
            }

            // Crear un nuevo gráfico según el target seleccionado
            const ctx = document.getElementById('currentChart').getContext('2d');
            currentChartInstance = new Chart(ctx, {
                type: 'bar', // Tipo de gráfico (puedes cambiarlo según el dashboard)
                data: {
                    labels: [], // Etiquetas del gráfico
                    datasets: [{
                        label: 'Datos', // Etiqueta del dataset
                        data: [], // Datos del gráfico
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color de fondo
                        borderColor: 'rgba(75, 192, 192, 1)', // Color del borde
                        borderWidth: 1 // Ancho del borde
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
        }

        // Evento para cambiar de gráfico al hacer clic en un botón
        document.querySelectorAll('.dashboard-btn').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                loadChart(target);
            });
        });

        // Evento para exportar todas las gráficas
        document.getElementById('exportAllCharts').addEventListener('click', function() {
            alert('Exportar todas las gráficas (funcionalidad en desarrollo).');
        });

        // Cargar el primer gráfico por defecto
        loadChart('adultsByAge');
    });
</script>
@stop