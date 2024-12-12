@extends('adminlte::page')

@section('title', 'Editar Relación de Violencia')

@section('content_header')
    <h1>Editar Relación de Violencia</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-warning">
        <h3 class="card-title">Editar Relación</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('am_person_violences.update', $amPersonViolence->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="am_person_id">Persona</label>
                <select name="am_person_id" id="am_person_id" class="form-control" required>
                    @foreach($amPersons as $person)
                        <option value="{{ $person->id }}" {{ $person->id == $amPersonViolence->am_person_id ? 'selected' : '' }}>
                            {{ $person->given_name }} {{ $person->paternal_last_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="violence_id">Tipo de Violencia</label>
                <select name="violence_id" id="violence_id" class="form-control" required>
                    @foreach($violences as $violence)
                        <option value="{{ $violence->id }}" {{ $violence->id == $amPersonViolence->violence_id ? 'selected' : '' }}>
                            {{ $violence->kind_violence }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="registration_date">Fecha de Registro</label>
                <input type="datetime-local" name="registration_date" id="registration_date" 
                       value="{{ $amPersonViolence->registration_date->format('Y-m-d\TH:i') }}" 
                       class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
        </form>
    </div>
</div>
@endsection
