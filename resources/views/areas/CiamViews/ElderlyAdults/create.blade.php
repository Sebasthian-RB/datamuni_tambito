@extends('adminlte::page')

@section('title', 'Crear Adulto Mayor')

@section('content_header')
    <h1>Crear Nuevo Adulto Mayor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('elderly_adults.index') }}" class="btn btn-secondary">Volver</a>
        </div>
        <div class="card-body">
            <form action="{{ route('elderly_adults.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" name="id" id="id" class="form-control" value="{{ old('id') }}" required>
                </div>
                <div class="form-group">
                    <label for="document_type">Tipo de Documento</label>
                    <select name="document_type" id="document_type" class="form-control">
                        <option value="DNI" {{ old('document_type') == 'DNI' ? 'selected' : '' }}>DNI</option>
                        <option value="Pasaporte" {{ old('document_type') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                        <option value="Carnet" {{ old('document_type') == 'Carnet' ? 'selected' : '' }}>Carnet</option>
                        <option value="Cedula" {{ old('document_type') == 'Cedula' ? 'selected' : '' }}>Cédula</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="given_name">Nombre</label>
                    <input type="text" name="given_name" id="given_name" class="form-control" value="{{ old('given_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="paternal_last_name">Apellido Paterno</label>
                    <input type="text" name="paternal_last_name" id="paternal_last_name" class="form-control" value="{{ old('paternal_last_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="maternal_last_name">Apellido Materno</label>
                    <input type="text" name="maternal_last_name" id="maternal_last_name" class="form-control" value="{{ old('maternal_last_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="birth_date">Fecha de Nacimiento</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date') }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                </div>
                <div class="form-group">
                    <label for="reference">Referencia</label>
                    <input type="text" name="reference" id="reference" class="form-control" value="{{ old('reference') }}">
                </div>
                <div class="form-group">
                    <label for="sex_type">Sexo</label>
                    <select name="sex_type" id="sex_type" class="form-control">
                        <option value="0" {{ old('sex_type') == 0 ? 'selected' : '' }}>Femenino</option>
                        <option value="1" {{ old('sex_type') == 1 ? 'selected' : '' }}>Masculino</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone_number">Número de Teléfono</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}">
                </div>
                <div class="form-group">
                    <label for="type_of_disability">Tipo de Discapacidad</label>
                    <select name="type_of_disability" id="type_of_disability" class="form-control">
                        <option value="Visual" {{ old('type_of_disability') == 'Visual' ? 'selected' : '' }}>Visual</option>
                        <option value="Motriz" {{ old('type_of_disability') == 'Motriz' ? 'selected' : '' }}>Motriz</option>
                        <option value="Mental" {{ old('type_of_disability') == 'Mental' ? 'selected' : '' }}>Mental</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="household_members">Miembros del Hogar</label>
                    <input type="number" name="household_members" id="household_members" class="form-control" value="{{ old('household_members') }}">
                </div>
                <div class="form-group">
                    <label for="permanent_attention">Atención Permanente</label>
                    <select name="permanent_attention" id="permanent_attention" class="form-control">
                        <option value="0" {{ old('permanent_attention') == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('permanent_attention') == 1 ? 'selected' : '' }}>Sí</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="observation">Observación</label>
                    <textarea name="observation" id="observation" class="form-control">{{ old('observation') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Crear Adulto Mayor</button>
            </form>
        </div>
    </div>
@stop
