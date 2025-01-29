@extends('adminlte::page')

@section('title', 'Crear Relación')

@section('content_header')
<h1>Crear Relación Adulto Mayor - Guardián</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('elderly_adult_guardians.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="elderly_adults_id">Adulto Mayor</label>
                <select name="elderly_adults_id" id="elderly_adults_id" class="form-control" required>
                    <option value="" disabled selected>Seleccione un adulto mayor</option>
                    @foreach ($elderlyAdults as $adult)
                    <option value="{{ $adult->id }}">{{ $adult->given_name }} {{ $adult->paternal_last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="guardians_id">Guardián</label>
                <select name="guardians_id" id="guardians_id" class="form-control" required>
                    <option value="" disabled selected>Seleccione un guardián</option>
                    @foreach ($guardians as $guardian)
                    <option value="{{ $guardian->id }}">{{ $guardian->given_name }} {{ $guardian->paternal_last_name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('elderly_adult_guardians.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop