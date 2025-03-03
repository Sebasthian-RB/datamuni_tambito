@extends('adminlte::page')

@section('title', 'Productos')

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

        .btn-custom:hover {
            background-color: var(--color-primary); /* Tono más oscuro para el hover */
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
        }

        .btn-secondary {
            background-color: var(--color-gray); /* Color gris para el botón de Volver */
            color: white;
        }

        .btn-secondary:hover {
            background-color: #474c4f; /* Tono más oscuro para el hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
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

        .btn-view {
            background-color: var(--color-secondary);
            color: white;
        }

        .btn-view:hover {
            background-color: var(--color-primary); /* Tono más oscuro para el hover */
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
        }

        .btn-edit {
            background-color: var(--color-accent);
            color: var(--color-primary);
        }

        .btn-edit:hover {
            background-color: #acacac; /* Tono más oscuro para el hover */
            color: white; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #b11111; /* Tono más oscuro para el hover */
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
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
        }
    </style>
@stop

@section('content')
<div class="container">
    <!-- Header con título y logo -->
    <div class="card-header mb-4">
        <div class="header-content">
            <div class="header-text"> <!-- Contenedor para el título y subtítulo -->
                <h1 class="card-title">Lista de Productos</h1>
                <p class="card-subtitle">Gestión de productos registrados en el sistema.</p>
            </div>
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
        </div>
    </div>

    <!-- Botones principales -->
    <div class="d-flex flex-column flex-md-row gap-3 mb-4">
        <a href="{{ route('products.create') }}" class="btn btn-custom btn-main">
            <i class="fas fa-plus"></i> Agregar Producto
        </a>
        <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-secondary btn-main">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla de productos -->
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                @if($product->description)
                                    {{ $product->description }}
                                @else
                                    <span class="text-secondary"> (Sin descripción)</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column flex-md-row gap-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-view btn-action">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-edit btn-action">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-action" onclick="return confirm('¿Está seguro de eliminar este producto?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop