@extends('adminlte::page')

@section('title', 'Listado de Adultos Mayores')

@section('content')
<div class="container">

    <!-- Botones de encabezado-->
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3 mb-4">
        <!-- Botón "Volver" -->
        <div class="col-md-2 d-flex justify-content-start align-items-center">
            <a href="{{ route('CiamHome') }}" class="btn btn-secondary btn-main">
                <i class="fas fa-arrow-left me-2"></i> <!-- Ícono más grande y descriptivo -->
                <span>Volver</span>
            </a>
        </div>

        <div class="col-md-7">
        </div>

        <!-- Botón "Agregar Adulto Mayor" -->
        <div class="col-md-3 d-flex justify-content-end align-items-center">
            <a href="{{ route('elderly_adults.create') }}" class="btn btn-secondary btn-main">
                <i class="fas fa-plus-circle me-2"></i> Agregar Adulto Mayor
            </a>
        </div>

    </div>

    <!-- Mensajes de éxito, error y advertencia -->
    @if(session('success'))
    <div class="alert {{ session('success_type') === 'delete' ? 'alert-success-delete' : 'alert-success' }} auto-dismiss" role="alert">
        <strong>Éxito:</strong> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger auto-dismiss" role="alert">
        <strong>Error:</strong> {{ session('error') }}
    </div>
    @endif

    @if(session('warning'))
    <div class="alert alert-warning auto-dismiss" role="alert">
        <strong>Advertencia:</strong> {{ session('warning') }}
    </div>
    @endif

    <!-- Tabla de Adultos Mayores -->
    <div class="card">
        <!-- Header con título y logo -->
        <div class="card-header mb-4">
            <div class="header-content">
                <div class="header-text">
                    <h1 class="card-title"><i class="fas fa-users"></i> Listado de Adultos Mayores</h1>
                    <p class="card-subtitle"> Gestión de adultos mayores registrados en el sistema.</p>
                </div>
                <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
            </div>
        </div>
        <div class="card-body">
            <table id="elderlyAdultsTable" class="table table-bordered table-striped">
                <thead style="background-color: #CAE0BC; color: black;">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Sexo</th>
                        <th>Edad</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elderlyAdults as $elderlyAdult)
                    <tr>
                        <td class="text-center">{{ $elderlyAdult->id }}</td>
                        <td>{{ $elderlyAdult->given_name }} {{ $elderlyAdult->paternal_last_name }} {{ $elderlyAdult->maternal_last_name }}</td>
                        <td class="text-center">{{ $elderlyAdult->sex_type == 0 ? 'Femenino' : 'Masculino' }}</td>
                        <td class="text-center">{{ $elderlyAdult->birth_date->age }} años</td>
                        <td class="text-center">{{ $elderlyAdult->phone_number ?? 'No registrado' }}</td>
                        <td class="text-center">
                            @if ($elderlyAdult->state)
                            <span class="badge bg-success">Activo</span>
                            @else
                            <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <!-- Botones de acciones -->
                            <a href="{{ route('elderly_adults.show', $elderlyAdult->id) }}" class="btn btn-sm text-white" style="background-color: #6E8E59;">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                            <a href="{{ route('elderly_adults.edit', $elderlyAdult->id) }}" class="btn btn-sm text-white" style="background-color: #CAE0BC;">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <!-- Botones de acciones -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $elderlyAdult->id }}">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </td>
                    </tr>

                    <!-- Modal de Confirmación de Eliminación -->
                    <div class="modal fade" id="deleteModal{{ $elderlyAdult->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #780C28; color: white;">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar a <strong>{{ $elderlyAdult->given_name }} {{ $elderlyAdult->paternal_last_name }}</strong>?

                                    <!-- Mensaje de advertencia si tiene un guardián asignado -->
                                    @if ($elderlyAdult->guardian_id !== null)
                                    <div class="alert alert-warning mt-3">
                                        <strong>Advertencia:</strong> El guardián <strong>{{ $elderlyAdult->guardian->given_name }} {{ $elderlyAdult->guardian->paternal_last_name }}</strong> quedará desasignado de este adulto mayor.
                                    </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('elderly_adults.destroy', $elderlyAdult->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
<!-- Incluir Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<!-- Incluir DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<style>
    /* Colores de la paleta CIAM */
    :root {
        --color-primary: #6E8E59;
        /* Rojo oscuro */
        --color-secondary: #780C28;
        /* Verde oliva */
        --color-accent: #CAE0BC;
        /* Verde claro */
        --color-background: #EAFAEA;
        /* Fondo suave */
        --color-gray: #6c757d;
        /* Gris neutro */
        --color-table-border: #780C28;
        /* Rojo oscuro para bordes de tabla */
        --color-hover: #9A1F40;
        /* Rojo intenso para efectos hover */
        --color-light-text: #F5F5F5;
        /* Blanco roto para mejor contraste */
        --color-button-hover: #5A7D42;
        /* Verde más oscuro para botones */
    }

    /* Estilos generales */
    .card {
        border: 1px solid var(--color-accent);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .container {
        padding-top: 20px;
    }

    /* Header */
    .card-header {
        background: linear-gradient(135deg, #31766E, #1F4F48);
        color: #FFFFFF;
        padding: 25px 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }


    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header-text {
        display: flex;
        flex-direction: column;
        /* Apila el título y el subtítulo verticalmente */
    }

    .card-title {
        font-size: 1.75rem;
        margin: 0;
        font-weight: 700;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    .card-subtitle {
        font-size: 1rem;
        color: var(--color-accent);
        margin-top: 5px;
        font-weight: 400;
        opacity: 0.8;
    }

    .header-logo {
        height: 50px;
        width: auto;
        transition: opacity 0.3s ease;
    }

    .header-logo:hover {
        opacity: 0.8;
    }

    /* Estilos para los botones principales */
    .btn-main {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        /* Centra el contenido */
        gap: 8px;
        padding: 12px 24px;
        /* Aumenté el padding para más espacio */
        font-size: 14px;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        width: 100%;
        /* Ocupa el 100% del ancho en móviles */
        margin-bottom: 10px;
        /* Separa los botones verticalmente */
    }

    .btn-custom {
        background-color: var(--color-secondary);
        color: white;
    }

    .btn-secondary {
        background-color: var(--color-gray);
        /* Color gris para el botón de Volver */
        color: white;
    }

    /* Estilos para los botones de acción */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        /* Centra el contenido */
        gap: 5px;
        padding: 8px 16px;
        /* Aumenté el padding para más espacio */
        font-size: 12px;
        font-weight: 500;
        border-radius: 4px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        width: 100%;
        /* Ocupa el 100% del ancho en móviles */
        margin-bottom: 5px;
        /* Separa los botones verticalmente */
    }

    /* Estilos de hover para todos los botones */
    .btn-main:hover,
    .btn-action:hover {
        background-color: var(--color-primary);
        /* Mismo color para todos los hovers */
        color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Sombra suave */
    }
</style>

<style>
    /* DISEÑO PARA Mensajes de éxito, error y advertencia  */
    .alert {
        border-radius: 8px;
        /* Bordes redondeados */
        padding: 15px;
        /* Espaciado interno */
        margin-bottom: 20px;
        /* Margen inferior */
    }

    .alert strong {
        font-size: 1.1em;
        /* Tamaño de fuente más grande para el texto destacado */
    }

    .btn-close {
        padding: 0.75rem;
        /* Espaciado para el botón de cierre */
    }
</style>

<style>
    /* Color personalizado para el mensaje de éxito de eliminación */
    .alert-success-delete {
        background-color: #780C29;
        /* Color de fondo */
        color: white;
        /* Color del texto */
        border-color: #660a22;
        /* Color del borde (opcional) */
    }
</style>

<style>
    /* Animación de desvanecimiento para los mensajes*/
    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    /* Clase para aplicar la animación */
    .fade-out {
        animation: fadeOut 0.5s ease-in-out forwards;
        /* Duración de 0.5 segundos */
    }
</style>
@stop

@section('js')
<!-- Incluir Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#elderlyAdultsTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
            },
            responsive: true,
            autoWidth: false,
        });
    });
</script>

<!-- Script para hacer que los mensajes desaparezcan automáticamente -->
<script>
    // Desvanecer y eliminar los mensajes después de 5 segundos (5000 ms)
    setTimeout(function() {
        const alerts = document.querySelectorAll('.auto-dismiss');
        alerts.forEach(alert => {
            // Agregar la clase de desvanecimiento
            alert.classList.add('fade-out');

            // Eliminar el mensaje del DOM después de que termine la animación
            alert.addEventListener('animationend', () => {
                alert.remove();
            });
        });
    }, 5000);
</script>
@stop