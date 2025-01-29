@extends('adminlte::page')

@section('title', 'Detalles del Adulto Mayor')

@section('content_header')
<h1 class="text-center">Detalles del Adulto Mayor</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <!-- Encabezado con logotipo y título -->
        <div class="card-header text-center" style="background-color: #6E8E59; color: white;">
            <h3 class="card-title">
                <i class="fas fa-user"></i> {{ $elderlyAdult->given_name }} {{ $elderlyAdult->paternal_last_name }} {{ $elderlyAdult->maternal_last_name }}
            </h3>
        </div>

        <div class="card-body">
            <!-- Información básica -->
            <h4 class="text-center" style="color: #6E8E59;"><i class="fas fa-id-card"></i> Datos Personales</h4>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="background-color: #CAE0BC; width: 30%;">ID</th>
                        <td>{{ $elderlyAdult->id }}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Tipo de Documento</th>
                        <td>{{ $elderlyAdult->document_type }}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Fecha de Nacimiento</th>
                        <td>{{ $elderlyAdult->birth_date->format('d/m/Y') }} ({{ $elderlyAdult->birth_date->age }} años)</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Sexo</th>
                        <td>{{ $elderlyAdult->sex_type == 0 ? 'Femenino' : 'Masculino' }}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Dirección</th>
                        <td>{{ $elderlyAdult->address ?? 'No especificado' }}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Referencia</th>
                        <td>{{ $elderlyAdult->reference ?? 'Sin referencia' }}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Teléfono</th>
                        <td>{{ $elderlyAdult->phone_number ?? 'No registrado' }}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Tipo de Discapacidad</th>
                        <td>{{ $elderlyAdult->type_of_disability ?? 'Ninguna' }}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Miembros del Hogar</th>
                        <td>{{ $elderlyAdult->household_members ?? 'No especificado' }}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Requiere Atención Permanente</th>
                        <td>{{ $elderlyAdult->permanent_attention ? 'Sí' : 'No' }}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Observaciones</th>
                        <td>{{ $elderlyAdult->observation ?? 'Sin observaciones' }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Información de relaciones con otras entidades -->
            <h4 class="mt-4 text-center" style="color: #6E8E59;"><i class="fas fa-link"></i> Información Relacionada</h4>
            <table class="table table-bordered">
                <tbody>
                    <!-- Guardianes -->
                    <tr>
                        <th style="background-color: #9cbf5c; color: white;">Guardianes</th>
                        <td>
                            @if($elderlyAdult->guardians->isEmpty())
                            No tiene guardianes registrados.
                            @else
                            <ul>
                                @foreach($elderlyAdult->guardians as $guardian)
                                <li>{{ $guardian->given_name }} {{ $guardian->paternal_last_name }} {{ $guardian->maternal_last_name }} - {{ $guardian->phone_number ?? 'Sin teléfono' }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </td>
                    </tr>

                    <!-- Ubicación -->
                    <tr>
                        <th style="background-color: #9cbf5c; color: white;">Ubicación</th>
                        <td>
                            {{ optional($elderlyAdult->location)->department ?? 'No registrado' }},
                            {{ optional($elderlyAdult->location)->province ?? 'No registrado' }},
                            {{ optional($elderlyAdult->location)->district ?? 'No registrado' }}
                        </td>
                    </tr>

                    <!-- Seguro Público -->
                    <tr>
                        <th style="background-color: #9cbf5c; color: white;">Seguro Público</th>
                        <td>{{ optional($elderlyAdult->publicInsurance)->name ?? 'No registrado' }}</td>
                    </tr>

                    <!-- Seguros Privados -->
                    <tr>
                        <th style="background-color: #9cbf5c; color: white;">Seguros Privados</th>
                        <td>
                            @if($elderlyAdult->privateInsurances->isEmpty())
                            No tiene seguros privados registrados.
                            @else
                            <ul>
                                @foreach($elderlyAdult->privateInsurances as $insurance)
                                <li>{{ $insurance->name }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </td>
                    </tr>

                    <!-- Programas Sociales -->
                    <tr>
                        <th style="background-color: #9cbf5c; color: white;">Programas Sociales</th>
                        <td>
                            @if($elderlyAdult->socialPrograms->isEmpty())
                            No pertenece a ningún programa social.
                            @else
                            <ul>
                                @foreach($elderlyAdult->socialPrograms as $program)
                                <li>{{ $program->name }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Botones de acción -->
        <div class="card-footer text-center">
            <a href="{{ route('elderly_adults.edit', $elderlyAdult->id) }}" class="btn text-white" style="background-color: #6E8E59;">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('elderly_adults.index') }}" class="btn btn-danger">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>
@stop