@extends('adminlte::page')

@section('title', 'Padrón de Beneficiarios')

@section('content_header')
    <h1>PADRÓN DE BENEFICIARIOS DEL PROGRAMA VASO DE LECHE</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('committee_vl_family_members.create', ['committee_id' => $committee->id]) }}" class="btn mb-3" style="background-color: #9B7EBD; color: white;">Agregar Beneficiario</a>
    <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-secondary mb-3">Volver</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section class="card shadow-sm" style="border-radius: 15px; border: none; overflow: hidden; background-color: #ffffff;">
        <!-- Encabezado con gradiente y sombra -->
        <div class="card-header" style="background: linear-gradient(135deg, #8E6AB8, #6A4A8E); border: none; padding: 20px;">
            <div class="row align-items-center">
                <div class="col-md-9">
                    <h4 class="font-weight-bold text-white" style="font-size: 1.8rem; letter-spacing: 1px; margin-bottom: 5px;">
                        <i class="fas fa-users" style="font-size: 1.6rem; margin-right: 10px; vertical-align: middle;"></i>
                        Padrón de Beneficiarios de <span style="font-weight: 800; color: #f5f5f5;">{{ $committee->name ?? 'No disponible' }}</span>
                    </h4>
                    <p class="text-white" style="font-size: 1rem; opacity: 0.9; margin-bottom: 0;">Consulta y gestión de los beneficiarios registrados en el comité</p>
                </div>
                <div class="col-md-3 text-md-right">
                    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 60px; border-radius: 8px;">
                </div>
            </div>
        </div>
    
        <!-- Cuerpo de la tarjeta con información organizada -->
        <div class="card-body" style="padding: 20px;">
            <div class="row">
                <!-- Columna 1: Ubicación -->
                <div class="col-md-3 mb-3">
                    <div class="info-card" style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; height: 100%; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt" style="font-size: 1.2rem; color: #8E6AB8; margin-right: 8px;"></i>
                            <label class="font-weight-semibold" style="color: #2c2c2c; font-size: 1rem; margin-bottom: 0;">Ubicación</label>
                        </div>
                        <p style="font-size: 1rem; color: #343a40; font-weight: 500; margin-bottom: 0;">{{ $committee->location ?? 'No disponible' }}</p>
                    </div>
                </div>
    
                <!-- Columna 2: Presidente(a) -->
                <div class="col-md-3 mb-3">
                    <div class="info-card" style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; height: 100%; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-user-tie" style="font-size: 1.2rem; color: #8E6AB8; margin-right: 8px;"></i>
                            <label class="font-weight-semibold" style="color: #2c2c2c; font-size: 1rem; margin-bottom: 0;">Presidente(a)</label>
                        </div>
                        <p style="font-size: 1rem; color: #343a40; font-weight: 500; margin-bottom: 0;">{{ $committee->president ?? 'No disponible' }}</p>
                    </div>
                </div>
    
                <!-- Columna 3: Urban Core -->
                <div class="col-md-3 mb-3">
                    <div class="info-card" style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; height: 100%; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-city" style="font-size: 1.2rem; color: #8E6AB8; margin-right: 8px;"></i>
                            <label class="font-weight-semibold" style="color: #2c2c2c; font-size: 1rem; margin-bottom: 0;">Urban Core</label>
                        </div>
                        <p style="font-size: 1rem; color: #343a40; font-weight: 500; margin-bottom: 0;">{{ $committee->urban_core ?? 'No disponible' }}</p>
                    </div>
                </div>
    
                <!-- Columna 4: Sector -->
                <div class="col-md-3 mb-3">
                    <div class="info-card" style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; height: 100%; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-bullseye" style="font-size: 1.2rem; color: #8E6AB8; margin-right: 8px;"></i>
                            <label class="font-weight-semibold" style="color: #2c2c2c; font-size: 1rem; margin-bottom: 0;">Sector</label>
                        </div>
                        <p style="font-size: 1rem; color: #343a40; font-weight: 500; margin-bottom: 0;">{{ $committee->sector->name ?? 'No disponible' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabla de Beneficiarios -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                            <th>N°</th>
                            <th>Familiar/Apoderado(a)</th>
                            <th>Beneficiario(a)</th>
                            <th>Tipo de Documento</th>
                            <th>Parentesco</th>
                            <th>Sexo</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Edad</th>
                            <th>Condición</th>
                            <th>Fecha de Empadronamiento</th>
                            <th>Fecha de Retiro</th>
                            <th>Grado de Instrucción</th>
                            <th>Vivienda</th>
                            <th>Domicilio</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($committeeVlFamilyMembers as $register)
                            @php
                                $minors = $register->vlFamilyMember->vlMinors;
                            @endphp
                            @foreach($minors as $index => $minor)
                                <tr>
                                    @if($index === 0)  <!-- Solo para la primera fila de menores -->
                                        <td rowspan="{{ count($minors) }}" class="text-center align-middle">{{ $register->id }}</td>
                                        <td rowspan="{{ count($minors) }}" class="align-middle">
                                            <strong>{{ $register->vlFamilyMember->paternal_last_name }} {{ $register->vlFamilyMember->maternal_last_name }}</strong><br>
                                            {{ $register->vlFamilyMember->given_name }}
                                            <div class="small text-muted">
                                                <strong>
                                                    @if($register->vlFamilyMember->identity_document == 'DNI')
                                                        DNI N° 
                                                    @elseif($register->vlFamilyMember->identity_document == 'Pasaporte')
                                                        Pas. N° 
                                                    @elseif($register->vlFamilyMember->identity_document == 'Cédula')
                                                        Ced. N° 
                                                    @else
                                                        Error: 
                                                    @endif
                                                </strong>
                                                {{ $register->vlFamilyMember->id ?? 'No disponible' }}
                                            </div>
                                        </td>
                                    @endif
                                    <td>
                                        <strong>{{ $minor->paternal_last_name }} {{ $minor->maternal_last_name }}</strong><br>
                                        {{ $minor->given_name }}
                                        <div class="small text-muted">
                                            <strong>
                                                @if($minor->identity_document == 'DNI')
                                                    DNI N° 
                                                @elseif($minor->identity_document == 'Pasaporte')
                                                    Pas. N° 
                                                @elseif($minor->identity_document == 'Cédula')
                                                    Ced. N° 
                                                @else
                                                    Error: 
                                                @endif
                                            </strong>
                                            {{ $minor->id ?? 'No disponible' }}
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $minor->identity_document ?? '-' }}</td>
                                    <td class="text-center">{{ $minor->kinship ?? '-' }}</td>
                                    <td class="text-center">{{ $minor->sex_type == 0 ? 'Femenino' : ($minor->sex_type == 1 ? 'Masculino' : '-') }}</td>                                    
                                    <td class="text-center">{{ $minor->birth_date ? \Carbon\Carbon::parse($minor->birth_date)->format('d/m/Y') : '-' }}</td>
                                    <td class="text-center">
                                        {{ $minor->birth_date ? \Carbon\Carbon::parse($minor->birth_date)->age : '-' }}
                                    </td>
                                    <td class="text-center">{{ $minor->condition ?? '-' }}</td>
                                    <td class="text-center">{{ $minor->registration_date ? $minor->registration_date->format('d/m/Y') : '-' }}</td>
                                    <td class="text-center">{{ $minor->withdrawal_date ? $minor->withdrawal_date->format('d/m/Y') : 'No retirado' }}</td>
                                    <td class="text-center">{{ $minor->education_level ?? '-' }}</td>
                                    <td class="text-center">{{ $minor->dwelling_type ?? '-' }}</td>
                                    <td>{{ $minor->address ?? '-' }}</td>
                                    <td>{{ $register->description ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('committee_vl_family_members.show', $register->id) }}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('committee_vl_family_members.edit', $register->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('committee_vl_family_members.destroy', $register->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este miembro?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        /* Información del comité */
        .committee-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        /* Estilos de tabla */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            font-size: 14px;
        }

        th {
            background-color: #3B1E54 !important;
            color: white;
            vertical-align: middle !important;
        }

        td {
            vertical-align: middle !important;
        }

        /* Mejora en la tabla */
        .table-hover tbody tr:hover {
            background-color: #D4BEE4 !important;
        }

        /* Botones */
        .btn-sm {
            font-size: 12px;
            padding: 3px 7px;
        }
    </style>
@endsection