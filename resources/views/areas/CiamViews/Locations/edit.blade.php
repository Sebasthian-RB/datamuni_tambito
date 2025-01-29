@extends('adminlte::page')

@section('title', 'Editar Localidad')

@section('content_header')
<h1>Editar Localidad</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('locations.update', $location->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header" style="background-color: #708F3A; color: #FFFFFF;">
                <h3 class="card-title">Formulario para editar localidad</h3>
            </div>
            <div class="card-body">
                <!-- ID de la Localidad -->
                <div class="form-group">
                    <label for="id">Código de Localidad (Ubigeo)</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id', $location->id) }}" required>
                    @error('id')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Departamento -->
                <div class="form-group">
                    <label for="department">Departamento</label>
                    <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department', $location->department) }}" required>
                    @error('department')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Provincia -->
                <div class="form-group">
                    <label for="province">Provincia</label>
                    <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province', $location->province) }}" required>
                    @error('province')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Distrito -->
                <div class="form-group">
                    <label for="district">Distrito</label>
                    <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" name="district" value="{{ old('district', $location->district) }}" required>
                    @error('district')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" style="background-color: #708F3A; color: white; border: #708F3A;">Actualizar Localidad</button>
                <a href="{{ route('locations.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop