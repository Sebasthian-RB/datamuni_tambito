@extends('adminlte::page')

@section('title', 'Editar Relación')

@section('content_header')
<h1>Editar Relación entre Adulto Mayor y Seguro Privado</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('elderly_adult_private_insurances.update', $elderlyAdultPrivateInsurance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Select Adulto Mayor -->
            <div class="form-group">
                <label for="elderly_adults_id">Adulto Mayor</label>
                <select name="elderly_adults_id" id="elderly_adults_id" class="form-control">
                    @foreach($elderlyAdults as $adult)
                    <option value="{{ $adult->id }}"
                        {{ $elderlyAdultPrivateInsurance->elderly_adults_id == $adult->id ? 'selected' : '' }}>
                        {{ $adult->given_name }} {{ $adult->paternal_last_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Select Seguro Privado -->
            <div class="form-group">
                <label for="private_insurances_id">Seguro Privado</label>
                <select name="private_insurances_id" id="private_insurances_id" class="form-control">
                    @foreach($privateInsurances as $insurance)
                    <option value="{{ $insurance->id }}"
                        {{ $elderlyAdultPrivateInsurance->private_insurances_id == $insurance->id ? 'selected' : '' }}>
                        {{ $insurance->private_insurances_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Botón Actualizar -->
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('elderly_adult_private_insurances.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop