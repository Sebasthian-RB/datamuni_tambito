@extends('adminlte::page')

@section('title', 'Detalle de Relación')

@section('content_header')
<h1>Detalle de Relación Adulto Mayor - Guardián</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <p><strong>ID:</strong> {{ $elderlyAdultGuardian->id }}</p>
        <p><strong>Adulto Mayor:</strong> {{ $elderlyAdultGuardian->elderlyAdult->given_name }} {{ $elderlyAdultGuardian->elderlyAdult->paternal_last_name }}</p>
        <p><strong>Guardián:</strong> {{ $elderlyAdultGuardian->guardian->given_name }} {{ $elderlyAdultGuardian->guardian->paternal_last_name }}</p>
        <a href="{{ route('elderly_adult_guardians.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@stop