@extends('adminlte::page')

@section('title', 'Editar Persona')

@section('content_header')
    <!-- Imagen superior -->
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #f67280; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="container">
        <form action="{{ route('am_people.update', $amPerson->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card shadow-lg" style="border-radius: 15px; max-width: 900px; margin: 2rem auto;">
                <div class="card-header text-white" style="background: #f67280; border-radius: 15px 15px 0 0;">
                    <h3 class="card-title mb-0">Formulario para editar persona</h3>
                </div>
                <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
                    <div class="form-group mb-4">
                        <label for="id" class="font-weight-bold" style="color: #355c7d;">N° Documento</label>
                        <input type="text" class="form-control @error('id') is-invalid @enderror" id="id"
                            name="id" value="{{ old('id', $amPerson->id) }}" required>
                        @error('id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="identity_document" class="font-weight-bold" style="color: #355c7d;">Documento de
                            Identidad</label>
                        <select class="form-control @error('identity_document') is-invalid @enderror" id="identity_document"
                            name="identity_document" required>
                            <option value="DNI" @selected($amPerson->identity_document == 'DNI')>DNI</option>
                            <option value="Pasaporte" @selected($amPerson->identity_document == 'Pasaporte')>Pasaporte</option>
                            <option value="Carnet" @selected($amPerson->identity_document == 'Carnet')>Carnet</option>
                            <option value="Cedula" @selected($amPerson->identity_document == 'Cedula')>Cedula</option>
                        </select>
                        @error('identity_document')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="given_name" class="font-weight-bold" style="color: #355c7d;">Nombre</label>
                        <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name"
                            name="given_name" value="{{ old('given_name', $amPerson->given_name) }}" required>
                        @error('given_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="paternal_last_name" class="font-weight-bold" style="color: #355c7d;">Apellido
                            Paterno</label>
                        <input type="text" class="form-control @error('paternal_last_name') is-invalid @enderror"
                            id="paternal_last_name" name="paternal_last_name"
                            value="{{ old('paternal_last_name', $amPerson->paternal_last_name) }}" required>
                        @error('paternal_last_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="maternal_last_name" class="font-weight-bold" style="color: #355c7d;">Apellido
                            Materno</label>
                        <input type="text" class="form-control @error('maternal_last_name') is-invalid @enderror"
                            id="maternal_last_name" name="maternal_last_name"
                            value="{{ old('maternal_last_name', $amPerson->maternal_last_name) }}" required>
                        @error('maternal_last_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="address" class="font-weight-bold" style="color: #355c7d;">Dirección</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" value="{{ old('address', $amPerson->address) }}">
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="sex_type" class="font-weight-bold" style="color: #355c7d;">Sexo</label>
                        <select class="form-control @error('sex_type') is-invalid @enderror" id="sex_type" name="sex_type"
                            required>
                            <option value="1" @selected(old('sex_type', $amPerson->sex_type) == '1')>Masculino</option>
                            <option value="0" @selected(old('sex_type', $amPerson->sex_type) == '0')>Femenino</option>
                        </select>
                        @error('sex_type')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="phone_number" class="font-weight-bold" style="color: #355c7d;">Número de
                            Teléfono</label>
                        <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                            id="phone_number" name="phone_number"
                            value="{{ old('phone_number', $amPerson->phone_number) }}" placeholder="Ingresa solo números"
                            min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        @error('phone_number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="attendance_date" class="font-weight-bold" style="color: #355c7d;">Fecha de
                            Asistencia</label>
                        <input type="datetime-local" class="form-control @error('attendance_date') is-invalid @enderror"
                            id="attendance_date" name="attendance_date"
                            value="{{ old('attendance_date', $amPerson->attendance_date->format('Y-m-d\TH:i')) }}"
                            required>
                        @error('attendance_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-lg shadow-sm"
                        style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                    <a href="{{ route('am_people.index') }}" class="btn btn-lg btn-secondary shadow-sm"
                        style="border-radius: 8px;">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
@stop
@section('css')
<link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

@stop
@push('js')
    <script>
        document.getElementById('identity_document').addEventListener('change', function() {
            let idField = document.getElementById('id');
            let identityDocument = this.value;

            if (identityDocument === 'DNI') {
                idField.setAttribute('maxlength', 8);
            } else if (identityDocument === 'Pasaporte') {
                idField.setAttribute('maxlength', 20);
            } else {
                idField.removeAttribute('maxlength');
            }
        });
    </script>
@endpush
