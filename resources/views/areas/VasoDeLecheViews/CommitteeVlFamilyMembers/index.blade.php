@extends('adminlte::page')

@section('title', 'Padrón de Beneficiarios')

@section('content_header')
    <h1>PADRÓN DE BENEFICIARIOS DEL PROGRAMA VASO DE LECHE</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{ route('committee_vl_family_members.create', ['committee_id' => $committee->id]) }}" class="btn mb-3"
            style="background-color: #9B7EBD; color: white;">Agregar Beneficiario</a>
        <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-secondary mb-3">Volver</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <section class="card shadow-sm"
            style="border-radius: 15px; border: none; overflow: hidden; background-color: #ffffff;">
            <!-- Encabezado con gradiente y sombra -->
            <div class="card-header"
                style="background: linear-gradient(135deg, #8E6AB8, #6A4A8E); border: none; padding: 20px;">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <h4 class="font-weight-bold text-white"
                            style="font-size: 1.8rem; letter-spacing: 1px; margin-bottom: 5px;">
                            <i class="fas fa-users"
                                style="font-size: 1.6rem; margin-right: 10px; vertical-align: middle;"></i>
                            Padrón de Beneficiarios de <span
                                style="font-weight: 800; color: #f5f5f5;">{{ $committee->name ?? 'No disponible' }}</span>
                        </h4>
                        <p class="text-white" style="font-size: 1rem; opacity: 0.9; margin-bottom: 0;">Consulta y gestión de
                            los beneficiarios registrados en el comité</p>
                    </div>
                    <div class="col-md-3 text-md-right">
                        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
                            style="max-height: 60px; border-radius: 8px;">
                    </div>
                </div>
            </div>

            <!-- Cuerpo de la tarjeta con información organizada -->
            <div class="card-body" style="padding: 20px;">
                <div class="row">
                    <!-- Columna 1: Presidente(a) -->
                    <div class="col-md-3 mb-3">
                        <div class="info-card"
                            style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; height: 100%; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-user-tie"
                                    style="font-size: 1.2rem; color: #8E6AB8; margin-right: 8px;"></i>
                                <label class="font-weight-semibold"
                                    style="color: #2c2c2c; font-size: 1rem; margin-bottom: 0;">Presidente(a)</label>
                            </div>
                            <p style="font-size: 1rem; color: #343a40; font-weight: 500; margin-bottom: 0;">
                                {{ $committee->president ?? 'No disponible' }}</p>
                        </div>
                    </div>

                    <!-- Columna 2: Urban Core -->
                    <div class="col-md-3 mb-3">
                        <div class="info-card"
                            style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; height: 100%; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-city" style="font-size: 1.2rem; color: #8E6AB8; margin-right: 8px;"></i>
                                <label class="font-weight-semibold"
                                    style="color: #2c2c2c; font-size: 1rem; margin-bottom: 0;">Urban Core</label>
                            </div>
                            <p style="font-size: 1rem; color: #343a40; font-weight: 500; margin-bottom: 0;">
                                {{ $committee->urban_core ?? 'No disponible' }}</p>
                        </div>
                    </div>

                    <!-- Columna 3: Sector -->
                    <div class="col-md-3 mb-3">
                        <div class="info-card"
                            style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; height: 100%; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-bullseye"
                                    style="font-size: 1.2rem; color: #8E6AB8; margin-right: 8px;"></i>
                                <label class="font-weight-semibold"
                                    style="color: #2c2c2c; font-size: 1rem; margin-bottom: 0;">Sector</label>
                            </div>
                            <p style="font-size: 1rem; color: #343a40; font-weight: 500; margin-bottom: 0;">
                                {{ $committee->sector->name ?? 'No disponible' }}</p>
                        </div>
                    </div>

                    <!-- Columna 4: Exportar -->
                    <div class="col-md-3 mb-3">
                        <div class="info-card"
                            style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; height: 100%; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-download"
                                    style="font-size: 1.2rem; color: #8E6AB8; margin-right: 8px;"></i>
                                <label class="font-weight-semibold"
                                    style="color: #2c2c2c; font-size: 1rem; margin-bottom: 0;">Exportar</label>
                            </div>
                            <!-- Botón para exportar Excel -->
                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <a href="{{ route('export.vaso-de-leche', $committee->id) }}" class="btn btn-success">Descargar Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Nota informativa -->
                <div class="alert alert-info p-2 mb-0" style="font-size: 0.8rem; border-radius: 5px;">
                    <i class="fas fa-info-circle mr-1"></i> El documento exportado incluye solo familiares y menores activos en el comité.
                </div>
            </div>
        </section>

        <!-- Pestañas para activos/inactivos -->
        <ul class="nav nav-tabs" id="beneficiaryTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">
                    Beneficiarios Activos <span class="badge badge-primary">{{ $activeCount }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inactive-tab" data-toggle="tab" href="#inactive" role="tab" aria-controls="inactive" aria-selected="false">
                    Beneficiarios Inactivos <span class="badge badge-secondary">{{ $inactiveCount }}</span>
                </a>
            </li>
        </ul>

        <!-- Contenido de las pestañas -->
        <div class="tab-content" id="beneficiaryTabsContent">
            <!-- Tabla de Beneficiarios Activos -->
            <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
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
                                        <th>Estado</th>
                                        <th>Editar</th>
                                        <th>Observaciones</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activeCommitteeVlFamilyMembers as $register)
                                        @php
                                            $minors = $register->vlFamilyMember->vlMinors;
                                            $rowNumber = $loop->iteration;
                                        @endphp

                                        @if ($minors->isEmpty())
                                            <!-- Si no tiene menores, mostrar solo el familiar -->
                                            <tr>
                                                <td class="text-center align-middle">{{ $rowNumber }}</td>
                                                <td class="align-middle">
                                                    <strong>{{ $register->vlFamilyMember->paternal_last_name }}
                                                        {{ $register->vlFamilyMember->maternal_last_name }}</strong><br>
                                                    {{ $register->vlFamilyMember->given_name }}
                                                    <div class="small text-muted">
                                                        <strong>
                                                            @if ($register->vlFamilyMember->identity_document == 'DNI')
                                                                DNI N°
                                                            @elseif($register->vlFamilyMember->identity_document == 'Carnet de Extranjería')
                                                                Car. Extr. N°
                                                            @elseif($register->vlFamilyMember->identity_document == 'Pasaporte')
                                                                Pas. N°
                                                            @elseif($register->vlFamilyMember->identity_document == 'Otro')
                                                                Doc. N°
                                                            @else
                                                                Error:
                                                            @endif
                                                        </strong>
                                                        {{ $register->vlFamilyMember->id ?? 'No disponible' }}
                                                    </div>
                                                </td>
                                                <td colspan="15" class="text-center">No tiene menores registrados</td>
                                                <td class="text-center">
                                                    <a href="{{ route('committee_vl_family_members.show', $register->id) }}"
                                                        class="btn btn-info btn-sm">Ver</a>
                                                    <a href="{{ route('committee_vl_family_members.edit', $register->id) }}"
                                                        class="btn btn-warning btn-sm">Editar</a>
                                                    <form
                                                        action="{{ route('committee_vl_family_members.destroy', $register->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('¿Está seguro de eliminar este miembro?')">Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @else
                                            <!-- Si tiene menores, mostrarlos normalmente -->
                                            @foreach ($minors as $index => $minor)
                                            <tr @if($minor->birth_date && \Carbon\Carbon::parse($minor->birth_date)->age > 7) style="background-color: #ffe6e6;" @endif>
                                                    @if ($index === 0)
                                                        <!-- Solo para la primera fila de menores -->
                                                        <td rowspan="{{ count($minors) }}" class="text-center align-middle">
                                                            {{ $rowNumber  }}</td>
                                                        <td rowspan="{{ count($minors) }}" class="align-middle">
                                                            <strong>{{ $register->vlFamilyMember->paternal_last_name }}
                                                                {{ $register->vlFamilyMember->maternal_last_name }}</strong><br>
                                                            {{ $register->vlFamilyMember->given_name }}
                                                            <div class="small text-muted">
                                                                <strong>
                                                                    @if ($register->vlFamilyMember->identity_document == 'DNI')
                                                                        DNI N°
                                                                    @elseif($register->vlFamilyMember->identity_document == 'Carnet de Extranjería')
                                                                        Car. Extr. N°
                                                                    @elseif($register->vlFamilyMember->identity_document == 'Pasaporte')
                                                                        Pas. N°
                                                                    @elseif($register->vlFamilyMember->identity_document == 'Otro')
                                                                        Doc. N°
                                                                    @else
                                                                        Error:
                                                                    @endif
                                                                </strong>
                                                                {{ $register->vlFamilyMember->id ?? 'No disponible' }}
                                                            </div>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <strong>{{ $minor->paternal_last_name }}
                                                            {{ $minor->maternal_last_name }}</strong><br>
                                                        {{ $minor->given_name }}
                                                        <div class="small text-muted">
                                                            <strong>
                                                                @if ($minor->identity_document == 'DNI')
                                                                    DNI N°
                                                                @elseif($minor->identity_document == 'CNV')
                                                                    CNV N°
                                                                @elseif($minor->identity_document == 'Carnet de Extranjería')
                                                                    Car. Extr. N°
                                                                @elseif($minor->identity_document == 'Pasaporte')
                                                                    Pas. N°
                                                                @elseif($minor->identity_document == 'Otro')
                                                                    Doc. N°
                                                                @else
                                                                    Error:
                                                                @endif
                                                            </strong>
                                                            {{ $minor->id ?? 'No disponible' }}
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{ $minor->identity_document ?? '-' }}</td>
                                                    <td class="text-center">{{ $minor->kinship ?? '-' }}</td>
                                                    <td class="text-center">
                                                        {{ $minor->sex_type == 0 ? 'Femenino' : ($minor->sex_type == 1 ? 'Masculino' : '-') }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $minor->birth_date ? \Carbon\Carbon::parse($minor->birth_date)->format('d/m/Y') : '-' }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($minor->birth_date)
                                                            @php
                                                                $age = \Carbon\Carbon::parse($minor->birth_date)->age;
                                                            @endphp
                                                            
                                                            @if($age > 7)
                                                                <span class="text-danger font-weight-bold" title="Edad superior al límite permitido">
                                                                    {{ $age }} <i class="fas fa-exclamation-circle"></i>
                                                                </span>
                                                            @else
                                                                {{ $age }}
                                                            @endif
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $minor->condition ?? '-' }}</td>
                                                    <td class="text-center">
                                                        {{ $minor->registration_date ? $minor->registration_date->format('d/m/Y') : '-' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $minor->withdrawal_date ? $minor->withdrawal_date->format('d/m/Y') : 'No retirado' }}
                                                    </td>
                                                    <td class="text-center">{{ $minor->education_level ?? '-' }}</td>
                                                    <td class="text-center">{{ $minor->dwelling_type ?? '-' }}</td>
                                                    <td>{{ $minor->address ?? '-' }}</td>
                                                    <td class="text-center align-middle">
                                                        @if($minor->status == 1)
                                                            <span class="badge bg-success">Activo</span>
                                                        @else
                                                            <span class="badge bg-secondary">Inactivo</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <a href="{{ route('vl_minors.edit', $minor->id) }}" 
                                                           class="btn btn-sm" 
                                                           target="_blank"
                                                           style="background-color: #8E6AB8; color: white; font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </a>
                                                    </td>
                                                    @if ($index === 0)
                                                        <td rowspan="{{ count($minors) }}" class="text-center align-middle">{{ $register->description ?? '-' }}</td>
                                                    @endif
                                                    @if ($index === 0)
                                                        <!-- Solo para la primera fila de menores -->
                                                        <td rowspan="{{ count($minors) }}" class="text-center align-middle">
                                                            <a href="{{ route('committee_vl_family_members.show', $register->id) }}"
                                                                class="btn btn-info btn-sm">Ver</a>
                                                            <a href="{{ route('committee_vl_family_members.edit', $register->id) }}"
                                                                class="btn btn-warning btn-sm">Editar</a>
                                                            <form
                                                                action="{{ route('committee_vl_family_members.destroy', $register->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('¿Está seguro de eliminar este miembro?')">Eliminar</button>
                                                            </form>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Beneficiarios Inactivos -->
            <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-secondary text-white text-center">
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
                                    @foreach ($inactiveCommitteeVlFamilyMembers as $register)
                                        @php
                                            $minors = $register->vlFamilyMember->vlMinors;
                                            $rowNumber = $loop->iteration; // Numeración secuencial independiente para inactivos
                                        @endphp

                                        @if ($minors->isEmpty())
                                            <!-- Si no tiene menores, mostrar solo el familiar -->
                                            <tr>
                                                <td class="text-center align-middle">{{ $rowNumber }}</td>
                                                <td class="align-middle">
                                                    <strong>{{ $register->vlFamilyMember->paternal_last_name }}
                                                        {{ $register->vlFamilyMember->maternal_last_name }}</strong><br>
                                                    {{ $register->vlFamilyMember->given_name }}
                                                    <div class="small text-muted">
                                                        <strong>
                                                            @if ($register->vlFamilyMember->identity_document == 'DNI')
                                                                DNI N°
                                                            @elseif($register->vlFamilyMember->identity_document == 'Carnet de Extranjería')
                                                                Car. Extr. N°
                                                            @elseif($register->vlFamilyMember->identity_document == 'Pasaporte')
                                                                Pas. N°
                                                            @elseif($register->vlFamilyMember->identity_document == 'Otro')
                                                                Doc. N°
                                                            @else
                                                                Error:
                                                            @endif
                                                        </strong>
                                                        {{ $register->vlFamilyMember->id ?? 'No disponible' }}
                                                    </div>
                                                </td>
                                                <td colspan="13" class="text-center">No tiene menores registrados</td>
                                                <td class="text-center">
                                                    <a href="{{ route('committee_vl_family_members.show', $register->id) }}"
                                                        class="btn btn-info btn-sm">Ver</a>
                                                    <a href="{{ route('committee_vl_family_members.edit', $register->id) }}"
                                                        class="btn btn-warning btn-sm">Editar</a>
                                                    <form
                                                        action="{{ route('committee_vl_family_members.destroy', $register->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('¿Está seguro de eliminar este miembro?')">Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @else
                                            <!-- Si tiene menores, mostrarlos normalmente -->
                                            @foreach ($minors as $index => $minor)
                                            <tr @if($minor->birth_date && \Carbon\Carbon::parse($minor->birth_date)->age > 7) style="background-color: #ffe6e6;" @endif>
                                                    @if ($index === 0)
                                                        <!-- Solo para la primera fila de menores -->
                                                        <td rowspan="{{ count($minors) }}" class="text-center align-middle">
                                                            {{ $rowNumber }}</td>
                                                        <td rowspan="{{ count($minors) }}" class="align-middle">
                                                            <strong>{{ $register->vlFamilyMember->paternal_last_name }}
                                                                {{ $register->vlFamilyMember->maternal_last_name }}</strong><br>
                                                            {{ $register->vlFamilyMember->given_name }}
                                                            <div class="small text-muted">
                                                                <strong>
                                                                    @if ($register->vlFamilyMember->identity_document == 'DNI')
                                                                        DNI N°
                                                                    @elseif($register->vlFamilyMember->identity_document == 'Carnet de Extranjería')
                                                                        Car. Extr. N°
                                                                    @elseif($register->vlFamilyMember->identity_document == 'Pasaporte')
                                                                        Pas. N°
                                                                    @elseif($register->vlFamilyMember->identity_document == 'Otro')
                                                                        Doc. N°
                                                                    @else
                                                                        Error:
                                                                    @endif
                                                                </strong>
                                                                {{ $register->vlFamilyMember->id ?? 'No disponible' }}
                                                            </div>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <strong>{{ $minor->paternal_last_name }}
                                                            {{ $minor->maternal_last_name }}</strong><br>
                                                        {{ $minor->given_name }}
                                                        <div class="small text-muted">
                                                            <strong>
                                                                @if ($minor->identity_document == 'DNI')
                                                                    DNI N°
                                                                @elseif($minor->identity_document == 'CNV')
                                                                    CNV N°
                                                                @elseif($minor->identity_document == 'Carnet de Extranjería')
                                                                    Car. Extr. N°
                                                                @elseif($minor->identity_document == 'Pasaporte')
                                                                    Pas. N°
                                                                @elseif($minor->identity_document == 'Otro')
                                                                    Doc. N°
                                                                @else
                                                                    Error:
                                                                @endif
                                                            </strong>
                                                            {{ $minor->id ?? 'No disponible' }}
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{ $minor->identity_document ?? '-' }}</td>
                                                    <td class="text-center">{{ $minor->kinship ?? '-' }}</td>
                                                    <td class="text-center">
                                                        {{ $minor->sex_type == 0 ? 'Femenino' : ($minor->sex_type == 1 ? 'Masculino' : '-') }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $minor->birth_date ? \Carbon\Carbon::parse($minor->birth_date)->format('d/m/Y') : '-' }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($minor->birth_date)
                                                            @php
                                                                $age = \Carbon\Carbon::parse($minor->birth_date)->age;
                                                            @endphp
                                                            
                                                            @if($age > 7)
                                                                <span class="text-danger font-weight-bold" title="Edad superior al límite permitido">
                                                                    {{ $age }} <i class="fas fa-exclamation-circle"></i>
                                                                </span>
                                                            @else
                                                                {{ $age }}
                                                            @endif
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $minor->condition ?? '-' }}</td>
                                                    <td class="text-center">
                                                        {{ $minor->registration_date ? $minor->registration_date->format('d/m/Y') : '-' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $minor->withdrawal_date ? $minor->withdrawal_date->format('d/m/Y') : 'No retirado' }}
                                                    </td>
                                                    <td class="text-center">{{ $minor->education_level ?? '-' }}</td>
                                                    <td class="text-center">{{ $minor->dwelling_type ?? '-' }}</td>
                                                    <td>{{ $minor->address ?? '-' }}</td>
                                                    @if ($index === 0)
                                                        <td rowspan="{{ count($minors) }}" class="text-center align-middle">{{ $register->description ?? '-' }}</td>
                                                    @endif
                                                    @if ($index === 0)
                                                        <!-- Solo para la primera fila de menores -->
                                                        <td rowspan="{{ count($minors) }}" class="text-center align-middle">
                                                            <a href="{{ route('committee_vl_family_members.show', $register->id) }}"
                                                                class="btn btn-info btn-sm">Ver</a>
                                                            <a href="{{ route('committee_vl_family_members.edit', $register->id) }}"
                                                                class="btn btn-warning btn-sm">Editar</a>
                                                            <form
                                                                action="{{ route('committee_vl_family_members.destroy', $register->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('¿Está seguro de eliminar este miembro?')">Eliminar</button>
                                                            </form>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

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


        /* Estilos por defecto de Bootstrap para nav-tabs */
        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
        }

        .nav-tabs .nav-item {
            margin-bottom: -1px;
        }

        .nav-tabs .nav-link {
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            color: #495057;
            padding: 0.5rem 1rem;
        }

        .nav-tabs .nav-link:hover {
            border-color: #e9ecef #e9ecef #dee2e6;
            isolation: isolate;
        }

        .nav-tabs .nav-link.active {
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
            color: #9B7EBD;
        }

        /* Badges por defecto */
        .badge-primary {
            color: #fff;
            background-color: #9B7EBD;
        }

        .badge-secondary {
            color: #fff;
            background-color: #6c757d;
        }
    </style>
@endsection
