@extends('adminlte::page')

@section('title', 'Editar Persona')

@section('content_header')
    <h1>Editar Persona</h1>
@stop

@section('content')
    <form action="{{ route('om-people.update', $omPerson->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="paternal_last_name">Apellido Paterno</label>
            <input type="text" class="form-control" name="paternal_last_name" value="{{ old('paternal_last_name', $omPerson->paternal_last_name) }}" required>
        </div>

        <div class="form-group">
            <label for="maternal_last_name">Apellido Materno</label>
            <input type="text" class="form-control" name="maternal_last_name" value="{{ old('maternal_last_name', $omPerson->maternal_last_name) }}" required>
        </div>

        <div class="form-group">
            <label for="given_name">Nombres</label>
            <input type="text" class="form-control" name="given_name" value="{{ old('given_name', $omPerson->given_name) }}" required>
        </div>

        <div class="form-group">
            <label for="marital_status">Estado Civil</label>
            <select class="form-control" name="marital_status" required>
                <option value="Soltero" {{ $omPerson->marital_status == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                <option value="Casado" {{ $omPerson->marital_status == 'Casado' ? 'selected' : '' }}>Casado</option>
                <option value="Divorciado" {{ $omPerson->marital_status == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                <option value="Viudo" {{ $omPerson->marital_status == 'Viudo' ? 'selected' : '' }}>Viudo</option>
                <option value="Unión libre" {{ $omPerson->marital_status == 'Unión libre' ? 'selected' : '' }}>Unión libre</option>
            </select>
        </div>

        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" name="dni" value="{{ old('dni', $omPerson->dni) }}" required>
        </div>

        <div class="form-group">
            <label for="birth_date">Fecha de Nacimiento</label>
            <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date', $omPerson->birth_date) }}" required>
        </div>

        <div class="form-group">
            <label for="age">Edad</label>
            <input type="number" class="form-control" name="age" value="{{ old('age', $omPerson->age) }}" required min="0">
        </div>

        <div class="form-group">
            <label for="gender">Género</label>
            <select class="form-control" name="gender" required>
                <option value="Masculino" {{ $omPerson->gender == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ $omPerson->gender == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ $omPerson->gender == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone', $omPerson->phone) }}">
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $omPerson->email) }}">
        </div>

        <div class="form-group">
            <label for="education_level">Nivel Educativo</label>
            <input type="text" class="form-control" name="education_level" value="{{ old('education_level', $omPerson->education_level) }}">
        </div>

        <div class="form-group">
            <label for="occupation">Ocupación</label>
            <input type="text" class="form-control" name="occupation" value="{{ old('occupation', $omPerson->occupation) }}">
        </div>

        <div class="form-group">
            <label for="health_insurance">Seguro de Salud</label>
            <select class="form-control" name="health_insurance">
                <option value="SIS" {{ $omPerson->health_insurance == 'SIS' ? 'selected' : '' }}>SIS</option>
                <option value="EsSalud" {{ $omPerson->health_insurance == 'EsSalud' ? 'selected' : '' }}>EsSalud</option>
                <option value="Seguro Privado" {{ $omPerson->health_insurance == 'Seguro Privado' ? 'selected' : '' }}>Seguro Privado</option>
                <option value="Ninguno" {{ $omPerson->health_insurance == 'Ninguno' ? 'selected' : '' }}>Ninguno</option>
            </select>
        </div>

        <div class="form-group">
            <label for="sisfoh">SISFOH</label>
            <select class="form-control" name="sisfoh">
                <option value="1" {{ $omPerson->sisfoh ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$omPerson->sisfoh ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="employment_status">Estado Laboral</label>
            <select class="form-control" name="employment_status">
                <option value="Activo" {{ $omPerson->employment_status == 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ $omPerson->employment_status == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                <option value="Pensionista" {{ $omPerson->employment_status == 'Pensionista' ? 'selected' : '' }}>Pensionista</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pension_status">Estado de Pensión</label>
            <select class="form-control" name="pension_status">
                <option value="Pensionado" {{ $omPerson->pension_status == 'Pensionado' ? 'selected' : '' }}>Pensionado</option>
                <option value="No Pensionado" {{ $omPerson->pension_status == 'No Pensionado' ? 'selected' : '' }}>No Pensionado</option>
            </select>
        </div>

        <div class="form-group">
            <label for="om_dwelling_id">Vivienda</label>
            <select class="form-control" name="om_dwelling_id">
                <option value="">Seleccione Vivienda</option>
                @foreach ($dwellings as $dwelling)
                    <option value="{{ $dwelling->id }}" {{ $omPerson->om_dwelling_id == $dwelling->id ? 'selected' : '' }}>{{ $dwelling->exact_location }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="disability_id">Discapacidad</label>
            <select class="form-control" name="disability_id">
                <option value="">Seleccione Discapacidad</option>
                @foreach ($disabilities as $disability)
                    <option value="{{ $disability->id }}" {{ $omPerson->disability_id == $disability->id ? 'selected' : '' }}>{{ $disability->certificate_number }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="caregiver_id">Cuidador</label>
            <select class="form-control" name="caregiver_id">
                <option value="">Seleccione Cuidador</option>
                @foreach ($caregivers as $caregiver)
                    <option value="{{ $caregiver->id }}" {{ $omPerson->caregiver_id == $caregiver->id ? 'selected' : '' }}>{{ $caregiver->full_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="personal_assistance_need">Necesidad de Asistencia Personal</label>
            <textarea class="form-control" name="personal_assistance_need">{{ old('personal_assistance_need', $omPerson->personal_assistance_need) }}</textarea>
        </div>

        <div class="form-group">
            <label for="autonomy_notes">Notas sobre Autonomía</label>
            <textarea class="form-control" name="autonomy_notes">{{ old('autonomy_notes', $omPerson->autonomy_notes) }}</textarea>
        </div>

        <div class="form-group">
            <label for="observations">Observaciones</label>
            <textarea class="form-control" name="observations">{{ old('observations', $omPerson->observations) }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Actualizar Persona</button>
    </form>
@stop
