@extends('adminlte::page')

@section('title', 'Detalles de Relación de Violencia')

@section('content_header')
    <h1>Detalles de Relación de Violencia</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-info">
        <h3 class="card-title">Detalles</h3>
        <div class="card-tools">
            <a href="{{ route('am_person_violences.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
    <div class="card-body">
        <p><strong>Persona:</strong> {{ $amPersonViolence->amPerson->given_name }} {{ $amPersonViolence->amPerson->paternal_last_name }}</p>
        <p><strong>Tipo de Violencia:</strong> {{ $amPersonViolence->violence->kind_violence }}</p>
        <p><strong>Fecha de Registro:</strong> {{ $amPersonViolence->registration_date->format('d/m/Y H:i') }}</p>
    </div>
</div>
@endsection
