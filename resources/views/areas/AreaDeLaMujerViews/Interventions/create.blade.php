@extends('adminlte::page')

@section('title', 'Crear Intervención')

@section('content_header')
    <h1>Crear Nueva Intervención</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('interventions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="appointment">Cita</label>
                <textarea name="appointment" id="appointment" class="form-control" rows="3" required>{{ old('appointment') }}</textarea>
            </div>
            <div class="form-group">
                <label for="derivation">Derivación</label>
                <textarea name="derivation" id="derivation" class="form-control" rows="3">{{ old('derivation') }}</textarea>
            </div>
            <div class="form-group">
                <label for="appointment_date">Fecha de la Cita</label>
                <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control" required value="{{ old('appointment_date') }}">
            </div>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
            <a href="{{ route('interventions.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Volver</a>
        </form>
    </div>
</div>
@stop
