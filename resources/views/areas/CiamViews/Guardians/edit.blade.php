@extends('adminlte::page')

@section('title', 'Editar Guardián')

@section('content_header')
<h1>Editar Guardián</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body" style="background-color: #EAFAEA;">
        <form action="{{ route('guardians.update', $guardian->id) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="id" class="font-weight-bold" style="color: #6E8E59;">ID</label>
                <input type="text" id="id" name="id" class="form-control"
                    value="{{ old('id', $guardian->id) }}" placeholder="Ingrese el ID único">
                @error('id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="document_type" class="font-weight-bold" style="color: #6E8E59;">Tipo de Documento</label>
                <select id="document_type" name="document_type" class="form-control">
                    @foreach(['DNI', 'Pasaporte', 'Carnet', 'Cedula'] as $type)
                    <option value="{{ $type }}" {{ old('document_type', $guardian->document_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('document_type')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="given_name" class="font-weight-bold" style="color: #6E8E59;">Nombres</label>
                <input type="text" id="given_name" name="given_name" class="form-control"
                    value="{{ old('given_name', $guardian->given_name) }}" placeholder="Ingrese el nombre">
                @error('given_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="paternal_last_name" class="font-weight-bold" style="color: #6E8E59;">Apellido Paterno</label>
                <input type="text" id="paternal_last_name" name="paternal_last_name" class="form-control"
                    value="{{ old('paternal_last_name', $guardian->paternal_last_name) }}" placeholder="Ingrese el apellido paterno">
                @error('paternal_last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="maternal_last_name" class="font-weight-bold" style="color: #6E8E59;">Apellido Materno</label>
                <input type="text" id="maternal_last_name" name="maternal_last_name" class="form-control"
                    value="{{ old('maternal_last_name', $guardian->maternal_last_name) }}" placeholder="Ingrese el apellido materno">
                @error('maternal_last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number" class="font-weight-bold" style="color: #6E8E59;">Teléfono</label>
                <input type="text" id="phone_number" name="phone_number" class="form-control"
                    value="{{ old('phone_number', $guardian->phone_number) }}" placeholder="Ingrese el número de teléfono">
                @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn" style="background-color: #6E8E59; color: #EAFAEA;">Actualizar</button>
                <a href="{{ route('guardians.index') }}" class="btn" style="background-color: #780C28; color: #EAFAEA;">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@stop