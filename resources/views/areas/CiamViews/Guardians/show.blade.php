@extends('adminlte::page')

@section('title', 'Detalles del Guardián')

@section('content_header')
<h1>Detalles del Guardián</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <h5><strong>ID:</strong> {{ $guardian->id }}</h5>
        <h5><strong>Tipo de Documento:</strong> {{ $guardian->document_type }}</h5>
        <h5><strong>Nombre:</strong> {{ $guardian->given_name }} {{ $guardian->paternal_last_name }} {{ $guardian->maternal_last_name }}</h5>
        <h5><strong>Teléfono:</strong> {{ $guardian->phone_number }}</h5>

        <a href="{{ route('guardians.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@stop