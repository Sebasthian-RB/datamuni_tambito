@extends('adminlte::page')

@section('title', 'Detalle del Seguro Privado')

@section('content_header')
<h1>Detalle del Seguro Privado</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3>{{ $privateInsurance->private_insurances_name }}</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $privateInsurance->id }}</p>
        <p><strong>Nombre:</strong> {{ $privateInsurance->private_insurances_name }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('private_insurances.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@stop