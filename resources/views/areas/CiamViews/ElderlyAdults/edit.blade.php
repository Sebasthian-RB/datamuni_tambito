@extends('adminlte::page')

@section('title', 'Editar Adulto Mayor')

@section('content_header')
<h1>Editar Adulto Mayor</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('elderly_adults.update', $elderlyAdult->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header" style="background-color: #708f3a; color: white;">
                <h3 class="card-title">Formulario para editar adulto mayor</h3>
            </div>
            <div class="card-body">

                <!-- ID (No se recomienda editarlo, pero está aquí por si es necesario) -->
                <div class="form-group">
                    <label for="id">ID del Adulto Mayor</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id', $elderlyAdult->id) }}" required>
                    @error('id')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tipo de Documento -->
                <div class="form-group">
                    <label for="document_type">Tipo de Documento</label>
                    <select class="form-control @error('document_type') is-invalid @enderror" id="document_type" name="document_type" required>
                        <option value="DNI" {{ old('document_type', $elderlyAdult->document_type) == 'DNI' ? 'selected' : '' }}>DNI</option>
                        <option value="Pasaporte" {{ old('document_type', $elderlyAdult->document_type) == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                        <option value="Carnet" {{ old('document_type', $elderlyAdult->document_type) == 'Carnet' ? 'selected' : '' }}>Carnet</option>
                        <option value="Cedula" {{ old('document_type', $elderlyAdult->document_type) == 'Cedula' ? 'selected' : '' }}>Cédula</option>
                    </select>
                    @error('document_type')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nombres y Apellidos -->
                <div class="form-group">
                    <label for="given_name">Nombres</label>
                    <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name" name="given_name" value="{{ old('given_name', $elderlyAdult->given_name) }}" required>
                    @error('given_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="paternal_last_name">Apellido Paterno</label>
                    <input type="text" class="form-control @error('paternal_last_name') is-invalid @enderror" id="paternal_last_name" name="paternal_last_name" value="{{ old('paternal_last_name', $elderlyAdult->paternal_last_name) }}" required>
                    @error('paternal_last_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="maternal_last_name">Apellido Materno</label>
                    <input type="text" class="form-control @error('maternal_last_name') is-invalid @enderror" id="maternal_last_name" name="maternal_last_name" value="{{ old('maternal_last_name', $elderlyAdult->maternal_last_name) }}" required>
                    @error('maternal_last_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Ubicación -->
                <div class="form-group">
                    <label for="location_id">Ubicación</label>
                    <select class="form-control @error('location_id') is-invalid @enderror" id="location_id" name="location_id" required>
                        @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id', $elderlyAdult->location_id) == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('location_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Seguro Público -->
                <div class="form-group">
                    <label for="public_insurance_id">Seguro Público</label>
                    <select class="form-control @error('public_insurance_id') is-invalid @enderror" id="public_insurance_id" name="public_insurance_id" required>
                        @foreach($publicInsurances as $insurance)
                        <option value="{{ $insurance->id }}" {{ old('public_insurance_id', $elderlyAdult->public_insurance_id) == $insurance->id ? 'selected' : '' }}>
                            {{ $insurance->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('public_insurance_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Guardianes -->
                <div class="form-group">
                    <label for="guardian_ids">Guardianes</label>
                    <select class="form-control select2 @error('guardian_ids') is-invalid @enderror" id="guardian_ids" name="guardian_ids[]" multiple>
                        @foreach($guardians as $guardian)
                        <option value="{{ $guardian->id }}" {{ in_array($guardian->id, old('guardian_ids', $elderlyAdult->guardians->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $guardian->full_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('guardian_ids')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Programas Sociales -->
                <div class="form-group">
                    <label for="social_program_ids">Programas Sociales</label>
                    <select class="form-control select2 @error('social_program_ids') is-invalid @enderror" id="social_program_ids" name="social_program_ids[]" multiple>
                        @foreach($socialPrograms as $program)
                        <option value="{{ $program->id }}" {{ in_array($program->id, old('social_program_ids', $elderlyAdult->socialPrograms->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $program->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('social_program_ids')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="card-footer" style="background-color: #9cbf5c;">
                <button type="submit" class="btn" style="background-color: #708f3a; color: white;">Actualizar Adulto Mayor</button>
                <a href="{{ route('elderly_adults.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop