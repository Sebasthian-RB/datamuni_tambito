@extends('adminlte::page')

@section('title', 'Lista de Guardianes')

@section('content')
<div class="container">

    <!-- Botones de encabezado-->
    <div class="gap-3 mb-4 d-flex flex-column flex-md-row align-items-start align-items-md-center">

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
            @can('crear')
            <a href="{{ route('guardians.create') }}" class="btn btn-secondary btn-main">
                <i class="fas fa-plus-circle me-2"></i> Agregar Nuevo Guardián
            </a>
            @endcan
        </div>

    </div>
    <!-- Mensajes de éxito y error -->
    {{-- Mensajes de éxito y error --}}

    <!-- Mensajes de éxito -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Mensajes de error -->
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Tabla de guardianes -->
    <div class="card">
        <!-- Header con título y logo -->
        <div class="mb-4 card-header">
            <div class="header-content">
                <div class="header-text">
                    <h1 class="card-title"><i class="fas fa-users"></i> Listado de Guardianes</h1>
                    <p class="card-subtitle"> Gestión de guardianes registrados en el sistema.</p>
                </div>
                <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
            </div>
        </div>

        <div class="card-body" style="background-color: #EAFAEA;">
            @if ($guardians->isEmpty())
            <div class="text-center alert alert-info">
                <i class="fas fa-info-circle"></i> No hay guardianes registrados.
            </div>
            @else
            <table id="guardiansTable" class="table table-bordered table-striped">
                <thead style="background-color: #6E8E59; color: white;">
                    <tr>
                        <th>ID</th>
                        <th>Tipo de Documento</th>
                        <th>Nombre Completo</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guardians as $guardian)
                    <tr>
                        <td>{{ $guardian->id }}</td>
                        <td>{{ $guardian->document_type }}</td>
                        <td>{{ $guardian->given_name }} {{ $guardian->paternal_last_name }} {{ $guardian->maternal_last_name }}</td>
                        <td>
                            @if ($guardian->phone_number)
                            {{ $guardian->phone_number }}
                            @else
                            <i class="fas fa-phone-slash" style="color: gray;"></i> No registrado
                            @endif
                        </td>
                        <td>
                            @can('ver detalles')
                            <a href="{{ route('guardians.show', $guardian->id) }}" class="btn btn-sm" style="background-color: #6E8E59; color: white;" aria-label="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </a>
                            @endcan
                            @can('editar')
                            <a href="{{ route('guardians.edit', $guardian->id) }}" class="btn btn-sm" style="background-color: #CAE0BC; color: black;" aria-label="Editar guardián">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan
                            <form action="{{ route('guardians.destroy', $guardian->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                @can('eliminar')
                                <button type="submit" class="btn btn-sm" style="background-color: #780C28; color: white;" onclick="return confirm('¿Está seguro de eliminar este guardián?')" aria-label="Eliminar guardián">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@stop

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


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

    /* Estilos para los botones de exportación */
    .dt-buttons .btn {
        margin-right: 5px;
        margin-bottom: 5px;
    }
    
    /* Ajustes para móviles */
    @media (max-width: 768px) {
        .dt-buttons {
            margin-top: 10px;
            text-align: center;
        }
        
        .dt-buttons .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }

</style>
@stop

@section('js')
<!-- Incluye las librerías necesarias para DataTables y exportación -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#guardiansTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
            },
            responsive: true,
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'Bf>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: 'btn btn-success btn-sm',
                    exportOptions: {
                        columns: ':not(:last-child)', // Excluye la columna de acciones
                        modifier: {
                            page: 'all' // Exportar todas las páginas
                        }
                    },
                    title: 'Listado de Guardianes',
                    filename: 'guardianes_' + new Date().toISOString().slice(0, 10)
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: 'btn btn-danger btn-sm',
                    exportOptions: {
                        columns: ':not(:last-child)', // Excluye la columna de acciones
                        modifier: {
                            page: 'all' // Exportar todas las páginas
                        }
                    },
                    title: 'Listado de Guardianes',
                    filename: 'guardianes_' + new Date().toISOString().slice(0, 10),
                    customize: function(doc) {
                        doc.defaultStyle.fontSize = 10;
                        doc.styles.tableHeader.fontSize = 11;
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                }
            ]
        });
    });
</script>
@stop
