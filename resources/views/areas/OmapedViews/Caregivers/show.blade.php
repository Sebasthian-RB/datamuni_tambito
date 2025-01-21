@extends('adminlte::page')

@section('title', 'Detalles del Cuidador')

@section('content_header')
    <h1>Detalles del Cuidador</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h3><strong>Nombre Completo:</strong> {{ $caregiver->full_name }}</h3>
            <p><strong>Parentesco:</strong> {{ $caregiver->relationship }}</p>
            <p><strong>DNI:</strong> {{ $caregiver->dni }}</p>
            <p><strong>Teléfono:</strong> {{ $caregiver->phone }}</p>
            <a href="{{ route('caregivers.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@stop
