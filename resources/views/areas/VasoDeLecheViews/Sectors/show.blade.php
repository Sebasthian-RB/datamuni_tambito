@extends('adminlte::page')

@section('title', 'Detalle del Sector')

@section('content_header')
    <h1>Detalle del Sector</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Información del Sector</h3>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $sector->id }}</p>
            <p><strong>Nombre:</strong> {{ $sector->name }}</p>
            <p><strong>Descripción:</strong> {{ $sector->description ?? 'Sin descripción' }}</p>
            <p><strong>Responsable:</strong> {{ $sector->responsible_person }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('sectors.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@stop
