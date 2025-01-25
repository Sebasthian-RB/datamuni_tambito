@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detalles del Instrumento/Visita</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Instrumento: {{ $instrumentVisit->instrument->name ?? 'N/A' }}</h5>
            <p class="card-text">Visita: {{ $instrumentVisit->visit->name ?? 'N/A' }}</p>
            <p class="card-text">Fecha de Aplicación: {{ $instrumentVisit->application_date }}</p>
            <p class="card-text">Descripciones: {{ $instrumentVisit->descriptions }}</p>
        </div>
    </div>

    <a href="{{ route('instrument_visits.index') }}" class="mt-3 btn btn-primary">Volver</a>
</div>
@endsection
