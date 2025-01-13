@extends('adminlte::page')

@section('title', 'Detalles del Adulto Mayor')

@section('content_header')
    <h1>Detalles del Adulto Mayor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('elderly_adults.index') }}" class="btn btn-secondary">Volver</a>
        </div>
        <div class="card-body">
            <h3>{{ $elderlyAdult->given_name }} {{ $elderlyAdult->paternal_last_name }} {{ $elderlyAdult->maternal_last_name }}</h3>
            <p><strong>ID:</strong> {{ $elderlyAdult->id }}</p>
            <p><strong>Tipo de Documento:</strong> {{ $elderlyAdult->document_type }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $elderlyAdult->birth_date }}</p>
            <p><strong>Dirección:</strong> {{ $elderlyAdult->address }}</p>
            <p><strong>Teléfono:</strong> {{ $elderlyAdult->phone_number }}</p>
            <p><strong>Observaciones:</strong> {{ $elderlyAdult->observation }}</p>
        </div>
    </div>
@stop
