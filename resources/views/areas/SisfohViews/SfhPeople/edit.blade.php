<!-- resources/views/sfh_people/edit.blade.php -->

@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Editar Persona</h2>

    <form method="POST" action="{{ route('sfh_people.update', $sfhPerson->id) }}">
        @csrf
        @method('PUT')

        <!-- Documento de Identidad -->
        <div class="form-group">
            <label for="identity_document">Tipo de Documento</label>
            <select id="identity_document" name="identity_document" class="form-control @error('identity_document') is-invalid @enderror" required>
                <option value="" disabled>Seleccione un tipo de documento...</option>
                <option value="DNI" {{ old('identity_document', $sfhPerson->identity_document) == 'DNI' ? 'selected' : '' }}>DNI</option>
                <option value="Pasaporte" {{ old('identity_document', $sfhPerson->identity_document) == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                <option value="Carnet" {{ old('identity_document', $sfhPerson->identity_document) == 'Carnet' ? 'selected' : '' }}>Carnet</option>
                <option value="Cedula" {{ old('identity_document', $sfhPerson->identity_document) == 'Cedula' ? 'selected' : '' }}>Cédula</option>
            </select>
            @error('identity_document')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Número de Documento -->
        <div class="form-group">
            <label for="id">Número de Documento</label>
            <input type="text" id="id" name="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id', $sfhPerson->id) }}" placeholder="Ingrese el número de documento" required>
            @error('id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Nombres y Apellidos -->
        <div class="form-group">
            <label for="given_name">Primer Nombre</label>
            <input type="text" id="given_name" name="given_name" class="form-control @error('given_name') is-invalid @enderror" value="{{ old('given_name', $sfhPerson->given_name) }}" placeholder="Ingrese el primer nombre" required>
            @error('given_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="paternal_last_name">Apellido Paterno</label>
            <input type="text" id="paternal_last_name" name="paternal_last_name" class="form-control @error('paternal_last_name') is-invalid @enderror" value="{{ old('paternal_last_name', $sfhPerson->paternal_last_name) }}" placeholder="Ingrese el apellido paterno" required>
            @error('paternal_last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="maternal_last_name">Apellido Materno</label>
            <input type="text" id="maternal_last_name" name="maternal_last_name" class="form-control @error('maternal_last_name') is-invalid @enderror" value="{{ old('maternal_last_name', $sfhPerson->maternal_last_name) }}" placeholder="Ingrese el apellido materno" required>
            @error('maternal_last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Estado Civil -->
        <div class="form-group">
            <label for="marital_status">Estado Civil</label>
            <select id="marital_status" name="marital_status" class="form-control @error('marital_status') is-invalid @enderror">
                <option value="" disabled>Seleccione el estado civil...</option>
                <option value="Soltero(a)" {{ old('marital_status', $sfhPerson->marital_status) == 'Soltero(a)' ? 'selected' : '' }}>Soltero(a)</option>
                <option value="Casado(a)" {{ old('marital_status', $sfhPerson->marital_status) == 'Casado(a)' ? 'selected' : '' }}>Casado(a)</option>
                <option value="Divorciado(a)" {{ old('marital_status', $sfhPerson->marital_status) == 'Divorciado(a)' ? 'selected' : '' }}>Divorciado(a)</option>
                <option value="Viudo(a)" {{ old('marital_status', $sfhPerson->marital_status) == 'Viudo(a)' ? 'selected' : '' }}>Viudo(a)</option>
            </select>
            @error('marital_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="form-group">
            <label for="birth_date">Fecha de Nacimiento</label>
            <input type="date" id="birth_date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $sfhPerson->birth_date) }}">
            @error('birth_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Sexo -->
        <div class="form-group">
            <label for="sex_type">Sexo</label>
            <select id="sex_type" name="sex_type" class="form-control @error('sex_type') is-invalid @enderror" required>
                <option value="" disabled>Seleccione el sexo...</option>
                <option value="0" {{ old('sex_type', $sfhPerson->sex_type) == '0' ? 'selected' : '' }}>Femenino</option>
                <option value="1" {{ old('sex_type', $sfhPerson->sex_type) == '1' ? 'selected' : '' }}>Masculino</option>
            </select>
            @error('sex_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Teléfono -->
        <div class="form-group">
            <label for="phone_number">Teléfono</label>
            <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $sfhPerson->phone_number) }}" placeholder="Ingrese el número de teléfono">
            @error('phone_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Nacionalidad -->
        <div class="form-group">
            <label for="nationality">Nacionalidad</label>
            <input type="text" id="nationality" name="nationality" class="form-control @error('nationality') is-invalid @enderror" value="{{ old('nationality', $sfhPerson->nationality) }}" placeholder="Ingrese la nacionalidad">
            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Grado Académico -->
        <div class="form-group">
            <label for="degree">Grado Académico</label>
            <select id="degree" name="degree" class="form-control @error('degree') is-invalid @enderror" required>
                <option value="" disabled>Seleccione el grado académico...</option>
                @foreach ($degrees as $degree)
                    <option value="{{ $degree }}" {{ old('degree', $sfhPerson->degree) == $degree ? 'selected' : '' }}>{{ $degree }}</option>
                @endforeach
            </select>
            @error('degree')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Ocupación -->
        <div class="form-group">
            <label for="occupation">Ocupación</label>
            <input type="text" id="occupation" name="occupation" class="form-control @error('occupation') is-invalid @enderror" value="{{ old('occupation', $sfhPerson->occupation) }}" placeholder="Ingrese la ocupación">
            @error('occupation')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Categoría SISFOH -->
        <div class="form-group">
            <label for="sfh_category">Categoría SISFOH</label>
            <select id="sfh_category" name="sfh_category" class="form-control @error('sfh_category') is-invalid @enderror" required>
                <option value="" disabled>Seleccione una categoría...</option>
                <option value="No pobre" {{ old('sfh_category', $sfhPerson->sfh_category) == 'No pobre' ? 'selected' : '' }}>No pobre</option>
                <option value="Pobre" {{ old('sfh_category', $sfhPerson->sfh_category) == 'Pobre' ? 'selected' : '' }}>Pobre</option>
                <option value="Pobre extremo" {{ old('sfh_category', $sfhPerson->sfh_category) == 'Pobre extremo' ? 'selected' : '' }}>Pobre extremo</option>
            </select>
            @error('sfh_category')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-success">Actualizar Persona</button>
        <a href="{{ route('sfh_people.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
