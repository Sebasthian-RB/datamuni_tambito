@extends('adminlte::page')

@section('title', 'Editar Ubicación')

@section('content_header')
<h1>Editar Ubicación</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('locations.update', $location->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="location_name">Nombre de la Ubicación</label>
                <input type="text" name="location_name" id="location_name" class="form-control"
                    value="{{ old('location_name', $location->location_name) }}" required>
            </div>
            <div class="form-group">
                <label for="region">Región</label>
                <input type="text" name="region" id="region" class="form-control"
                    value="{{ old('region', $location->region) }}">
            </div>
            <div class="form-group">
                <label for="country">País</label>
                <input type="text" name="country" id="country" class="form-control"
                    value="{{ old('country', $location->country) }}">
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('locations.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop