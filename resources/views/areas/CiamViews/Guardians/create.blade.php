@extends('adminlte::page')

@section('title', 'Crear Guardián')

@section('content_header')
<h1>Crear Nuevo Guardián</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('guardians.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" name="id" class="form-control" value="{{ old('id') }}" placeholder="Ingrese el ID único">
                @error('id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="document_type">Tipo de Documento</label>
                <select name="document_type" class="form-control">
                    <option value="">Seleccione</option>
                    @foreach(['DNI', 'Pasaporte', 'Carnet', 'Cedula'] as $type)
                    <option value="{{ $type }}" {{ old('document_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('document_type')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="given_name">Nombres</label>
                <input type="text" name="given_name" class="form-control" value="{{ old('given_name') }}" placeholder="Ingrese el nombre">
                @error('given_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="paternal_last_name">Apellido Paterno</label>
                <input type="text" name="paternal_last_name" class="form-control" value="{{ old('paternal_last_name') }}" placeholder="Ingrese el apellido paterno">
                @error('paternal_last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="maternal_last_name">Apellido Materno</label>
                <input type="text" name="maternal_last_name" class="form-control" value="{{ old('maternal_last_name') }}" placeholder="Ingrese el apellido materno">
                @error('maternal_last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number">Teléfono</label>
                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" placeholder="Ingrese el número de teléfono">
                @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('guardians.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop