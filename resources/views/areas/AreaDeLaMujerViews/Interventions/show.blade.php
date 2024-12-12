@extends('adminlte::page')

@section('title', 'Detalle de Intervención')

@section('content_header')
    <h1>Detalle de la Intervención</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <h3>Cita</h3>
        <p>{{ $intervention->appointment }}</p>

        <h3>Derivación</h3>
        <p>{{ $intervention->derivation ?? 'N/A' }}</p>

        <h3>Fecha de la Cita</h3>
        <p>{{ $intervention->appointment_date }}</p>

        <a href="{{ route('interventions.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver</a>
    </div>
</div>
@stop
