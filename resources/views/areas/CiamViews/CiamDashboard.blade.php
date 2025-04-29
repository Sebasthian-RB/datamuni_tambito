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

                <!-- Contenedor de filtros (solo visible para Adultos por Edad) -->
                <div id="filtersContainer" class="d-none">
                    <!-- Controles para el gráfico de Adultos por Edad -->
                    <div class="row mb-3 mt-3">
                        <div class="col-md-4">
                            <label for="grouping">Agrupar por:</label>
                            <select id="grouping" class="form-control">
                                <option value="1">1 año</option>
                                <option value="5">5 años</option>
                                <option value="10">10 años</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="minAge">Edad Mínima:</label>
                            <input type="number" id="minAge" class="form-control" min="60" max="125" value="60">
                        </div>
                        <div class="col-md-4">
                            <label for="maxAge">Edad Máxima:</label>
                            <input type="number" id="maxAge" class="form-control" min="60" max="125" value="125">
                        </div>
                    </div>

                    <!-- Botón para aplicar los filtros -->
                    <button id="applyFilters" class="btn btn-primary mb-3">
                        <i class="fas fa-filter"></i> Aplicar Filtros
                    </button>
                </div>

                <!-- Contenedor para los gráficos -->
                <div class="col-lg-12">
                    <div class="mb-4 card">
                        <div class="card-body">
                            <!-- Gráfico actual -->
                            <div style="height: 400px;">
                                <canvas id="currentChart"></canvas>
                            </div>
                            
                            <!-- Botón para exportar la gráfica actual -->
                            <div class="text-center mt-3">
                                <button id="exportChart" class="btn btn-success">
                                    <i class="fas fa-download"></i> Exportar Gráfica Actual
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botón para exportar todas las gráficas (puede ir en otro lugar) -->
                <div class="col-lg-12 text-center mb-4">
                    <button id="exportAllCharts" class="btn btn-primary">
                        <i class="fas fa-file-archive"></i> Exportar Todas las Gráficas
                    </button>
                </div>

                
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
        background-color: #028a0f; /* Verde de CIAM */
        color: gold; /* Texto dorado */
        border: none;
        padding: 15px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px;
        border-radius: 5px;
        width: 250px; /* Ancho más grande */
        height: 100px; /* Altura reducida */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .btn-ciam:hover {
        background-color: #026a0b; /* Verde más oscuro al pasar el mouse */
    }

    /* Iconos dentro de los botones */
    .btn-ciam i {
        margin-bottom: 5px; /* Reducir separación entre icono y texto */
    }

    /* Espaciado para las flechas del carrusel */
    .carousel-control-prev, .carousel-control-next {
        width: 50px; /* Aumentar tamaño de las flechas */
        height: 50px;
        background-color: rgba(0, 0, 0, 0.3); /* Fondo semitransparente */
        border-radius: 50%;
        top: 50%; /* Centrar verticalmente */
        transform: translateY(-50%);
    }

    .carousel-control-prev {
        left: -25px; /* Ajustar posición de la flecha izquierda */
    }

    .carousel-control-next {
        right: -25px; /* Ajustar posición de la flecha derecha */
    }

    .carousel-control-prev-icon, .carousel-control-next-icon {
        width: 30px; /* Aumentar tamaño de los íconos de las flechas */
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
        let currentChartInstance = null;
        const filtersContainer = document.getElementById('filtersContainer');
        const exportChartBtn = document.getElementById('exportChart');

        // Función para mostrar/ocultar filtros
        function toggleFilters(show) {
            if (show) {
                filtersContainer.classList.remove('d-none');
                filtersContainer.classList.add('d-block');
            } else {
                filtersContainer.classList.remove('d-block');
                filtersContainer.classList.add('d-none');
            }
        }

        // FUNCIONES DE CADA GRAFICO 

        // GRAFICO NUMERO 01
        // Función para cargar el gráfico de Cantidad de Adultos por Edad
        function loadAdultsByAgeChart(grouping = 1, minAge = 60, maxAge = 125) {
            // Filtrar y agrupar datos
            let filteredData = @json($adultsByAge).filter(item => item.age >= minAge && item.age <= maxAge);

            let groupedData = {};
            filteredData.forEach(item => {
                let group = Math.floor(item.age / grouping) * grouping;
                if (!groupedData[group]) {
                    groupedData[group] = 0;
                }
                groupedData[group] += item.count;
            });

            // Preparar datos para el gráfico
            let labels = Object.keys(groupedData).map(group => `${group}-${parseInt(group) + grouping - 1}`);
            let data = Object.values(groupedData);

            // Datos del gráfico
            const adultsByAgeData = {
                labels: labels, // Etiquetas del gráfico
                datasets: [{
                    label: 'Cantidad de adultos',
                    data: data, // Cantidad de adultos por rango de edad
                    backgroundColor: 'rgba(120, 12, 41, 0.6)', // Color de fondo (#780c29 con opacidad)
                    borderColor: 'rgba(120, 12, 41, 1)', // Color del borde
                    borderWidth: 1 // Ancho del borde
                }]
            };

            // Configuración del gráfico
            const adultsByAgeConfig = {
                type: 'bar', // Tipo de gráfico (barras)
                data: adultsByAgeData,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Cantidad de Adultos por Edad', // Título de la gráfica
                            font: {
                                size: 18,
                                weight: 'bold'
                            },
                            padding: {
                                top: 10,
                                bottom: 20
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true, // Eje Y comienza en 0
                            ticks: {
                                stepSize: 1, // Asegura que el eje Y muestre solo números enteros
                                precision: 0  // Evita decimales en los valores del eje Y
                            }
                        }
                    },
                    responsive: true, // Hacer la gráfica responsive
                    maintainAspectRatio: false // No mantener el aspecto ratio para ajustarse al contenedor
                }
            };

            // Renderizar la gráfica
            if (currentChartInstance) {
                currentChartInstance.destroy(); // Destruir el gráfico anterior si existe
            }
            currentChartInstance = new Chart(document.getElementById('currentChart'), adultsByAgeConfig);
        }


        // GRAFICO NUMERO 02
        // Función mejorada para cargar el gráfico de Adultos por Enfermedad
        
        function loadAdultsByDisabilityChart() {
    // Filtrar datos para eliminar valores nulos o vacíos
    const disabilities = @json($adultsByDisability->filter(fn($item) => !empty($item->disability))->pluck('disability'));
    const counts = @json($adultsByDisability->filter(fn($item) => !empty($item->disability))->pluck('count'));
    
    // Configurar colores dinámicos
    const backgroundColors = disabilities.map((_, index) => {
        const hue = (index * 50) % 360; // Variar el tono para cada barra
        return `hsla(${hue}, 70%, 50%, 0.6)`;
    });

    const borderColors = disabilities.map((_, index) => {
        const hue = (index * 50) % 360;
        return `hsla(${hue}, 70%, 50%, 1)`;
    });

    // Datos del gráfico
    const chartData = {
        labels: disabilities,
        datasets: [{
            label: 'Cantidad de adultos',
            data: counts,
            backgroundColor: backgroundColors,
            borderColor: borderColors,
            borderWidth: 1
        }]
    };

    // Configuración del gráfico
    const config = {
        type: 'bar',
        data: chartData,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Cantidad de Adultos por Enfermedad',
                    font: {
                        size: 18,
                        weight: 'bold'
                    }
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                },
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    };

    // Renderizar el gráfico
    if (currentChartInstance) {
        currentChartInstance.destroy();
    }
    currentChartInstance = new Chart(document.getElementById('currentChart'), config);
}


function loadBirthdaysByMonthChart() {
    // Configuración de meses en español
    const monthNames = [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];
    
    // Procesar datos del servidor
    const serverData = @json($birthdaysByMonth);
    let counts = Array(12).fill(0);
    
    serverData.forEach(item => {
        if (item.month >= 1 && item.month <= 12) {
            counts[item.month - 1] = item.count;
        }
    });

    // Calcular total para el título
    const total = counts.reduce((sum, count) => sum + count, 0);

    // Configuración del gráfico
    const chartData = {
        labels: monthNames,
        datasets: [{
            label: 'Cantidad de Cumpleaños',
            data: counts,
            backgroundColor: 'rgba(75, 192, 192, 0.7)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            hoverBackgroundColor: 'rgba(75, 192, 192, 1)'
        }]
    };

    const config = {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: `Cumpleaños por Mes (Total: ${total})`,
                    font: {
                        size: 18,
                        weight: 'bold'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.raw} cumpleaños`;
                        }
                    }
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                },
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            }
        }
    };

    // Renderizar el gráfico
    if (currentChartInstance) {
        currentChartInstance.destroy();
    }
    currentChartInstance = new Chart(
        document.getElementById('currentChart'),
        config
    );
}

        // Función para cargar un gráfico genérico (placeholder para otros gráficos)
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

        // Evento para aplicar los filtros
        document.getElementById('applyFilters').addEventListener('click', function() {
            // Obtener valores de los filtros
            const grouping = parseInt(document.getElementById('grouping').value);
            const minAge = parseInt(document.getElementById('minAge').value);
            const maxAge = parseInt(document.getElementById('maxAge').value);

            // Cargar el gráfico con los nuevos filtros
            loadAdultsByAgeChart(grouping, minAge, maxAge);
        });

       // Modifica el evento de clic en los botones del dashboard
document.querySelectorAll('.dashboard-btn').forEach(button => {
    button.addEventListener('click', function() {
        const target = this.getAttribute('data-target');
        
        // Mostrar u ocultar filtros según el gráfico seleccionado
        if (target === 'adultsByAge') {
            toggleFilters(true);
        } else {
            toggleFilters(false);
        }

        // Cargar el gráfico correspondiente
        if (target === 'adultsByAge') {
            const grouping = parseInt(document.getElementById('grouping').value);
            const minAge = parseInt(document.getElementById('minAge').value);
            const maxAge = parseInt(document.getElementById('maxAge').value);
            loadAdultsByAgeChart(grouping, minAge, maxAge);
            
        } else if (target === 'adultsByDisability') {
            loadAdultsByDisabilityChart();
        } else if (target === 'birthdaysByMonth') {
            loadBirthdaysByMonthChart();
        } else if (target === 'adultsByState') {
            loadAdultsByStateChart();
        } else if (target === 'adultsBySex') {
            loadAdultsBySexChart();
        } else if (target === 'adultsBySocialProgram') {
            loadAdultsBySocialProgramChart();
        } else if (target === 'adultsByInsurance') {
            loadAdultsByInsuranceChart();
        }
    });
});

        // Evento para exportar la gráfica actual como PNG
        document.getElementById('exportChart').addEventListener('click', function() {
    if (currentChartInstance) {
        const chartCanvas = document.getElementById('currentChart');
        const chartImage = chartCanvas.toDataURL('image/png');
        
        // Obtener el título del gráfico actual para el nombre del archivo
        const chartTitle = currentChartInstance.options.plugins.title.text
            .toLowerCase()
            .replace(/ /g, '_') // Reemplazar espacios por guiones bajos
            .normalize("NFD").replace(/[\u0300-\u036f]/g, ""); // Eliminar acentos
        
        // Crear enlace de descarga
        const link = document.createElement('a');
        link.href = chartImage;
        link.download = `grafica_${chartTitle}.png`;
        link.click();
    }
});
        // Evento para exportar todas las gráficas
        document.getElementById('exportAllCharts').addEventListener('click', function() {
            alert('Exportar todas las gráficas (funcionalidad en desarrollo).');
        });

        // Cargar el primer gráfico por defecto
        loadAdultsByAgeChart();
    });
</script>
@stop