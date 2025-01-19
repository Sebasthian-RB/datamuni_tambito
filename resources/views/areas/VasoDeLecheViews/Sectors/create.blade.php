@extends('adminlte::page')

@section('title', 'Agregar Sector')

@section('content_header')
    <h1>Agregar Sector</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('sectors.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header" style="background-color: #3B1E54; color: #FFFFFF;">
                <h3 class="card-title">Formulario para agregar un sector</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="responsible_person">Responsable</label>
                    <input type="text" class="form-control @error('responsible_person') is-invalid @enderror" id="responsible_person" name="responsible_person" value="{{ old('responsible_person') }}" required>
                    @error('responsible_person')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">Guardar Sector</button>
                <a href="{{ route('sectors.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop
