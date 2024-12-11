<!-- resources/views/areas/AreaDeLaMujerViews/AmPersons/edit.blade.php -->
@extends('adminlte::page')

@section('title', 'Editar Persona')

@section('content_header')
    <h1>Editar Persona</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('am_people.update', $amPerson->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulario para editar persona</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="id">N° Documento</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id', $amPerson->id) }}" required>
                    @error('id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="identity_document">Documento de Identidad</label>
                    <select class="form-control @error('identity_document') is-invalid @enderror" id="identity_document" name="identity_document" required>
                        <option value="DNI" @selected($amPerson->identity_document == 'DNI')>DNI</option>
                        <option value="Pasaporte" @selected($amPerson->identity_document == 'Pasaporte')>Pasaporte</option>
                        <option value="Carnet" @selected($amPerson->identity_document == 'Carnet')>Carnet</option>
                        <option value="Cedula" @selected($amPerson->identity_document == 'Cedula')>Cedula</option>
                    </select>
                    @error('identity_document')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="given_name">Nombre</label>
                    <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name" name="given_name" value="{{ old('given_name', $amPerson->given_name) }}" required>
                    @error('given_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="paternal_last_name">Apellido Paterno</label>
                    <input type="text" class="form-control @error('paternal_last_name') is-invalid @enderror" id="paternal_last_name" name="paternal_last_name" value="{{ old('paternal_last_name', $amPerson->paternal_last_name) }}" required>
                    @error('paternal_last_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="maternal_last_name">Apellido Materno</label>
                    <input type="text" class="form-control @error('maternal_last_name') is-invalid @enderror" id="maternal_last_name" name="maternal_last_name" value="{{ old('maternal_last_name', $amPerson->maternal_last_name) }}" required>
                    @error('maternal_last_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $amPerson->address) }}">
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sex_type">Sexo</label>
                    <select class="form-control @error('sex_type') is-invalid @enderror" id="sex_type" name="sex_type" required>
                        <option value="1" @selected(old('sex_type', $amPerson->sex_type) == '1')>Masculino</option>
                        <option value="0" @selected(old('sex_type', $amPerson->sex_type) == '0')>Femenino</option>
                    </select>
                    @error('sex_type')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Número de Teléfono</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $amPerson->phone_number) }}">
                    @error('phone_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="attendance_date">Fecha de Asistencia</label>
                    <input type="datetime-local" class="form-control @error('attendance_date') is-invalid @enderror" id="attendance_date" name="attendance_date" value="{{ old('attendance_date', $amPerson->attendance_date->format('Y-m-d\TH:i')) }}" required>
                    @error('attendance_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Actualizar Persona</button>
            </div>
        </div>
    </form>
</div>
@stop

@push('js')
<script>
    // Actualiza la validación del ID según el tipo de documento seleccionado
    document.getElementById('identity_document').addEventListener('change', function () {
        let idField = document.getElementById('id');
        let identityDocument = this.value;

        if (identityDocument === 'DNI') {
            idField.setAttribute('maxlength', 8);
        }
    else if (identityDocument === 'Pasaporte') {
            idField.setAttribute('maxlength', 20);
        } else {
            idField.removeAttribute('maxlength');
        }
    });
</script>
@endpush