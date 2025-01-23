@extends('adminlte::page')

@section('title', 'Detalles de Persona')

@section('content_header')
    <h1>Detalles de Persona</h1>
@stop

@section('content')
    <table class="table table-bordered">
        <tr>
            <th>Fecha de Registro</th>
            <td>{{ $omPerson->registration_date }}</td>
        </tr>
        <tr>
            <th>Nombre Completo</th>
            <td>{{ $omPerson->paternal_last_name }} {{ $omPerson->maternal_last_name }} {{ $omPerson->given_name }}</td>
        </tr>
        <tr>
            <th>Estado Civil</th>
            <td>{{ $omPerson->marital_status }}</td>
        </tr>
        <tr>
            <th>DNI</th>
            <td>{{ $omPerson->dni }}</td>
        </tr>
        <tr>
            <th>Fecha de Nacimiento</th>
            <td>{{ \Carbon\Carbon::parse($omPerson->birth_date)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th>Edad</th>
            <td>{{ $omPerson->age }}</td>
        </tr>
        <tr>
            <th>Género</th>
            <td>{{ $omPerson->gender }}</td>
        </tr>
        <tr>
            <th>Teléfono</th>
            <td>{{ $omPerson->phone }}</td>
        </tr>
        <tr>
            <th>Correo Electrónico</th>
            <td>{{ $omPerson->email }}</td>
        </tr>
        <tr>
            <th>Nivel Educativo</th>
            <td>{{ $omPerson->education_level }}</td>
        </tr>
        <tr>
            <th>Ocupación</th>
            <td>{{ $omPerson->occupation }}</td>
        </tr>
        <tr>
            <th>Seguro de Salud</th>
            <td>{{ $omPerson->health_insurance }}</td>
        </tr>
        <tr>
            <th>Estado de Pensión</th>
            <td>{{ $omPerson->pension_status }}</td>
        </tr>
        <tr>
            <th>Estado Laboral</th>
            <td>{{ $omPerson->employment_status }}</td>
        </tr>
        <tr>
            <th>SISFOH</th>
            <td>{{ $omPerson->sisfoh ? 'Sí' : 'No' }}</td>
        </tr>
        <tr>
            <th>Vivienda</th>
            <td>{{ $omPerson->dwelling ? $omPerson->dwelling->exact_location : 'No asignada' }}</td>
        </tr>
        <tr>
            <th>Discapacidad</th>
            <td>{{ $omPerson->disability ? $omPerson->disability->certificate_number : 'No' }}</td>
        </tr>
        <tr>
            <th>Cuidador</th>
            <td>{{ $omPerson->caregiver ? $omPerson->caregiver->full_name : 'No asignado' }}</td>
        </tr>
        <tr>
            <th>Necesidad de Asistencia Personal</th>
            <td>{{ $omPerson->personal_assistance_need }}</td>
        </tr>
        <tr>
            <th>Notas sobre Autonomía</th>
            <td>{{ $omPerson->autonomy_notes }}</td>
        </tr>
        <tr>
            <th>Observaciones</th>
            <td>{{ $omPerson->observations }}</td>
        </tr>
    </table>

    <a href="{{ route('om-people.index') }}" class="btn btn-secondary">Volver al listado</a>
@stop
