@extends('adminlte::page')

@section('title', 'Editar Intervención')

@section('content_header')
    <h1>Editar Intervención</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('interventions.update', $intervention->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="appointment">Cita</label>
                <textarea name="appointment" id="appointment" class="form-control" rows="3" required>{{ old('appointment', $intervention->appointment) }}</textarea>
            </div>
            <div class="form-group">
                <label for="derivation">Derivación</label>
                <textarea name="derivation" id="derivation" class="form-control" rows="3">{{ old('derivation', $intervention->derivation) }}</textarea>
            </div>
            <div class="form-group">
                <label for="appointment_date">Fecha de la Cita</label>
                <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control" required value="{{ old('appointment_date', $intervention->appointment_date->format('Y-m-d\TH:i')) }}">
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('interventions.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop
