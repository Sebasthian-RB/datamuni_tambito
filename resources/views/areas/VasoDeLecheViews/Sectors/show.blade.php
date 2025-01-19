@extends('adminlte::page')

@section('title', 'Detalle del Sector')

@section('content_header')
    <h1>Detalle del Sector</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header p-0 d-flex justify-content-center align-items-center" style="background-color: #3B1E54; height: 60px;">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="height: 80%; width: auto;">
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $sector->id }}</p>
            <p><strong>Nombre:</strong> {{ $sector->name }}</p>
            <p><strong>Responsable:</strong> {{ $sector->responsible_person }}</p>
            <p><strong>Descripción:</strong> 
                @if($sector->description)
                    {{ $sector->description }}
                @else
                    <span class="text-secondary"> (Sin descripción)</span>
                @endif
            </p>             
        </div>
        <div class="card-footer">
            <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-secondary" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">Editar</a>
            <a href="{{ route('sectors.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@stop
