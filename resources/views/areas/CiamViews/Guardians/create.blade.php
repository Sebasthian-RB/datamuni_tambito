@extends('adminlte::page')

@section('title', 'Crear Guardián')

@section('content_header')
<h1 style="color: #6E8E59;">Crear Nuevo Guardián</h1>
@stop

@section('content')
<div class="card" style="background-color: #EAFAEA; border: 1px solid #6E8E59;">
    <div class="card-header" style="background-color: #6E8E59; color: white;">
        <h3 class="card-title">Formulario para agregar un guardián</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('guardians.store') }}" method="POST">
            @csrf

            <!-- Campo para el ID -->
            <div class="form-group">
                <label for="id" style="color: #6E8E59;">ID</label>
                <input type="text" name="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id') }}" placeholder="Ingrese el ID único">
                @error('id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para Tipo de Documento -->
            <div class="form-group">
                <label for="document_type" style="color: #6E8E59;">Tipo de Documento</label>
                <select name="document_type" class="form-control @error('document_type') is-invalid @enderror">
                    <option value="" disabled {{ old('document_type') ? '' : 'selected' }}>Seleccione</option>
                    @foreach(['DNI', 'Pasaporte', 'Carnet', 'Cedula'] as $type)
                    <option value="{{ $type }}" {{ old('document_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('document_type')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para Nombres -->
            <div class="form-group">
                <label for="given_name" style="color: #6E8E59;">Nombres</label>
                <input type="text" name="given_name" class="form-control @error('given_name') is-invalid @enderror" value="{{ old('given_name') }}" placeholder="Ingrese el nombre">
                @error('given_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para Apellido Paterno -->
            <div class="form-group">
                <label for="paternal_last_name" style="color: #6E8E59;">Apellido Paterno</label>
                <input type="text" name="paternal_last_name" class="form-control @error('paternal_last_name') is-invalid @enderror" value="{{ old('paternal_last_name') }}" placeholder="Ingrese el apellido paterno">
                @error('paternal_last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para Apellido Materno -->
            <div class="form-group">
                <label for="maternal_last_name" style="color: #6E8E59;">Apellido Materno</label>
                <input type="text" name="maternal_last_name" class="form-control @error('maternal_last_name') is-invalid @enderror" value="{{ old('maternal_last_name') }}" placeholder="Ingrese el apellido materno">
                @error('maternal_last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para Teléfono -->
            <div class="form-group">
                <label for="phone_number" style="color: #6E8E59;">Teléfono</label>
                <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" placeholder="Ingrese el número de teléfono">
                @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones de acción -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn" style="background-color: #6E8E59; color: white;">Guardar</button>
                <a href="{{ route('guardians.index') }}" class="btn btn-secondary" style="background-color: #780C28; color: white;">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@stop