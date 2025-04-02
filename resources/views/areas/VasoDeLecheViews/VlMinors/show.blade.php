@extends('adminlte::page')

@section('title', 'Detalle del Menor')

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

        .no-data {
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
            <p><span class="detail-label">Número de Identidad:</span> 
                <span class="detail-value">
                    {!! $vlMinor->id ?? '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Tipo de Documento:</span> 
                <span class="detail-value">
                    {!! $vlMinor->identity_document ?? '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Nombre:</span> 
                <span class="detail-value">
                    {!! $vlMinor->given_name ?? '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Apellido Paterno:</span> 
                <span class="detail-value">
                    {!! $vlMinor->paternal_last_name ?? '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Apellido Materno:</span> 
                <span class="detail-value">
                    {!! $vlMinor->maternal_last_name ?? '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Fecha de Nacimiento:</span> 
                <span class="detail-value">
                    {!! $vlMinor->birth_date ? $vlMinor->birth_date->format('d/m/Y') : '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Edad:</span> 
                <span class="detail-value">
                    {!! $vlMinor->birth_date ? $vlMinor->birth_date->age . ' años' : '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Sexo:</span> 
                <span class="detail-value">
                    @if($vlMinor->sex_type === 0)
                        Femenino
                    @elseif($vlMinor->sex_type === 1)
                        Masculino
                    @else
                        <span class="no-data">No disponible</span>
                    @endif
                </span>
            </p>
            <p><span class="detail-label">Fecha de Empadronamiento:</span> 
                <span class="detail-value">
                    {!! $vlMinor->registration_date ? $vlMinor->registration_date->format('d/m/Y') : '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Fecha de Retiro:</span> 
                <span class="detail-value">
                    {!! $vlMinor->withdrawal_date ? $vlMinor->withdrawal_date->format('d/m/Y') : '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Domicilio:</span> 
                <span class="detail-value">
                    {!! $vlMinor->address ?? '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Tipo de Vivienda:</span> 
                <span class="detail-value">
                    {!! $vlMinor->dwelling_type ?? '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Nivel Educativo:</span> 
                <span class="detail-value">
                    {!! $vlMinor->education_level ?? '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Condición:</span> 
                <span class="detail-value">
                    {!! $vlMinor->condition ?? '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
            <p><span class="detail-label">Discapacidad:</span> 
                <span class="detail-value">
                    @if($vlMinor->disability !== null)
                        {{ $vlMinor->disability ? 'Sí' : 'No' }}
                    @else
                        <span class="no-data">No disponible</span>
                    @endif
                </span>
            </p>
            <p><span class="detail-label">Familiar:</span> 
                <span class="detail-value">
                    @if($vlMinor->vlFamilyMember)
                        {{ $vlMinor->vlFamilyMember->given_name . ' ' . $vlMinor->vlFamilyMember->paternal_last_name . ' ' . $vlMinor->vlFamilyMember->maternal_last_name }}
                    @else
                        <span class="no-data">No disponible</span>
                    @endif
                </span>
            </p>
            <p><span class="detail-label">Parentesco:</span> 
                <span class="detail-value">
                    {!! $vlMinor->kinship ?? '<span class="no-data">No disponible</span>' !!}
                </span>
            </p>
        </div>

        <!-- Card Footer -->
        <div class="card-footer text-right">
            <a href="{{ route('vl_minors.edit', $vlMinor->id) }}" class="btn btn-custom">Editar</a>
            <a href="{{ route('vl_minors.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@stop