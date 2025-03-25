@extends('adminlte::page')

@section('title', 'Editar Persona')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #930813; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="card-header" style="background: #B20A16; color: white; border-radius: 15px 15px 0 0;">
        <h3 class="card-title mb-0">Editar Persona: {{ $omPerson->full_name }}</h3>
    </div>

    <div class="card-body" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
        <form method="POST" action="{{ route('om-people.update', $omPerson->id) }}">
            @csrf
            @method('PUT')

            <!-- Sección Principal -->
            <div class="row">
                <!-- Columna Izquierda - Datos Principales -->
                <div class="col-md-6">
                    <!-- Tarjeta Datos Generales -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header" style="background: #18bc9c; color: white;">
                            <h5 class="mb-0"><i class="fas fa-id-card mr-2"></i>Datos Generales</h5>
                        </div>
                        <div class="card-body">
                            <!-- Subsección Identificación -->
                            <div class="mb-4">
                                <h6 class="text-muted mb-3"><i class="fas fa-fingerprint mr-2"></i>Identificación</h6>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold" style="color: #2c3e50;">Fecha de Registro</label>
                                    <input type="datetime-local" class="form-control shadow-sm" name="registration_date"
                                        style="border: 2px solid #18bc9c; border-radius: 8px;"
                                        value="{{ old('registration_date', $omPerson->registration_date ? \Carbon\Carbon::parse($omPerson->registration_date)->format('Y-m-d\TH:i') : '') }}"
                                        required>
                                    @error('registration_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold" style="color: #2c3e50;">Documentación (DNI)</label>
                                    <input type="text" class="form-control @error('dni') is-invalid @enderror"
                                        name="dni" style="border: 2px solid #18bc9c; border-radius: 8px;"
                                        placeholder="DNI (8 dígitos)" value="{{ old('dni', $omPerson->dni) }}" required
                                        pattern="[0-9]{8}" title="El DNI debe tener exactamente 8 dígitos" maxlength="8">
                                    @error('dni')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Subsección Nombres -->
                            <div class="mb-4">
                                <h6 class="text-muted mb-3"><i class="fas fa-user-tag mr-2"></i>Nombres Completos</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control shadow-sm" name="paternal_last_name"
                                            placeholder="Apellido Paterno"
                                            style="border: 2px solid #18bc9c; border-radius: 8px;"
                                            value="{{ old('paternal_last_name', $omPerson->paternal_last_name) }}" required>
                                        @error('paternal_last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control shadow-sm" name="maternal_last_name"
                                            placeholder="Apellido Materno"
                                            style="border: 2px solid #18bc9c; border-radius: 8px;"
                                            value="{{ old('maternal_last_name', $omPerson->maternal_last_name) }}" required>
                                        @error('maternal_last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control shadow-sm" name="given_name"
                                            placeholder="Nombres" style="border: 2px solid #18bc9c; border-radius: 8px;"
                                            value="{{ old('given_name', $omPerson->given_name) }}" required>
                                        @error('given_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Subsección Estado Civil y Género -->
                            <div class="mb-4">
                                <h6 class="text-muted mb-3"><i class="fas fa-venus-mars mr-2"></i>Estado Civil y Género</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control shadow-sm" name="marital_status"
                                            style="border: 2px solid #18bc9c; border-radius: 8px;" required>
                                            <option value="Soltero"
                                                {{ $omPerson->marital_status == 'Soltero' ? 'selected' : '' }}>Soltero
                                            </option>
                                            <option value="Casado"
                                                {{ $omPerson->marital_status == 'Casado' ? 'selected' : '' }}>Casado
                                            </option>
                                            <option value="Divorciado"
                                                {{ $omPerson->marital_status == 'Divorciado' ? 'selected' : '' }}>
                                                Divorciado
                                            </option>
                                            <option value="Viudo"
                                                {{ $omPerson->marital_status == 'Viudo' ? 'selected' : '' }}>Viudo</option>
                                            <option value="Unión libre"
                                                {{ $omPerson->marital_status == 'Unión libre' ? 'selected' : '' }}>Unión
                                                libre
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control shadow-sm" name="gender"
                                            style="border: 2px solid #18bc9c; border-radius: 8px;" required>
                                            <option value="Masculino"
                                                {{ $omPerson->gender == 'Masculino' ? 'selected' : '' }}>
                                                Masculino</option>
                                            <option value="Femenino"
                                                {{ $omPerson->gender == 'Femenino' ? 'selected' : '' }}>
                                                Femenino</option>
                                            <option value="Otro" {{ $omPerson->gender == 'Otro' ? 'selected' : '' }}>Otro
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Subsección Nacimiento -->
                            <div class="mb-4">
                                <h6 class="text-muted mb-3"><i class="fas fa-birthday-cake mr-2"></i>Fecha de Nacimiento
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="date"
                                            class="form-control shadow-sm @error('birth_date') is-invalid @enderror"
                                            name="birth_date" style="border: 2px solid #18bc9c; border-radius: 8px;"
                                            id="birth_date"
                                            value="{{ old('birth_date', isset($omPerson) ? $omPerson->birth_date->format('Y-m-d') : '') }}"
                                            required onchange="calcularEdad()">

                                        @error('birth_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <input type="number" class="form-control shadow-sm" name="age"
                                            style="border: 2px solid #18bc9c; border-radius: 8px;" id="age"
                                            value="{{ old('age', $omPerson->age) }}" required readonly>
                                        @error('age')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta Contacto -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header" style="background: #3498db; color: white;">
                            <h5 class="mb-0"><i class="fas fa-address-book mr-2"></i>Datos de Contacto</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h6 class="text-muted mb-3"><i class="fa fa-address-card mr-2"></i>Teléfono y Email</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control shadow-sm" name="phone"
                                            style="border: 2px solid #3498db; border-radius: 8px;" placeholder="Teléfono"
                                            value="{{ old('phone', $omPerson->phone) }}" pattern="[0-9]+"
                                            title="Solo se permiten números" maxlength="9">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <input type="email" class="form-control shadow-sm" name="email"
                                            style="border: 2px solid #3498db; border-radius: 8px;"
                                            placeholder="Correo Electrónico"
                                            value="{{ old('email', $omPerson->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta Vivienda -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header" style="background: #f39c12; color: white;">
                            <h5 class="mb-0"><i class="fas fa-home mr-2"></i>Datos de Vivienda</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <h6 class="text-muted mb-3"><i class="fas fa-map-marker mr-2"></i>Vivienda</h6>
                                <div class="input-group">
                                    <select class="form-control" name="om_dwelling_id"
                                        style="border: 2px solid #18bc9c; border-radius: 8px;" required>
                                        <option value="">Seleccione Vivienda</option>
                                        @foreach ($dwellings as $dwelling)
                                            <option value="{{ $dwelling->id }}"
                                                {{ $omPerson->om_dwelling_id == $dwelling->id ? 'selected' : '' }}>
                                                {{ $dwelling->exact_location }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-circle btn-blue" data-toggle="modal"
                                            data-target="#dwellingModal">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('om_dwelling_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha - Datos Secundarios -->
                <div class="col-md-6">
                    <!-- Tarjeta Salud -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header" style="background: #F00E1C; color: white;">
                            <h5 class="mb-0"><i class="fas fa-heartbeat mr-2"></i>Información de Salud</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Discapacidad</label>
                                <div class="input-group">
                                    <select class="form-control" name="disability_id"
                                        style="border: 2px solid #18bc9c; border-radius: 8px;">
                                        <option value="">Seleccione Discapacidad</option>
                                        @foreach ($disabilities as $disability)
                                            <option value="{{ $disability->id }}"
                                                {{ $omPerson->disability_id == $disability->id ? 'selected' : '' }}>
                                                {{ $disability->certificate_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-circle btn-red" data-toggle="modal"
                                            data-target="#disabilityModal">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('disability_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Cuidador</label>
                                <div class="input-group">
                                    <select class="form-control" name="caregiver_id"
                                        style="border: 2px solid #18bc9c; border-radius: 8px;">
                                        <option value="">Seleccione Cuidador</option>
                                        @foreach ($caregivers as $caregiver)
                                            <option value="{{ $caregiver->id }}"
                                                {{ $omPerson->caregiver_id == $caregiver->id ? 'selected' : '' }}>
                                                {{ $caregiver->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-circle btn-red" data-toggle="modal"
                                            data-target="#caregiverModal">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('caregiver_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Seguro de Salud</label>
                                <select class="form-control" name="health_insurance"
                                    style="border: 2px solid #18bc9c; border-radius: 8px;">
                                    <option value="SIS" {{ $omPerson->health_insurance == 'SIS' ? 'selected' : '' }}>
                                        SIS
                                    </option>
                                    <option value="EsSalud"
                                        {{ $omPerson->health_insurance == 'EsSalud' ? 'selected' : '' }}>
                                        EsSalud</option>
                                    <option value="Seguro Privado"
                                        {{ $omPerson->health_insurance == 'Seguro Privado' ? 'selected' : '' }}>Seguro
                                        Privado
                                    </option>
                                    <option value="Ninguno"
                                        {{ $omPerson->health_insurance == 'Ninguno' ? 'selected' : '' }}>
                                        Ninguno</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>SISFOH</label>
                                <select class="form-control" name="sisfoh"
                                    style="border: 2px solid #18bc9c; border-radius: 8px;">
                                    <option value="1" {{ $omPerson->sisfoh ? 'selected' : '' }}>Sí</option>
                                    <option value="0" {{ !$omPerson->sisfoh ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Estado de Pensión</label>
                                <select class="form-control" name="pension_status"
                                    style="border: 2px solid #18bc9c; border-radius: 8px;">
                                    <option value="Pensionado"
                                        {{ $omPerson->pension_status == 'Pensionado' ? 'selected' : '' }}>Pensionado
                                    </option>
                                    <option value="No Pensionado"
                                        {{ $omPerson->pension_status == 'No Pensionado' ? 'selected' : '' }}>No Pensionado
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Necesidad de Asistencia Personal</label>
                                <textarea class="form-control" name="personal_assistance_need"
                                    style="border: 2px solid #18bc9c; border-radius: 8px;">{{ old('personal_assistance_need', $omPerson->personal_assistance_need) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Notas sobre Autonomía</label>
                                <textarea class="form-control" name="autonomy_notes" style="border: 2px solid #18bc9c; border-radius: 8px;">{{ old('autonomy_notes', $omPerson->autonomy_notes) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta Educación -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header" style="background: #9b59b6; color: white;">
                            <h5 class="mb-0"><i class="fas fa-graduation-cap mr-2"></i>Educación y Ocupación</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nivel Educativo</label>
                                <select class="form-control" name="education_level"
                                    style="border: 2px solid #18bc9c; border-radius: 8px;">
                                    <option value="">Seleccione Nivel</option>
                                    <option value="Primaria"
                                        {{ $omPerson->education_level == 'Primaria' ? 'selected' : '' }}>
                                        Primaria</option>
                                    <option value="Secundaria"
                                        {{ $omPerson->education_level == 'Secundaria' ? 'selected' : '' }}>Secundaria
                                    </option>
                                    <option value="Técnico"
                                        {{ $omPerson->education_level == 'Técnico' ? 'selected' : '' }}>
                                        Técnico</option>
                                    <option value="Universitario"
                                        {{ $omPerson->education_level == 'Universitario' ? 'selected' : '' }}>Universitario
                                    </option>
                                    <option value="Postgrado"
                                        {{ $omPerson->education_level == 'Postgrado' ? 'selected' : '' }}>Postgrado
                                    </option>
                                    <option value="Sin Estudios"
                                        {{ $omPerson->education_level == 'Sin Estudios' ? 'selected' : '' }}>Sin Estudios
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Ocupación</label>
                                <input type="text" class="form-control" name="occupation"
                                    style="border: 2px solid #18bc9c; border-radius: 8px;"
                                    value="{{ old('occupation', $omPerson->occupation) }}">
                            </div>

                            <div class="form-group">
                                <label>Estado Laboral</label>
                                <select class="form-control" name="employment_status"
                                    style="border: 2px solid #18bc9c; border-radius: 8px;">
                                    <option value="Activo"
                                        {{ $omPerson->employment_status == 'Activo' ? 'selected' : '' }}>
                                        Activo</option>
                                    <option value="Inactivo"
                                        {{ $omPerson->employment_status == 'Inactivo' ? 'selected' : '' }}>Inactivo
                                    </option>
                                    <option value="Pensionista"
                                        {{ $omPerson->employment_status == 'Pensionista' ? 'selected' : '' }}>Pensionista
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nueva fila para Observaciones -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header" style="background: #95a5a6; color: white;">
                            <h5 class="mb-0"><i class="fas fa-edit mr-2"></i>Observaciones Generales</h5>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" name="observations" style="border: 2px solid #18bc9c; border-radius: 8px;"
                                rows="3">{{ old('observations', $omPerson->observations) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones Finales -->
            <div class="row mt-4">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-lg shadow-sm"
                        style="background: #2c3e50; border-color: #2c3e50; color: white; border-radius: 8px;">
                        <i class="fas fa-save"></i> Actualizar Persona
                    </button>
                    <a href="{{ route('om-people.index') }}" class="btn btn-lg btn-secondary shadow-sm"
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
@section('js')
    <script>
        function calcularEdad() {
            const fechaNacimiento = new Date(document.getElementById('birth_date').value);
            const hoy = new Date();
            let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
            const mes = hoy.getMonth() - fechaNacimiento.getMonth();
            if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                edad--;
            }
            document.getElementById('age').value = edad;
        }
    </script>
@stop
