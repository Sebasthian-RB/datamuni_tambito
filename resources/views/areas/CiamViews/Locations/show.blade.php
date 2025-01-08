@extends('adminlte::page')

@section('title', 'Detalles de la Ubicación')

@section('content_header')
<h1>Detalles de la Ubicación</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <p><strong>ID:</strong> {{ $location->id }}</p>
        <p><strong>Nombre:</strong> {{ $location->location_name }}</p>
        <p><strong>Región:</strong> {{ $location->region }}</p>
        <p><strong>País:</strong> {{ $location->country }}</p>
        <a href="{{ route('locations.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@stop