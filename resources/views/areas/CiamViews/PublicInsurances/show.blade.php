@extends('adminlte::page')

@section('title', 'Detalles del Seguro Público')

@section('content_header')
<h1>Detalles del Seguro Público</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Información del Seguro Público</h3>
        <div class="card-tools">
            <a href="{{ route('public_insurances.index') }}" class="btn btn-secondary btn-sm">Volver a la lista</a>
        </div>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $publicInsurance->id }}</p>
        <p><strong>Nombre:</strong> {{ $publicInsurance->public_insurances_name }}</p>
    </div>
</div>
@stop