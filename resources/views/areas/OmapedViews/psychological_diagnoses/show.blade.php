@extends('adminlte::page')

@section('title', 'Ver Diagnóstico')

@section('content_header')
    <h1>Detalles del Diagnóstico Psicológico</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('psychological-diagnoses.index') }}" class="btn btn-secondary">← Volver al listado</a>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-4">Persona</dt>
            <dd class="col-sm-8">{{ $psychologicalDiagnosis->person->given_name }} {{ $psychologicalDiagnosis->person->paternal_last_name }}</dd>

            <dt class="col-sm-4">Diagnóstico</dt>
            <dd class="col-sm-8">{{ $psychologicalDiagnosis->diagnosis ?? 'No registrado' }}</dd>

            <dt class="col-sm-4">Sesiones Recomendadas</dt>
            <dd class="col-sm-8">{{ $psychologicalDiagnosis->recommended_sessions }}</dd>

            <dt class="col-sm-4">Fecha del Diagnóstico</dt>
            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($psychologicalDiagnosis->diagnosis_date)->format('d/m/Y') }}</dd>
        </dl>
    </div>
</div>
@endsection
