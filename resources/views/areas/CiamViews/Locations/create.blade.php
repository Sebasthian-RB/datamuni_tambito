@extends('adminlte::page')

@section('title', 'Agregar Localidad')

@section('content_header')
<h1>Agregar Localidad</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('locations.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header" style="background-color: #708F3A; color: #FFFFFF;">
                <h3 class="card-title">Formulario para agregar localidad</h3>
            </div>
            <div class="card-body">
                <!-- ID de la Localidad -->
                <div class="form-group">
                    <label for="id">Código de Localidad (Ubigeo)</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id') }}" required>
                    @error('id')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Departamento -->
                <div class="form-group">
                    <label for="department">Departamento</label>
                    <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department') }}" required>
                    @error('department')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Provincia -->
                <div class="form-group">
                    <label for="province">Provincia</label>
                    <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province') }}" required>
                    @error('province')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Distrito -->
                <div class="form-group">
                    <label for="district">Distrito</label>
                    <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" name="district" value="{{ old('district') }}" required>
                    @error('district')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" style="background-color: #708F3A; color: white; border: #708F3A;">Guardar Localidad</button>
                <a href="{{ route('locations.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop