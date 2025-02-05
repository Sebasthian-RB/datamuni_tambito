@extends('adminlte::page')

@section('title', 'Registrar Persona')

@section('content_header')
    <h1>Registrar Nueva Persona</h1>
@stop

@section('content')
    <form action="{{ route('om-people.store') }}" method="POST">
        @csrf

        <input type="datetime-local" class="form-control @error('registration_date') is-invalid @enderror"
            name="registration_date"
            value="{{ old('registration_date') ? \Carbon\Carbon::parse(old('registration_date'))->format('Y-m-d\TH:i') : '' }}"
            required>

        @error('registration_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="paternal_last_name">Apellido Paterno</label>
            <input type="text" class="form-control @error('paternal_last_name') is-invalid @enderror"
                name="paternal_last_name" value="{{ old('paternal_last_name') }}" required>
            @error('paternal_last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="maternal_last_name">Apellido Materno</label>
            <input type="text" class="form-control @error('maternal_last_name') is-invalid @enderror"
                name="maternal_last_name" value="{{ old('maternal_last_name') }}" required>
            @error('maternal_last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="given_name">Nombres</label>
            <input type="text" class="form-control @error('given_name') is-invalid @enderror" name="given_name"
                value="{{ old('given_name') }}" required>
            @error('given_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="marital_status">Estado Civil</label>
            <select class="form-control @error('marital_status') is-invalid @enderror" name="marital_status" required>
                <option value="Soltero">Soltero</option>
                <option value="Casado">Casado</option>
                <option value="Divorciado">Divorciado</option>
                <option value="Viudo">Viudo</option>
                <option value="Unión libre">Unión libre</option>
            </select>
            @error('marital_status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control @error('dni') is-invalid @enderror" name="dni"
                value="{{ old('dni') }}" required pattern="[0-9]{8}" title="El DNI debe tener exactamente 8 dígitos"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="8">
            @error('dni')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="birth_date">Fecha de Nacimiento</label>
            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                id="birth_date" value="{{ old('birth_date') }}" required onchange="calcularEdad()">
            @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="age">Edad</label>
            <input type="number" class="form-control @error('age') is-invalid @enderror" name="age" id="age"
                value="{{ old('age') }}" required min="0" readonly>
            @error('age')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="gender">Género</label>
            <select class="form-control" name="gender" required>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                value="{{ old('phone') }}" pattern="[0-9]+" title="Solo se permiten números"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="education_level">Nivel Educativo</label>
            <select class="form-control @error('education_level') is-invalid @enderror" name="education_level">
                <option value="">Seleccione un nivel educativo</option>
                <option value="Primaria" {{ old('education_level') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                <option value="Secundaria" {{ old('education_level') == 'Secundaria' ? 'selected' : '' }}>Secundaria
                </option>
                <option value="Técnico" {{ old('education_level') == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                <option value="Universitario" {{ old('education_level') == 'Universitario' ? 'selected' : '' }}>
                    Universitario</option>
                <option value="Postgrado" {{ old('education_level') == 'Postgrado' ? 'selected' : '' }}>Postgrado</option>
                <option value="Sin Estudios" {{ old('education_level') == 'Sin Estudios' ? 'selected' : '' }}>Sin Estudios
                </option>
            </select>
            @error('education_level')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="occupation">Ocupación</label>
            <input type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation"
                value="{{ old('occupation') }}">
            @error('occupation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="health_insurance">Seguro de Salud</label>
            <select class="form-control @error('health_insurance') is-invalid @enderror" name="health_insurance">
                <option value="SIS">SIS</option>
                <option value="EsSalud">EsSalud</option>
                <option value="Seguro Privado">Seguro Privado</option>
                <option value="Ninguno">Ninguno</option>
            </select>
            @error('health_insurance')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="sisfoh">SISFOH</label>
            <select class="form-control @error('sisfoh') is-invalid @enderror" name="sisfoh">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
            @error('sisfoh')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="employment_status">Estado Laboral</label>
            <select class="form-control @error('employment_status') is-invalid @enderror" name="employment_status">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
                <option value="Pensionista">Pensionista</option>
            </select>
            @error('employment_status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="pension_status">Estado de Pensión</label>
            <select class="form-control @error('pension_status') is-invalid @enderror" name="pension_status">
                <option value="Pensionado">Pensionado</option>
                <option value="No Pensionado">No Pensionado</option>
            </select>
            @error('pension_status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="om_dwelling_id">Vivienda</label>
            <select class="form-control @error('om_dwelling_id') is-invalid @enderror" name="om_dwelling_id">
                <option value="">Seleccione Vivienda</option>
                @foreach ($dwellings as $dwelling)
                    <option value="{{ $dwelling->id }}" {{ old('om_dwelling_id') == $dwelling->id ? 'selected' : '' }}>
                        {{ $dwelling->exact_location }}
                    </option>
                @endforeach
            </select>
            @error('om_dwelling_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="disability_id">Discapacidad</label>
            <select class="form-control @error('disability_id') is-invalid @enderror" name="disability_id">
                <option value="">Seleccione Discapacidad</option>
                @foreach ($disabilities as $disability)
                    <option value="{{ $disability->id }}"
                        {{ old('disability_id') == $disability->id ? 'selected' : '' }}>
                        {{ $disability->certificate_number }}
                    </option>
                @endforeach
            </select>
            @error('disability_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="caregiver_id">Cuidador</label>
            <select class="form-control @error('caregiver_id') is-invalid @enderror" name="caregiver_id">
                <option value="">Seleccione Cuidador</option>
                @foreach ($caregivers as $caregiver)
                    <option value="{{ $caregiver->id }}" {{ old('caregiver_id') == $caregiver->id ? 'selected' : '' }}>
                        {{ $caregiver->full_name }}
                    </option>
                @endforeach
            </select>
            @error('caregiver_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="personal_assistance_need">Necesidad de Asistencia Personal</label>
            <textarea class="form-control @error('personal_assistance_need') is-invalid @enderror"
                name="personal_assistance_need">{{ old('personal_assistance_need') }}</textarea>
            @error('personal_assistance_need')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="autonomy_notes">Notas sobre Autonomía</label>
            <textarea class="form-control @error('autonomy_notes') is-invalid @enderror" name="autonomy_notes">{{ old('autonomy_notes') }}</textarea>
            @error('autonomy_notes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="observations">Observaciones</label>
            <textarea class="form-control @error('observations') is-invalid @enderror" name="observations">{{ old('observations') }}</textarea>
            @error('observations')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Registrar Persona</button>
    </form>
@stop

@section('js')
    <script>
        function calcularEdad() {
            let birthDate = document.getElementById("birth_date").value;
            if (birthDate) {
                let today = new Date();
                let birth = new Date(birthDate);
                let age = today.getFullYear() - birth.getFullYear();
                let monthDiff = today.getMonth() - birth.getMonth();
                let dayDiff = today.getDate() - birth.getDate();

                // Ajuste si el cumpleaños no ha pasado aún este año
                if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                    age--;
                }

                document.getElementById("age").value = age > 0 ? age : 0;
            }
        }
    </script>
@stop
