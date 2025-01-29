@extends('adminlte::page')

@section('title', 'Crear Relación')

@section('content_header')
<h1>Crear Relación entre Adulto Mayor y Seguro Privado</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('elderly_adult_private_insurances.store') }}" method="POST">
            @csrf

            <!-- Select Adulto Mayor -->
            <div class="form-group">
                <label for="elderly_adults_id">Adulto Mayor</label>
                <select name="elderly_adults_id" id="elderly_adults_id" class="form-control">
                    <option value="" selected disabled>Seleccione un Adulto Mayor</option>
                    @foreach($elderlyAdults as $adult)
                    <option value="{{ $adult->id }}">{{ $adult->given_name }} {{ $adult->paternal_last_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Select Seguro Privado -->
            <div class="form-group">
                <label for="private_insurances_id">Seguro Privado</label>
                <select name="private_insurances_id" id="private_insurances_id" class="form-control">
                    <option value="" selected disabled>Seleccione un Seguro Privado</option>
                    @foreach($privateInsurances as $insurance)
                    <option value="{{ $insurance->id }}">{{ $insurance->private_insurances_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botón Guardar -->
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('elderly_adult_private_insurances.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop