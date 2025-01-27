@extends('adminlte::page')

@section('title', 'Padrón de Beneficiarios')

@section('content_header')
    <h1>PADRÓN DE BENEFICIARIOS DEL PROGRAMA VASO DE LECHE</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('committee_vl_family_members.create') }}" class="btn mb-3" style="background-color: #9B7EBD; color: white;">Agregar Beneficiario</a>
    <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-secondary mb-3">Volver</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Información del Comité -->
    <section class="committee-info mb-4">
        <div class="info-block">
            <span class="label">Ubicación Geográfica:</span>
            <span class="value">EL TAMBO - HUANCAYO - JUNÍN</span>
        </div>
        <div class="info-block">
            <span class="label">Nombre del Comité:</span>
            <span class="value">{{ $committee->name ?? 'No disponible' }}</span>
        </div>
        <div class="info-block">
            <span class="label">Presidente(a):</span>
            <span class="value">{{ $committee->president ?? 'No disponible' }}</span>
        </div>
        <div class="info-block">
            <span class="label">Fecha de Creación:</span>
            <span class="value">{{ $committee->created_at ? $committee->created_at->format('d/m/Y') : 'No disponible' }}</span>
        </div>
        <div class="info-block">
            <span class="label">Sector:</span>
            <span class="value">{{ $committee->sector->name ?? 'No disponible' }}</span>
        </div>
    </section>

    <!-- Tabla de Beneficiarios -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Miembros Registrados</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>N°</th>
                            <th>APELLIDOS Y NOMBRES DE LA MADRE Y/O APODERADO</th>
                            <th>APELLIDOS Y NOMBRES DEL BENEFICIARIO</th>
                            <th class="rotate">TIPO DE DOCUMENTO</th>
                            <th class="rotate">PARENTESCO</th>
                            <th class="rotate">SEXO</th>
                            <th>FECHA DE NACIMIENTO</th>
                            <th>EDAD</th>
                            <th>CONDICIÓN</th>
                            <th>FECHA DE EMPADRONAMIENTO</th>
                            <th>FECHA DE RETIRO</th>
                            <th class="rotate">GRADO DE INSTRUCCIÓN</th>
                            <th class="rotate">VIVIENDA</th>
                            <th>DOMICILIO</th>
                            <th>OBSERVACIONES</th>
                            <th>ACCIONES</th>
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
                                        <td rowspan="{{ count($minors) }}">{{ $register->id }}</td>
                                        <td rowspan="{{ count($minors) }}">
                                            <div>
                                                {{ $register->vlFamilyMember->paternal_last_name }} {{ $register->vlFamilyMember->maternal_last_name }}<br>
                                                {{ $register->vlFamilyMember->given_name }}
                                            </div>
                                            <div style="font-size: 12px;">
                                                <strong>
                                                    @if($register->vlFamilyMember->identity_document == 'DNI')
                                                        DNI N° 
                                                    @elseif($register->vlFamilyMember->identity_document == 'Pasaporte')
                                                        Pas. N° 
                                                    @elseif($register->vlFamilyMember->identity_document == 'Cédula de extranjería')
                                                        Ced. N° 
                                                    @else
                                                        Error: 
                                                    @endif
                                                </strong>
                                                {{ $register->vlFamilyMember->id ?? 'No disponible' }}
                                            </div>
                                        </td>
                                    @endif
                                    <td>{{ $minor->paternal_last_name }} {{ $minor->maternal_last_name }}<br>{{ $minor->given_name }}</td>
                                    <td class="rotate">{{ $minor->identity_document ?? 'No disponible' }}</td>
                                    <td class="rotate">{{ $minor->kinship ?? 'No disponible' }}</td>
                                    <td class="rotate">{{ $minor->sex_type ?? 'No disponible' }}</td>
                                    <td>{{ $minor->birth_date ?? 'No disponible' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($minor->birth_date)->age ?? 'No disponible' }}</td>
                                    <td>{{ $minor->condition ?? 'No disponible' }}</td>
                                    <td>{{ $minor->registration_date ? $minor->registration_date->format('d/m/Y') : 'No disponible' }}</td>
                                    <td>{{ $minor->withdrawal_date ? $minor->withdrawal_date->format('d/m/Y') : 'No retirado' }}</td>
                                    <td class="rotate">{{ $minor->education_level ?? 'No disponible' }}</td>
                                    <td class="rotate">{{ $minor->dwelling_type ?? 'No disponible' }}</td>
                                    <td>{{ $minor->address ?? 'No disponible' }}</td>
                                    <td>{{ $register->description }}</td>
                                    <td>
                                        <a href="{{ route('committee_vl_family_members.show', $register->id) }}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('committee_vl_family_members.edit', $register->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('committee_vl_family_members.destroy', $register->id) }}" method="POST" style="display:inline-block;">
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

        .info-block {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f7f7f7;
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .info-block .label {
            font-weight: bold;
            color: #555;
        }

        .info-block .value {
            color: #333;
        }

        /* Tabla */
        th.rotate, td.rotate {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            white-space: nowrap;
            height: 120px;
            width: 30px;
            text-align: center;
            vertical-align: middle;
            font-size: 10px;
            overflow: hidden;
        }

        .table-hover tbody tr:hover {
            background-color: #f0f8ff;
        }
    </style>
@endsection