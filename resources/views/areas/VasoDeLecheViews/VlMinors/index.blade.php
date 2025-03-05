@extends('adminlte::page')

@section('title', 'Lista de Menores')

@section('content_header')
@stop

@section('css')
    <!-- Estilos personalizados -->
    <style>
        /* Colores de la paleta */
        :root {
            --color-primary: #3B1E54;
            --color-secondary: #9B7EBD;
            --color-accent: #D4BEE4;
            --color-background: #EEEEEE;
            --color-gray: #6c757d; /* Color gris para el botón de Volver */
            --color-table-border: #3B1E54; /* Nuevo color para el borde de la tabla */
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
            background: linear-gradient(135deg, var(--color-primary), #5A2E7A);
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
            flex-direction: column; /* Apila el título y el subtítulo verticalmente */
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
            margin-bottom: 10px; /* Separa los botones verticalmente */
        }

        .btn-custom {
            background-color: var(--color-secondary);
            color: white;
        }

        .btn-secondary {
            background-color: var(--color-gray); /* Color gris para el botón de Volver */
            color: white;
        }

        .btn-view {
            background-color: var(--color-secondary);
            color: white;
        }

        .btn-edit {
            background-color: var(--color-accent);
            color: var(--color-primary);
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        
        /* Estilos para los botones de acción */
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center; /* Centra el contenido */
            gap: 5px;
            padding: 8px 16px; /* Aumenté el padding para más espacio */
            font-size: 12px;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            width: 100%; /* Ocupa el 100% del ancho en móviles */
            margin-bottom: 5px; /* Separa los botones verticalmente */
        }

        /* Estilos de hover para todos los botones */
        .btn-main:hover,
        .btn-action:hover {
            background-color: var(--color-primary); /* Mismo color para todos los hovers */
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
        }

        /* Estilos para el botón flotante */
        .floating-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            padding: 15px 25px;
            border-radius: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Estilos para la tabla */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: var(--color-primary);
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 2px solid var(--color-table-border); /* Nuevo color para el borde de la tabla */
        }

        .table thead th {
            background-color: var(--color-primary);
            color: white;
            border-color: var(--color-table-border);
            padding: 15px;
            text-align: left;
        }

        .table tbody td {
            border-color: var(--color-background);
            padding: 15px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(212, 190, 228, 0.1);
        }

        .table tbody tr:hover {
            background-color: #cfcfcf;
        }

        /* Ajustar ancho de columnas */
        .table tbody td:nth-child(1) {
            width: 5%; /* Ajustar ancho de la columna ID */
        }

        .table tbody td:nth-child(2),
        .table tbody td:nth-child(3),
        .table tbody td:nth-child(4) {
            width: 15%; /* Ajustar ancho de las columnas de nombres */
        }

        .table tbody td:nth-child(5),
        .table tbody td:nth-child(6),
        .table tbody td:nth-child(7) {
            width: 10%; /* Ajustar ancho de las columnas de sexo, fecha y edad */
        }

        .table tbody td:nth-child(8) {
            width: 20%; /* Ajustar ancho de la columna Acciones */
        }

        /* Estilos para los mensajes cuando no hay datos */
        .no-data-message {
            background-color: var(--color-accent); /* Fondo con el color de acento */
            color: var(--color-primary); /* Texto con el color primario */
            border: 2px; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
            font-size: 1.1rem;
            font-weight: 500;
        }

        .no-data-message i {
            color: var(--color-primary); /* Ícono con el color primario */
            font-size: 1.2rem;
        }

        /* Estilos para la paginación */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 20px 0; /* Margen superior e inferior */
        }

        .pagination .page-item {
            margin: 0 4px; /* Espaciado entre los elementos de la paginación */
        }

        .pagination .page-link {
            color: #3B1E54; /* Color del texto */
            background-color: #D4BEE4; /* Fondo */
            border: 1px solid #9B7EBD; /* Borde con el color principal */
            border-radius: 6px; /* Bordes redondeados */
            padding: 8px 16px; /* Espaciado interno */
            font-size: 0.875rem; /* Tamaño de fuente */
            text-decoration: none; /* Sin subrayado */
            transition: all 0.3s ease; /* Transición suave */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        .pagination .page-item.active .page-link {
            color: white; /* Color del texto cuando está activo */
            background-color: #9B7EBD; /* Fondo cuando está activo */
            border-color: #9B7EBD; /* Borde cuando está activo */
        }

        .pagination .page-link:hover {
            background-color: #9B7EBD; /* Fondo al pasar el cursor */
            color: white; /* Color del texto al pasar el cursor */
            transform: translateY(-2px); /* Efecto de elevación */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra más pronunciada */
        }

        .pagination .page-item.disabled .page-link {
            color: #9B7EBD; /* Color del texto deshabilitado */
            background-color: #EEEEEE; /* Fondo deshabilitado */
            border-color: #9B7EBD; /* Borde deshabilitado */
            opacity: 0.6; /* Opacidad reducida */
            cursor: not-allowed; /* Cursor no permitido */
        }

        /* Estilos responsivos */
        @media (min-width: 768px) {
            .btn-main {
                width: auto; /* Ancho automático en pantallas grandes */
                margin-bottom: 0; /* Elimina el margen inferior */
                margin-right: 10px; /* Separa los botones horizontalmente */
            }

            .btn-action {
                width: auto; /* Ancho automático en pantallas grandes */
                margin-bottom: 0; /* Elimina el margen inferior */
                margin-right: 5px; /* Separa los botones horizontalmente */
            }

            .btn-action:last-child {
                margin-right: 0; /* Elimina el margen del último botón */
            }
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column; /* Apila el texto y el logo verticalmente */
                align-items: flex-start;
            }

            .header-logo {
                margin-top: 15px; /* Separa el logo del texto */
            }

            .pagination .page-item:not(.previous):not(.next) {
                display: inline-block; /* Muestra los números de página */
            }

            .pagination .page-link {
                padding: 6px 12px; /* Espaciado más pequeño */
                font-size: 0.75rem; /* Tamaño de fuente más pequeño */
            }

            .pagination .page-item.previous .page-link,
            .pagination .page-item.next .page-link {
                padding: 8px 14px; /* Espaciado reducido */
                font-size: 0.8rem; /* Tamaño de fuente más pequeño */
            }
        }
    </style>
@stop

@section('content')
<div class="container">

    <!-- Botón "Volver" -->
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3 mb-4">
        <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-secondary btn-main">
            <i class="fas fa-arrow-left me-2"></i> <!-- Ícono más grande y descriptivo -->
            <span>Volver</span>
        </a>
    </div>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-warning">{{ session('info') }}</div>
    @endif
    
    <!-- Header con título y logo -->
    <div class="card-header mb-4">
        <div class="header-content">
            <div class="header-text">
                <h1 class="card-title">Lista de Menores</h1>
                <p class="card-subtitle">Gestión de menores registrados en el sistema.</p>
            </div>
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
        </div>
    </div>

    <!-- Verificar si hay datos -->
    @if($vlMinors->isEmpty()))
        <!-- Mensaje cuando no hay datos -->
        <div class="no-data-message text-center p-4 rounded">
            <i class="fas fa-info-circle me-2"></i>
            No hay menores registrados en el sistema.
        </div>
    @else
        <!-- Tabla de menores -->
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Sexo</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Edad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vlMinors as $minor)
                            <tr>
                                <td>{{ $minor->id }}</td>
                                <td>{{ $minor->given_name }}</td>
                                <td>{{ $minor->paternal_last_name }}</td>
                                <td>{{ $minor->maternal_last_name }}</td>
                                <td>{{ $minor->sex_type == 0 ? 'Femenino' : 'Masculino' }}</td>
                                <td>{{ $minor->birth_date->format('d/m/Y') }}</td>
                                <td>{{ $minor->birth_date->age }} años</td>
                                <td>
                                    <div class="d-flex flex-column flex-md-row gap-2">
                                        <a href="{{ route('vl_minors.show', $minor->id) }}" class="btn btn-view btn-action">
                                            <i class="fas fa-eye me-1"></i> Ver
                                        </a>
                                        <a href="{{ route('vl_minors.edit', $minor->id) }}" class="btn btn-edit btn-action">
                                            <i class="fas fa-edit me-1"></i> Editar
                                        </a>
                                        <form action="{{ route('vl_minors.destroy', $minor->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete btn-action" onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                                                <i class="fas fa-trash me-1"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
                @if ($vlMinors->hasPages())
                    <ul class="pagination">
                        <!-- Página anterior -->
                        @if ($vlMinors->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Anterior</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $vlMinors->previousPageUrl() }}" rel="prev">Anterior</a>
                            </li>
                        @endif

                        <!-- Páginas numeradas -->
                        @foreach ($vlMinors->getUrlRange(1, $vlMinors->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $vlMinors->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach

                        <!-- Página siguiente -->
                        @if ($vlMinors->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $vlMinors->nextPageUrl() }}" rel="next">Siguiente</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Siguiente</span>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    @endif

    <!-- Botón flotante "Agregar Menor" -->
    <a href="{{ route('vl_minors.create') }}" class="btn btn-custom btn-main floating-btn">
        <i class="fas fa-plus-circle me-2"></i>
        <span>Agregar Menor</span>
    </a>
</div>
@stop