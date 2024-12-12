@extends('adminlte::page')

@section('title', 'Detalle Relación Persona-Intervención')

@section('content_header')
    <h1>Detalle de Relación Persona-Intervención</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <h3>Persona</h3>
        <p>{{ $amPersonIntervention->amPerson->given_name }} {{ $amPersonIntervention->amPerson->paternal_last_name }}</p>

        <h3>Intervención</h3>
        <p>{{ $amPersonIntervention->intervention->appointment }}</p>

        <h3>Estado</h3>
        <p>{{ $amPersonIntervention->status }}</p>

        <a href="{{ route('am_person_interventions.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver</a>
    </div>
</div>
@stop
