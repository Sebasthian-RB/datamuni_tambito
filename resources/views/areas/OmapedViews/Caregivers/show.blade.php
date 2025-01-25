@extends('adminlte::page')

@section('title', 'Detalles del Cuidador')

@section('content_header')
    <h1>Detalles del Cuidador</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="form-group">
            <label><strong>Nombre Completo:</strong></label>
            <p>{{ $caregiver->full_name }}</p>
        </div>

        <div class="form-group">
            <label><strong>Relación:</strong></label>
            <p>{{ $caregiver->relationship }}</p>
        </div>

        <div class="form-group">
            <label><strong>DNI:</strong></label>
            <p>{{ $caregiver->dni }}</p>
        </div>

        <div class="form-group">
            <label><strong>Teléfono:</strong></label>
            <p>{{ $caregiver->phone ?? 'N/A' }}</p>
        </div>

        <a href="{{ route('caregivers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Regresar
        </a>
        <a href="{{ route('caregivers.edit', $caregiver) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css">
@stop

@section('js')
    <script>
        console.log('Vista de Detalles del Cuidador cargada.');
    </script>
@stop
