<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Municipalidad de El Tambo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --azul-municipal: #005293;
            --dorado-institucional: #E1AD01;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            min-height: 100vh;
        }

        .contact-section {
            padding: 4rem 0;
        }

        .section-header {
            position: relative;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            color: var(--azul-municipal);
            position: relative;
            display: inline-block;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--dorado-institucional);
        }

        .contact-card {
            background: #fff;
            border-radius: 15px;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 82, 147, 0.1);
            height: 100%;
        }

        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .contact-icon {
            width: 80px;
            height: 80px;
            background: rgba(0, 82, 147, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .contact-icon i {
            color: var(--azul-municipal);
            font-size: 2rem;
        }

        .schedule-card {
            background: var(--azul-municipal);
            color: white;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
        }

        .schedule-card::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .map-container {
            border: 3px solid var(--dorado-institucional);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .whatsapp-btn {
            position: fixed;
            bottom: 30px;
            left: 30px;
            z-index: 1000;
            background: #25D366;
            color: white !important;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
            transition: all 0.3s ease;
        }

        .whatsapp-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(37, 211, 102, 0.4);
        }
    </style>
</head>

<body>

    <!-- Contenido de contacto (el mismo que proporcioné anteriormente) -->
    <section class="contact-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="display-4 fw-bold text-primary mb-3">Contáctenos</h2>
                <p class="lead text-muted">Estamos aquí para ayudarle</p>
            </div>

            <div class="row g-5">
                <!-- Tarjetas de Información -->
                <div class="col-lg-4">
                    <div class="contact-card shadow-lg rounded-4 p-4 h-100">
                        <div class="contact-icon mb-4">
                            <i class="fas fa-map-marker-alt fa-3x text-primary"></i>
                        </div>
                        <h3 class="h4 fw-bold text-dark mb-3">Oficina Principal</h3>
                        <p class="text-secondary mb-0">
                            4to piso (Licenciado paul)<br>
                            El Tambo, Junín<br>
                            Perú
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="contact-card shadow-lg rounded-4 p-4 h-100">
                        <div class="contact-icon mb-4">
                            <i class="fas fa-phone-alt fa-3x text-primary"></i>
                        </div>
                        <h3 class="h4 fw-bold text-dark mb-3">Teléfonos</h3>
                        <ul class="list-unstyled text-secondary">
                            <li class="mb-2">
                                <i class="fas fa-phone-volume me-2 text-primary"></i>
                                +51 946 223 666
                            </li>
                            <li class="mb-2">
                                <i class="fab fa-whatsapp me-2 text-success"></i>
                                +51 964 605 500
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="contact-card shadow-lg rounded-4 p-4 h-100">
                        <div class="contact-icon mb-4">
                            <i class="fas fa-envelope fa-3x text-primary"></i>
                        </div>
                        <h3 class="h4 fw-bold text-dark mb-3">Correos Electrónicos</h3>
                        <ul class="list-unstyled text-secondary">
                            <li class="mb-2">
                                <i class="fas fa-inbox me-2 text-primary"></i>
                                72695645@continental.edu.pe
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-headset me-2 text-primary"></i>
                                75707785@continental.edu.pe
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Horario de Atención -->
            <div class="row mt-5">
                <div class="col-md-8 mx-auto">
                    <div class="schedule-card bg-primary text-white rounded-4 p-4 shadow-lg">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-clock fa-2x me-3"></i>
                            <h3 class="h4 mb-0">Horario de Atención</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1">Lunes a Viernes: 8:00 AM - 5:00 PM</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1">Sábados: 8:00 AM - 1:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mapa -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="map-container rounded-4 shadow-lg overflow-hidden">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15597.61189708632!2d-75.223851!3d-12.067083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x910e9642f3f5d3f3%3A0xa2cb0788d6e9cf9c!2sEl%20Tambo!5e0!3m2!1ses-419!2spe!4v1718175045813!5m2!1ses-419!2spe"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Scripts necesarios -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Inicializar tooltips de Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        })
    </script>

</body>

</html>



<style>
    .contact-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .contact-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0, 82, 147, 0.1);
        background: white;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .contact-icon {
        opacity: 0.9;
        transition: opacity 0.3s ease;
    }

    .contact-card:hover .contact-icon {
        opacity: 1;
    }

    .schedule-card {
        background: #005293;
        position: relative;
        overflow: hidden;
    }

    .schedule-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .map-container {
        position: relative;
        border: 2px solid #E1AD01;
        border-radius: 15px;
    }

    .text-primary {
        color: #005293 !important;
    }

    .bg-primary {
        background-color: #005293 !important;
    }
</style>
