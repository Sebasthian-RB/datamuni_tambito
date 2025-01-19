@extends('adminlte::page')

@section('title', 'Detalle del Menor')

@section('content_header')
    <h1>Detalle del Menor</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header p-0 d-flex justify-content-center align-items-center" style="background-color: #3B1E54; height: 60px;">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="height: 80%; width: auto;">
        </div>
        <div class="card-body">
            <p><strong>Número de Identidad:</strong> {{ $vlMinor->id }}</p>
            <p><strong>Tipo de Documento:</strong> {{ $vlMinor->identity_document }}</p>
            <p><strong>Nombre:</strong> {{ $vlMinor->given_name }}</p>
            <p><strong>Apellido Paterno:</strong> {{ $vlMinor->paternal_last_name }}</p>
            <p><strong>Apellido Materno:</strong> {{ $vlMinor->maternal_last_name }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $vlMinor->birth_date->format('d/m/Y') }}</p>
            <p><strong>Sexo:</strong> {{ $vlMinor->sex_type == 0 ? 'Femenino' : 'Masculino' }}</p>
            <p><strong>Fecha de Empadronamiento:</strong> {{ $vlMinor->registration_date->format('d/m/Y') }}</p>
            <p><strong>Fecha de Retiro:</strong> {{ $vlMinor->withdrawal_date->format('d/m/Y') }}</p>
            <p><strong>Domicilio:</strong> {{ $vlMinor->address }}</p>
            <p><strong>Tipo de Vivienda:</strong> {{ $vlMinor->dwelling_type }}</p>
            <p><strong>Nivel Educativo:</strong> {{ $vlMinor->education_level }}</p>
            <p><strong>Condición:</strong> {{ $vlMinor->condition }}</p>
            <p><strong>Discapacidad:</strong> {{ $vlMinor->disability ? 'Sí' : 'No' }}</p>
            <p><strong>Familiar:</strong> {{ $vlMinor->vl_family_member_id }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('vl_minors.edit', $vlMinor->id) }}" class="btn btn-secondary" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">Editar</a>
            <a href="{{ route('vl_minors.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@stop
