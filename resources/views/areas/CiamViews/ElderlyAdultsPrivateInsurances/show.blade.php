@extends('adminlte::page')

@section('title', 'Detalles de Relación')

@section('content_header')
<h1>Detalles de la Relación</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <p><strong>ID:</strong> {{ $elderlyAdultPrivateInsurance->id }}</p>
        <p><strong>Adulto Mayor:</strong>
            {{ $elderlyAdultPrivateInsurance->elderlyAdult->given_name }} {{ $elderlyAdultPrivateInsurance->elderlyAdult->paternal_last_name }}
        </p>
        <p><strong>Seguro Privado:</strong> {{ $elderlyAdultPrivateInsurance->privateInsurance->private_insurances_name }}</p>
        <a href="{{ route('elderly_adult_private_insurances.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@stop