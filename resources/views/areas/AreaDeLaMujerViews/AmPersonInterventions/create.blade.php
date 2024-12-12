@extends('adminlte::page')

@section('title', 'Crear Relación Persona-Intervención')

@section('content_header')
    <h1>Crear Relación Persona-Intervención</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('am_person_interventions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="am_person_id">Persona</label>
                <select name="am_person_id" id="am_person_id" class="form-control" required>
                    @foreach($amPersons as $person)
                        <option value="{{ $person->id }}">{{ $person->given_name }} {{ $person->paternal_last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="intervention_id">Intervención</label>
                <select name="intervention_id" id="intervention_id" class="form-control" required>
                    @foreach($interventions as $intervention)
                        <option value="{{ $intervention->id }}">{{ $intervention->appointment }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Estado</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="En progreso">En progreso</option>
                    <option value="Completado">Completado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
            <a href="{{ route('am_person_interventions.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Volver</a>
        </form>
    </div>
</div>
@stop
