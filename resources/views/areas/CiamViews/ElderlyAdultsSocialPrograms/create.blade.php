@extends('adminlte::page')

@section('title', 'Crear Relación')

@section('content_header')
<h1>Crear Relación entre Adulto Mayor y Programa Social</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('elderly_adult_social_programs.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="elderly_adults_id">Adulto Mayor</label>
                <select name="elderly_adults_id" id="elderly_adults_id" class="form-control">
                    <option value="">Seleccione un adulto mayor</option>
                    @foreach($elderlyAdults as $elderlyAdult)
                    <option value="{{ $elderlyAdult->id }}">
                        {{ $elderlyAdult->given_name }} {{ $elderlyAdult->paternal_last_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="social_programs_id">Programa Social</label>
                <select name="social_programs_id" id="social_programs_id" class="form-control">
                    <option value="">Seleccione un programa social</option>
                    @foreach($socialPrograms as $socialProgram)
                    <option value="{{ $socialProgram->id }}">{{ $socialProgram->social_programs_name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('elderly_adult_social_programs.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop