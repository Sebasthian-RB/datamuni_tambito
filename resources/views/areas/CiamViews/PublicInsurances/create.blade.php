@extends('adminlte::page')

@section('title', 'Crear Seguro Público')

@section('content_header')
<h1>Crear Seguro Público</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Formulario para crear un seguro público</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('public_insurances.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id">ID del Seguro Público</label>
                <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id') }}" placeholder="Ingrese el ID del seguro público">
                @error('id')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="public_insurances_name">Nombre del Seguro Público</label>
                <select class="form-control @error('public_insurances_name') is-invalid @enderror" id="public_insurances_name" name="public_insurances_name">
                    <option value="">Seleccione una opción</option>
                    <option value="SIS" {{ old('public_insurances_name') == 'SIS' ? 'selected' : '' }}>SIS</option>
                    <option value="ESSALUD" {{ old('public_insurances_name') == 'ESSALUD' ? 'selected' : '' }}>ESSALUD</option>
                </select>
                @error('public_insurances_name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('public_insurances.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop