<!-- resources/views/instrument_visits/create.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Crear Nueva Visita</h1>
        <form action="{{ route('instrument_visits.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="instrument_name">Instrumento</label>
                <input type="text" class="form-control" id="instrument_name" name="instrument_name" required>
            </div>
            <div class="form-group">
                <label for="visit_date">Fecha de la Visita</label>
                <input type="date" class="form-control" id="visit_date" name="visit_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
