@extends('adminlte::page')

@section('title', 'Detalles del Guardián')

@section('content_header')
<h1>Detalles del Guardián</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header p-0 d-flex justify-content-center align-items-center" style="background-color: #6E8E59; height: 60px;">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="height: 80%; width: auto;">
        </div>
        <div class="card-body" style="background-color: #EAFAEA;">
            <p><strong>ID:</strong> {{ $guardian->id }}</p>
            <p><strong>Tipo de Documento:</strong> {{ $guardian->document_type }}</p>
            <p><strong>Nombre:</strong> {{ $guardian->given_name }} {{ $guardian->paternal_last_name }} {{ $guardian->maternal_last_name }}</p>
            <p><strong>Teléfono:</strong> {{ $guardian->phone_number ?? 'No registrado' }}</p>
        </div>
        <div class="card-footer d-flex justify-content-between" style="background-color: #CAE0BC;">
            <a href="{{ route('guardians.edit', $guardian->id) }}" class="btn" style="background-color: #780C28; color: white;">Editar</a>
            <a href="{{ route('guardians.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@stop