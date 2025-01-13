@extends('adminlte::page')

@section('title', 'Detalle del Comité')

@section('content_header')
    <h1>Detalle del Comité</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success p-0 d-flex justify-content-center align-items-center" style="height: 60px;">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="height: 80%; width: auto;">
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $committee->id }}</p>
            <p><strong>Nombre del Comité:</strong> {{ $committee->name }}</p>
            <p><strong>Apellido Paterno del Presidente(a):</strong> {{ $committee->president_paternal_surname }}</p>
            <p><strong>Apellido Materno del Presidente(a):</strong> {{ $committee->president_maternal_surname }}</p>
            <p><strong>Nombres del Presidente(a):</strong> {{ $committee->president_given_name }}</p>
            <p><strong>Núcleo Urbano:</strong> {{ $committee->urban_core }}</p>
            <p><strong>Beneficiarios:</strong> {{ $committee->beneficiaries_count }}</p>
            <p><strong>Sector:</strong> {{ $committee->sector->name }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('committees.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@stop
