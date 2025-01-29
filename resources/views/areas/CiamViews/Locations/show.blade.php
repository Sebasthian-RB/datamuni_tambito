@extends('adminlte::page')

@section('title', 'Detalle de la Localidad')

@section('content_header')
<h1>Detalle de la Localidad</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <!-- Encabezado con logotipo -->
        <div class="card-header p-0 d-flex justify-content-center align-items-center" style="background-color: #708F3A; height: 60px;">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="height: 80%; width: auto;">
        </div>
        <!-- Contenido del cuerpo -->
        <div class="card-body">
            <p><strong>ID:</strong> {{ $location->id }}</p>
            <p><strong>Departamento:</strong> {{ $location->department }}</p>
            <p><strong>Provincia:</strong> {{ $location->province }}</p>
            <p><strong>Distrito:</strong> {{ $location->district }}</p>
        </div>
        <!-- Pie de la tarjeta con botones -->
        <div class="card-footer">
            <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-secondary" style="background-color: #9CC36A; color: white;">Editar</a>
            <a href="{{ route('locations.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@stop