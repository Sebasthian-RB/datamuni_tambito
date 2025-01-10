@extends('adminlte::page')

@section('title', 'Editar Guardián')

@section('content_header')
<h1>Editar Guardián</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('guardians.update', $guardian->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="document_type">Tipo de Documento</label>
                <select name="document_type" class="form-control">
                    @foreach(['DNI', 'Pasaporte', 'Carnet', 'Cedula'] as $type)
                    <option value="{{ $type }}" {{ $guardian->document_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('document_type')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="given_name">Nombres</label>
                <input type="text" name="given_name" class="form-control" value="{{ $guardian->given_name }}" placeholder="Ingrese el nombre">
                @error('given_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="paternal_last_name">Apellido Paterno</label>
                <input type="text" name="paternal_last_name" class="form-control" value="{{ $guardian->paternal_last_name }}" placeholder="Ingrese el apellido paterno">
                @error('paternal_last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="maternal_last_name">Apellido Materno</label>
                <input type="text" name="maternal_last_name" class="form-control" value="{{ $guardian->maternal_last_name }}" placeholder="Ingrese el apellido materno">
                @error('maternal_last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number">Teléfono</label>
                <input type="text" name="phone_number" class="form-control" value="{{ $guardian->phone_number }}" placeholder="Ingrese el número de teléfono">
                @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('guardians.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop