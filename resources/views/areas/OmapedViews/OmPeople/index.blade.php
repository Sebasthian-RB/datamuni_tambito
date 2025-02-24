@extends('adminlte::page')

@section('title', 'Listado de Personas')

@section('content_header')
    <div class="header-section">
        <div class="municipal-banner animate__animated animate__fadeInDown">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="municipal-logo">
            <div class="banner-overlay"></div>
        </div>
    </div>
@stop

@section('content')
    <!-- Notificaciones flotantes -->
    @if (session('success'))
        <div class="floating-alert animate__animated animate__slideInRight">
            <div class="alert-content">
                <i class="fas fa-check-circle alert-icon"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="container-fluid px-lg-4">
        <h1 class="main-title animate__animated animate__fadeIn">
            <span class="title-text">Gestión de Personas</span>
            <div class="title-line"></div>
        </h1>

        <!-- Acciones principales -->
        <div class="action-bar animate__animated animate__fadeInUp">
            <a href="{{ route('om-people.create') }}" class="neo-btn">
                <i class="fas fa-user-plus mr-2"></i>
                <span class="btn-gradient-text">Nueva Persona</span>
            </a>
        </div>
        <br>
        <!-- Grid de tarjetas -->
        <div class="responsive-grid">
            @foreach ($people as $person)
                <div class="grid-item animate__animated animate__zoomIn">
                    <div class="person-card">
                        <div class="card-header">
                            <button class="delete-btn holographic" data-id="{{ $person->id }}" data-toggle="tooltip"
                                title="Eliminar permanentemente"></button>
                            <h3 class="person-name">
                                {{ strtoupper($person->paternal_last_name) }}
                                <span class="name-highlight">{{ $person->given_name }}</span>
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="info-grid">
                                <div class="info-item">
                                    <i class="fas fa-id-card icon"></i>
                                    <div class="info-content">
                                        <span class="info-label">DNI</span>
                                        <span class="info-value dni-code">{{ $person->dni }}</span>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <i class="fas fa-cake-candles icon"></i>
                                    <div class="info-content">
                                        <span class="info-label">Edad</span>
                                        <span class="info-value age-badge">{{ $person->age }}</span>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <i class="fas fa-heart icon"></i>
                                    <div class="info-content">
                                        <span class="info-label">Estado Civil</span>
                                        <span class="info-value">{{ $person->marital_status }}</span>
                                    </div>
                                </div>
                                <div class="address-container">
                                    <div class="address-item">
                                        <i class="fas fa-map-marker-alt address-icon"></i>
                                        <span class="address-text">
                                            {{ $person->dwelling->exact_location ?? 'Dirección no registrada' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actualiza la sección de acciones de la tarjeta -->
                        <div class="card-actions">
                            <a href="{{ route('om-people.show', $person->id) }}" class="action-btn view-btn"
                                data-toggle="tooltip" title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('om-people.edit', $person->id) }}" class="action-btn edit-btn"
                                data-toggle="tooltip" title="Editar registro">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación mejorada -->
        <div class="custom-pagination">
            {{ $people->onEachSide(2)->links('pagination::semantic-ui') }}
        </div>
    </div>

    <!-- Formulario oculto para eliminación -->
    <form id="delete-form" action="{{ route('om-people.destroy', '') }}" method="POST">
        @csrf
        @method('DELETE')
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
    <style>
        :root {
            --primary-color: #FF3B30;
            --secondary-color: #930813;
            --accent-color: #FF9F0A;
            --text-light: #F5F5F7;
            --gradient-red: linear-gradient(135deg, #FF3B30 0%, #930813 100%);
        }

        /* Estilos del banner */
        .municipal-banner {
            position: relative;
            background: var(--gradient-red);
            border-radius: 0 0 30px 30px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(147, 8, 19, 0.3);
        }

        .municipal-logo {
            height: 100px;
            filter: drop-shadow(0 2px 5px rgba(0, 0, 0, 0.3));
            transition: transform 0.3s ease;
        }

        /* Título principal */
        .main-title {
            text-align: center;
            margin: 2rem 0;
            position: relative;
        }

        .title-text {
            font-size: 2.5rem;
            font-weight: 800;
            background: var(--gradient-red);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .title-line {
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 4px;
            background: var(--gradient-red);
        }

        /* Grid de tarjetas */
        .responsive-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            padding: 1rem;
        }

        /* Tarjeta persona */
        .person-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(147, 8, 19, 0.1);
            transition: transform 0.3s ease;
            position: relative;
        }

        .person-card:hover {
            transform: translateY(-5px);
        }

        /* Cabecera tarjeta */
        .card-header {
            padding: 1rem;
            background: var(--gradient-red);
            position: relative;
            height: 60px;
        }

        .person-name {
            color: var(--text-light);
            font-size: 1.1rem;
            line-height: 1.3;
            padding-right: 35px;
            padding-top: 10px;
            margin: 0;
        }

        /* Botón eliminar */
        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .delete-btn:hover {
            background: var(--accent-color);
            transform: rotate(90deg) scale(1.1);
        }

        /* Cuerpo tarjeta */
        .card-body {
            padding: 1rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.8rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .icon {
            font-size: 1.2rem;
            color: var(--primary-color);
        }

        .info-label {
            font-size: 0.75rem;
            color: #666;
        }

        .info-value {
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Botones acción */
        .card-actions {
            display: flex;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-top: 1px solid #eee;
            background: #f9f9f9;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: white;
        }

        /* Botones y acciones */
        .neo-btn {
            position: center;
            padding: 1rem 2rem;
            border: none;
            border-radius: 15px;
            background: var(--gradient-red);
            color: white;
            font-weight: 600;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(147, 8, 19, 0.3);
        }

        .neo-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(147, 8, 19, 0.4);
        }

        .view-btn {
            background: #007AFF;
        }

        .edit-btn {
            background: #34C759;
        }

        .action-btn:hover {
            transform: scale(1.15);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .title-text {
                font-size: 2rem;
            }

            .municipal-logo {
                height: 80px;
            }

            .person-name {
                font-size: 1rem;
            }
        }

        /* Eliminar el ID */
        .person-badge {
            display: none;
        }

        /* Nombre destacado */
        .person-name {
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 0.5rem 0;
            display: inline-block;
            background: linear-gradient(to right, #ffffff 20%, var(--accent-color) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 2px 4px rgba(147, 8, 19, 0.2);
            margin: 0;
            line-height: 1.4;
        }

        /* X personalizada */
        .delete-btn::after {
            content: "✕";
            display: block;
            font-size: 16px;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .delete-btn:hover::after {
            color: white;
            transform: rotate(90deg) scale(1.2);
        }

        /* Ajuste posición nombre */
        .card-header {
            padding: 0.5rem 1rem;
        }
        .address-item {
        display: flex;
        align-items: center;
        gap: 0rem;
        color: #444;
    }

    .address-icon {
        color: var(--primary-color);
        font-size: 1.1rem;
        min-width: 20px;
    }

    .address-text {
        font-size: 0.85rem;
        line-height: 1.4;
    }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animación de elementos al hacer scroll
            const animateOnScroll = () => {
                const elements = document.querySelectorAll('.animate-on-scroll');
                elements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    if (rect.top < window.innerHeight * 0.8) {
                        el.classList.add('animate__fadeInUp');
                    }
                });
            }
            window.addEventListener('scroll', animateOnScroll);
            animateOnScroll();

            // Eliminación con confirmación mejorada
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;

                    Swal.fire({
                        title: '¿Eliminar Registro?',
                        html: `<div class="swal2-icon-container">
                                    <div class="swal2-icon-shadow"></div>
                                    <div class="swal2-icon swal2-error">
                                        <div class="swal2-error-circular-line"></div>
                                        <div class="swal2-error-x-mark">
                                            <span class="swal2-x-mark-line-left"></span>
                                            <span class="swal2-x-mark-line-right"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swal2-html-container">
                                    <p>Esta acción eliminará permanentemente el registro de:</p>
                                    <strong>${this.closest('.person-card').querySelector('.person-name').textContent}</strong>
                                </div>`,
                        showCancelButton: true,
                        confirmButtonColor: '#FF3B30',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Confirmar Eliminación',
                        cancelButtonText: 'Cancelar',
                        background: 'var(--text-light)',
                        customClass: {
                            popup: 'custom-swal',
                            confirmButton: 'swal2-confirm-btn',
                            cancelButton: 'swal2-cancel-btn'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById('delete-form');
                            form.action = `om-people/${id}`;
                            form.submit();
                        }
                    });
                });
            });

            // Tooltips dinámicos
            tippy('[data-toggle="tooltip"]', {
                content: (reference) => reference.getAttribute('title'),
                placement: 'top',
                theme: 'red',
                animation: 'scale',
                arrow: true,
                delay: [100, 50],
            });
        });
    </script>
@stop
