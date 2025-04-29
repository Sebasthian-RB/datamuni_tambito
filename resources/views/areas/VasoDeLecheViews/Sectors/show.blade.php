@extends('adminlte::page')

@section('title', 'Detalle del Sector')

@section('css')
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <!-- Estilos personalizados -->
    <style>
        /* Colores de la paleta */
        :root {
            --color-primary: #3B1E54;
            --color-secondary: #9B7EBD;
            --color-accent: #D4BEE4;
            --color-background: #EEEEEE;
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
            background: var(--color-primary);
            padding: 15px;
            text-align: center;
        }

        .header-logo {
            height: 50px;
            width: auto;
            transition: opacity 0.3s ease;
        }

        .header-logo:hover {
            opacity: 0.8;
        }

        /* Estilos de texto */
        .detail-label {
            font-weight: bold;
            color: var(--color-primary);
        }

        .detail-value {
            color: #333;
        }

        .no-description {
            color: #999;
            font-style: italic;
        }

        /* Botones */
        .btn-custom {
            background-color: var(--color-secondary);
            border-color: var(--color-secondary);
            color: white;
        }

        .btn-custom:hover,
        .btn-secondary:hover {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
@stop

@section('content')
<div class="container">
    <div class="card">
        <!-- Card Header -->
        <div class="card-header">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <p><span class="detail-label">ID:</span> <span class="detail-value">{{ $sector->id }}</span></p>
            <p><span class="detail-label">Nombre:</span> <span class="detail-value">{{ $sector->name }}</span></p>
            <p><span class="detail-label">Responsable:</span> <span class="detail-value">{{ $sector->responsible_person }}</span></p>
            <p><span class="detail-label">Descripción:</span> 
                <span class="detail-value">
                    @if($sector->description)
                        {{ $sector->description }}
                    @else
                        <span class="no-description">(Sin descripción)</span>
                    @endif
                </span>
            </p>
        </div>

        <!-- Card Footer -->
        <div class="card-footer text-right">
            <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-custom">Editar</a>
            <a href="{{ route('sectors.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@stop