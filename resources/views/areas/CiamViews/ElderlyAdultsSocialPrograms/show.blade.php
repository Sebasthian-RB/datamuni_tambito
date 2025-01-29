@extends('adminlte::page')

@section('title', 'Detalles de la Relación')

@section('content_header')
<h1>Detalles de la Relación</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <h5><strong>Adulto Mayor:</strong></h5>
        <p>{{ $elderlyAdultSocialProgram->elderlyAdult->given_name }} {{ $elderlyAdultSocialProgram->elderlyAdult->paternal_last_name }}</p>

        <h5><strong>Programa Social:</strong></h5>
        <p>{{ $elderlyAdultSocialProgram->socialProgram->social_programs_name }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('elderly_adult_social_programs.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@stop