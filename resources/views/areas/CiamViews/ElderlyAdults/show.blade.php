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
                        <th style="background-color: #CAE0BC;">Idioma(s)</th>
                        <td>
                            @if ($elderlyAdult->language && count($elderlyAdult->language) > 0)
                            @foreach ($elderlyAdult->language as $lang)
                            <span class="badge bg-info">{{ $lang }}</span>
                            @endforeach
                            @else
                            <span class="text-muted">No especificado</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Estado</th>
                        <td>
                            @if ($elderlyAdult->state)
                            <span class="badge bg-success">Activo</span>
                            @else
                            <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </td>
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
                        <td>
                            @if ($elderlyAdult->type_of_disability && count($elderlyAdult->type_of_disability) > 0)
                            @foreach ($elderlyAdult->type_of_disability as $disability)
                            <span class="badge bg-info">{{ $disability }}</span>
                            @endforeach
                            @else
                            <span class="text-muted">Ninguna</span>
                            @endif
                        </td>
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

            <!-- Información Relacionada -->
            <h4 class="mt-4 text-center" style="color: #6E8E59;"><i class="fas fa-link"></i> Información Relacionada</h4>
            <table class="table table-bordered">
                <tbody>
                    <!-- Guardian -->
                    <tr>
                        <th style="background-color: #9cbf5c; color: white;">Guardían</th>
                        <td>
                            @if($elderlyAdult->guardian)
                            {{ $elderlyAdult->guardian->given_name }} {{ $elderlyAdult->guardian->paternal_last_name }} - {{ $elderlyAdult->guardian->phone_number ?? 'Sin teléfono' }}
                            <br><strong>Relación:</strong> {{ $elderlyAdult->guardian->display_relationship }}
                            @else
                            No tiene guardián registrado.
                            @endif
                        </td>
                    </tr>

                    <!-- Seguro Público -->
                    <tr>
                        <th style="background-color: #9cbf5c; color: white;">Seguro Público</th>
                        <td>{{ $elderlyAdult->public_insurance ?? 'No registrado' }}</td>
                    </tr>

                    <!-- Seguro Privado -->
                    <tr>
                        <th style="background-color: #9cbf5c; color: white;">Seguro Privado</th>
                        <td>{{ $elderlyAdult->private_insurance ?? 'No registrado' }}</td>
                    </tr>

                    <!-- Programas Sociales -->
                    <tr>
                        <th style="background-color: #9cbf5c; color: white;">Programas Sociales</th>
                        <td>
                            @if ($elderlyAdult->social_program && count($elderlyAdult->social_program) > 0)
                            @foreach ($elderlyAdult->social_program as $program)
                            <span class="badge bg-warning">{{ $program }}</span>
                            @endforeach
                            @else
                            <p>No pertenece a ningún programa social.</p>
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