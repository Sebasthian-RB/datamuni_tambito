@extends('adminlte::page')

@section('title', 'Detalle de la Sesión Psicológica')

@section('content_header')
    <h1>Detalle de la Sesión Psicológica</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <p><strong>Diagnóstico:</strong> {{ $psychologicalSession->diagnosis->person->given_name }} {{ $psychologicalSession->diagnosis->person->paternal_last_name }} - {{ \Carbon\Carbon::parse($psychologicalSession->diagnosis->diagnosis_date)->format('d/m/Y') }}</p>
        <p><strong>Número de Sesión:</strong> {{ $psychologicalSession->session_number }}</p>
        <p><strong>Fecha Programada:</strong> {{ \Carbon\Carbon::parse($psychologicalSession->scheduled_date)->format('d/m/Y') }}</p>
        <p><strong>Completada:</strong> {{ $psychologicalSession->completed ? 'Sí' : 'No' }}</p>

        <a href="{{ route('psychological-sessions.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
