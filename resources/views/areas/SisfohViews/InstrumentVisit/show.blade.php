<!-- resources/views/instrument_visits/show.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Detalles de la Visita</h1>
        <ul>
            <li><strong>ID:</strong> {{ $instrumentVisit->id }}</li>
            <li><strong>Instrumento:</strong> {{ $instrumentVisit->instrument_name }}</li>
            <li><strong>Fecha de la Visita:</strong> {{ $instrumentVisit->visit_date }}</li>
        </ul>
        <a href="{{ route('instrument_visits.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
