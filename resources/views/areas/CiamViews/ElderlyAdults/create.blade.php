@extends('adminlte::page')

@section('title', 'Agregar Adulto Mayor')

@section('content_header')
<h1>Agregar Adulto Mayor</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('elderly_adults.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header" style="background-color: #708f3a; color: white;">
                <h3 class="card-title">Formulario para agregar adulto mayor</h3>
            </div>
            <div class="card-body">
                <!-- ID -->
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id') }}" required>
                    @error('id')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tipo de Documento -->
                <div class="form-group">
                    <label for="document_type">Tipo de Documento</label>
                    <select class="form-control @error('document_type') is-invalid @enderror" id="document_type" name="document_type" required>
                        <option value="" disabled selected>Seleccione un tipo</option>
                        <option value="DNI" {{ old('document_type') == 'DNI' ? 'selected' : '' }}>DNI</option>
                        <option value="Pasaporte" {{ old('document_type') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                        <option value="Carnet" {{ old('document_type') == 'Carnet' ? 'selected' : '' }}>Carnet</option>
                        <option value="Cedula" {{ old('document_type') == 'Cedula' ? 'selected' : '' }}>Cédula</option>
                    </select>
                    @error('document_type')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nombres -->
                <div class="form-group">
                    <label for="given_name">Nombres</label>
                    <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name" name="given_name" value="{{ old('given_name') }}" required>
                    @error('given_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Apellidos -->
                <div class="form-group">
                    <label for="paternal_last_name">Apellido Paterno</label>
                    <input type="text" class="form-control @error('paternal_last_name') is-invalid @enderror" id="paternal_last_name" name="paternal_last_name" value="{{ old('paternal_last_name') }}" required>
                    @error('paternal_last_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="maternal_last_name">Apellido Materno</label>
                    <input type="text" class="form-control @error('maternal_last_name') is-invalid @enderror" id="maternal_last_name" name="maternal_last_name" value="{{ old('maternal_last_name') }}" required>
                    @error('maternal_last_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Fecha de Nacimiento -->
                <div class="form-group">
                    <label for="birth_date">Fecha de Nacimiento</label>
                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                    @error('birth_date')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Selección de Ubicación -->
                <div class="form-group">
                    <label for="location_id">Ubicación</label>
                    <select class="form-control @error('location_id') is-invalid @enderror" id="location_id" name="location_id" required>
                        <option value="" disabled selected>Seleccione una ubicación</option>
                        @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('location_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Selección de Seguro Público -->
                <div class="form-group">
                    <label for="public_insurance_id">Seguro Público</label>
                    <select class="form-control @error('public_insurance_id') is-invalid @enderror" id="public_insurance_id" name="public_insurance_id" required>
                        <option value="" disabled selected>Seleccione un seguro</option>
                        @foreach($publicInsurances as $publicInsurance)
                        <option value="{{ $publicInsurance->id }}" {{ old('public_insurance_id') == $publicInsurance->id ? 'selected' : '' }}>
                            {{ $publicInsurance->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('public_insurance_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Selección de Guardianes -->
                <div class="form-group">
                    <label for="guardian_ids">Guardianes</label>
                    <select class="form-control select2 @error('guardian_ids') is-invalid @enderror" id="guardian_ids" name="guardian_ids[]" multiple>
                        @foreach($guardians as $guardian)
                        <option value="{{ $guardian->id }}" {{ in_array($guardian->id, old('guardian_ids', [])) ? 'selected' : '' }}>
                            {{ $guardian->given_name }} {{ $guardian->paternal_last_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('guardian_ids')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Selección de Programas Sociales -->
                <div class="form-group">
                    <label for="social_program_ids">Programas Sociales</label>
                    <select class="form-control select2 @error('social_program_ids') is-invalid @enderror" id="social_program_ids" name="social_program_ids[]" multiple>
                        @foreach($socialPrograms as $program)
                        <option value="{{ $program->id }}" {{ in_array($program->id, old('social_program_ids', [])) ? 'selected' : '' }}>
                            {{ $program->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('social_program_ids')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Selección de Seguros Privados -->
                <div class="form-group">
                    <label for="private_insurance_ids">Seguros Privados</label>
                    <select class="form-control select2 @error('private_insurance_ids') is-invalid @enderror" id="private_insurance_ids" name="private_insurance_ids[]" multiple>
                        @foreach($privateInsurances as $insurance)
                        <option value="{{ $insurance->id }}" {{ in_array($insurance->id, old('private_insurance_ids', [])) ? 'selected' : '' }}>
                            {{ $insurance->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('private_insurance_ids')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="card-footer" style="background-color: #9cbf5c; color: white;">
                <button type="submit" class="btn" style="background-color: #708f3a; color: white;">Guardar Adulto Mayor</button>
                <a href="{{ route('elderly_adults.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop