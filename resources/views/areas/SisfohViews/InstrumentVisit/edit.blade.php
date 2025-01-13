<!-- resources/views/instrument_visits/edit.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Editar Visita</h1>
        <form action="{{ route('instrument_visits.update', $instrumentVisit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="instrument_name">Instrumento</label>
                <input type="text" class="form-control" id="instrument_name" name="instrument_name" value="{{ $instrumentVisit->instrument_name }}" required>
            </div>
            <div class="form-group">
                <label for="visit_date">Fecha de la Visita</label>
                <input type="date" class="form-control" id="visit_date" name="visit_date" value="{{ $instrumentVisit->visit_date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
