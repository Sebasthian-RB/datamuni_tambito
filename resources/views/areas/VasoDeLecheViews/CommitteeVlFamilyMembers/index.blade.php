@extends('adminlte::page')

@section('title', 'Padrón de Beneficiarios')

@section('content_header')
    <h1>Padrón de Beneficiarios</h1>
@stop

@section('css')
  <style>
    /* Reducir tamaño de las celdas */
    .table th, .table td {
        font-size: 12px;
        padding: 8px;
    }

    /* Ajustar las celdas rotadas */
    .rotate-text {
        transform: rotate(90deg);
        white-space: nowrap;
        text-align: center;
        vertical-align: middle;
        height: 120px;
        width: 50px;
    }

    /* Mejorar responsividad en pantallas pequeñas */
    @media (max-width: 768px) {
        .table th, .table td {
            font-size: 10px;
        }

        .table th.rotate-text {
            font-size: 10px;
        }
    }
  </style>
@endsection

@section('content')
<div class="container">
    <a href="{{ route('committee_vl_family_members.create') }}" class="btn mb-3" style="background-color: #9B7EBD; color: white;">Agregar Beneficiario</a>
    <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-secondary mb-3">Volver</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Miembros Registrados</h3>
        </div>
        <div class="card-body">
            <!-- Usamos la clase table-responsive de AdminLTE -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>N°</th>
                            <th>APELLIDOS Y NOMBRES DE LA MADRE Y/O APODERADO</th>
                            <th>APELLIDOS Y NOMBRES DEL BENEFICIARIO</th>
                            <th class="rotate-text">TIPO DE DOCUMENTO DE IDENTIDAD</th>
                            <th class="rotate-text">PARENTESCO</th>
                            <th class="rotate-text">SEXO</th>
                            <th>FECHA DE NACIMIENTO</th>
                            <th>EDAD</th>
                            <th>CONDICIÓN</th>
                            <th>FECHA DE EMPADRONAMIENTO</th>
                            <th>FECHA DE RETIRO</th>
                            <th class="rotate-text">GRADO DE INSTRUCCIÓN</th>
                            <th class="rotate-text">VIVIENDA</th>
                            <th>DOMICILIO</th>
                            <th>OBSERVACIONES</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($committeeVlFamilyMembers as $register)
                            @php
                                $minors = $register->vlFamilyMember->vlMinors; // Todos los menores asociados al apoderado
                            @endphp

                            <!-- Iteramos sobre los menores, generando una fila por cada uno -->
                            @foreach($minors as $index => $minor)
                                <tr>
                                    <!-- Si es el primer menor, mostramos el número y los datos del apoderado, y combinamos las celdas -->
                                    @if($index === 0)
                                        <td rowspan="{{ count($minors) }}">{{ $register->id }}</td>
                                        <td rowspan="{{ count($minors) }}">
                                            {{ $register->vlFamilyMember->paternal_last_name }} {{ $register->vlFamilyMember->maternal_last_name }}<br>
                                            {{ $register->vlFamilyMember->given_name }}
                                        </td>
                                    @endif

                                    <!-- Información del beneficiario -->
                                    <td>{{ $minor->paternal_last_name }} {{ $minor->maternal_last_name }}<br>{{ $minor->given_name }}</td>
                                    <td>{{ $minor->identity_document ?? 'No disponible' }}</td>
                                    <td>{{ $minor->kinship ?? 'No disponible' }}</td>
                                    <td>{{ $minor->sex_type ?? 'No disponible' }}</td>
                                    <td>{{ $minor->birth_date ?? 'No disponible' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($minor->birth_date)->age ?? 'No disponible' }}</td>
                                    <td>{{ $minor->condition ?? 'No disponible' }}</td>
                                    <td>{{ $minor->registration_date ? $minor->registration_date->format('d/m/Y') : 'No disponible' }}</td>
                                    <td>{{ $minor->withdrawal_date ? $minor->withdrawal_date->format('d/m/Y') : 'No retirado' }}</td>
                                    <td>{{ $minor->education_level ?? 'No disponible' }}</td>
                                    <td>{{ $minor->dwelling_type ?? 'No disponible' }}</td>
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
