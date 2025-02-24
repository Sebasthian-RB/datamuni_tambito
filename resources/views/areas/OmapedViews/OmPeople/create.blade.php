@extends('adminlte::page')

@section('title', 'Registrar Persona')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #930813; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('om-people.store') }}" method="POST" class="card shadow-lg" style="border-radius: 15px;">
            @csrf

            <div class="card-header" style="background: #B20A16; color: white; border-radius: 15px 15px 0 0;">
                <h3 class="card-title mb-0"><i class="fas fa-user-tag mr-2"></i>Registro de Nueva Persona</h3>
            </div>

            <div class="card-body" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">

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
                                            value="{{ old('registration_date') ? \Carbon\Carbon::parse(old('registration_date'))->format('Y-m-d\TH:i') : '' }}"
                                            required>
                                        @error('registration_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" style="color: #2c3e50;">Documentación (DNI)</label>
                                        <input type="text" class="form-control @error('dni') is-invalid @enderror"
                                            name="dni" style="border: 2px solid #18bc9c; border-radius: 8px;"
                                            placeholder="DNI (8 dígitos)" value="{{ old('dni') }}" required
                                            pattern="[0-9]{8}" title="El DNI debe tener exactamente 8 dígitos"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="8">
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
                                            <input type="text" class="form-control shadow-sm text-capitalize"
                                                name="paternal_last_name" placeholder="Apellido Paterno"
                                                style="border: 2px solid #18bc9c; border-radius: 8px;"
                                                value="{{ old('paternal_last_name') }}" required oninput="formatName(this)">
                                            @error('paternal_last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <input type="text" class="form-control shadow-sm text-capitalize"
                                                name="maternal_last_name" placeholder="Apellido Materno"
                                                style="border: 2px solid #18bc9c; border-radius: 8px;"
                                                value="{{ old('maternal_last_name') }}" required oninput="formatName(this)">
                                            @error('maternal_last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <input type="text" class="form-control shadow-sm text-capitalize"
                                                name="given_name" placeholder="Nombres"
                                                style="border: 2px solid #18bc9c; border-radius: 8px;"
                                                value="{{ old('given_name') }}" required oninput="formatName(this)">
                                            @error('given_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Subsección Estado Civil y Género -->
                                <div class="mb-4">
                                    <h6 class="text-muted mb-3"><i class="fas fa-venus-mars mr-2"></i>Estado Civil y Género
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-control shadow-sm" name="marital_status"
                                                style="border: 2px solid #18bc9c; border-radius: 8px;" required>
                                                <option value="">Estado Civil</option>
                                                <option value="Soltero">Soltero</option>
                                                <option value="Casado">Casado</option>
                                                <option value="Divorciado">Divorciado</option>
                                                <option value="Viudo">Viudo</option>
                                                <option value="Unión libre">Unión libre</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control shadow-sm" name="gender"
                                                style="border: 2px solid #18bc9c; border-radius: 8px;" required>
                                                <option value="">Género</option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Femenino">Femenino</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Subsección De edad y nacimiento -->
                                <div class="mb-4">
                                    <h6 class="text-muted mb-3"><i class="fas fa-birthday-cake mr-2"></i>Fecha de
                                        Nacimiento
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6"> <input type="date"
                                                class="form-control shadow-sm @error('birth_date') is-invalid @enderror"
                                                name="birth_date" style="border: 2px solid #18bc9c; border-radius: 8px;"
                                                id="birth_date" value="{{ old('birth_date') }}" required
                                                onchange="calcularEdad()" placeholder="Fecha de Nacimiento">
                                            @error('birth_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <input type="number" class="form-control shadow-sm" name="age"
                                                style="border: 2px solid #18bc9c; border-radius: 8px;" id="age"
                                                value="{{ old('age') }}" required readonly placeholder="Edad">
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
                                    <h6 class="text-muted mb-3"><i class="fa fa-address-card mr-2"></i>Teléfono y Email
                                    </h6>
                                    <!-- Contenido contacto -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text"
                                                class="form-control shadow-sm @error('phone') is-invalid @enderror"
                                                name="phone" style="border: 2px solid #3498db; border-radius: 8px;"
                                                placeholder="Teléfono" value="{{ old('phone') }}" pattern="[0-9]+"
                                                title="Solo se permiten números"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                maxlength="9">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <input type="email" class="form-control shadow-sm" name="email"
                                                style="border: 2px solid #3498db; border-radius: 8px;"
                                                placeholder="Correo Electrónico" value="{{ old('email') }}">
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
                                <!-- Contenido vivienda -->
                                <div class="form-group">
                                    <h6 class="text-muted mb-3"><i class="fas fa-map-marker mr-2"></i>Vivienda</h5>
                                        <div class="input-group mb-3">
                                            <select
                                                class="form-control select2 @error('om_dwelling_id') is-invalid @enderror"
                                                style="border: 2px solid #18bc9c; border-radius: 8px;"
                                                name="disability_id" name="om_dwelling_id" id="om_dwelling_id" required>
                                                <option value="">Seleccione Vivienda</option>
                                                @foreach ($dwellings as $dwelling)
                                                    <option value="{{ $dwelling->id }}"
                                                        {{ old('om_dwelling_id') == $dwelling->id ? 'selected' : '' }}>
                                                        {{ $dwelling->exact_location }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <!-- Botón 2: Circular y de color azul -->
                                            <button type="button" class="btn btn-circle btn-blue" data-toggle="modal"
                                                data-target="#dwellingModal">
                                                <i class="fas fa-plus"></i>
                                            </button>
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
                                <!-- Formulario de Salud -->
                                <form>
                                    <div class="form-group">
                                        <label for="disability_id">Certificado de Discapacidad</label>
                                        <div class="input-group">
                                            <select
                                                class="form-control select2 @error('disability_id') is-invalid @enderror"
                                                style="border: 2px solid #18bc9c; border-radius: 8px;"
                                                name="disability_id" id="disability_id"
                                                data-placeholder="Seleccione Discapacidad">
                                                <option value=""></option>
                                                @foreach ($disabilities as $disability)
                                                    <option value="{{ $disability->id }}"
                                                        {{ old('disability_id') == $disability->id ? 'selected' : '' }}>
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
                                        <label for="caregiver_id">Cuidador</label>
                                        <div class="input-group">
                                            <select
                                                class="form-control select2 @error('caregiver_id') is-invalid @enderror"
                                                id="caregiver_id" name="caregiver_id"
                                                style="border: 2px solid #18bc9c; border-radius: 8px;">
                                                <option value="">Seleccione Cuidador</option>
                                                @foreach ($caregivers as $caregiver)
                                                    <option value="{{ $caregiver->id }}"
                                                        {{ old('caregiver_id') == $caregiver->id ? 'selected' : '' }}>
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
                                        <label for="health_insurance">Seguro de Salud</label>
                                        <select class="form-control @error('health_insurance') is-invalid @enderror"
                                            style="border: 2px solid #18bc9c; border-radius: 8px;"
                                            name="health_insurance">
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
                                        <select class="form-control @error('sisfoh') is-invalid @enderror" name="sisfoh"
                                            style="border: 2px solid #18bc9c; border-radius: 8px;">
                                            <option value="1">Sí</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error('sisfoh')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pension_status">Estado de Pensión</label>
                                        <select class="form-control @error('pension_status') is-invalid @enderror"
                                            style="border: 2px solid #18bc9c; border-radius: 8px;" name="pension_status">
                                            <option value="Pensionado">Pensionado</option>
                                            <option value="No Pensionado">No Pensionado</option>
                                        </select>
                                        @error('pension_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="personal_assistance_need">Necesidad de Asistencia Personal</label>
                                        <textarea class="form-control @error('personal_assistance_need') is-invalid @enderror"
                                            style="border: 2px solid #18bc9c; border-radius: 8px;" name="personal_assistance_need">{{ old('personal_assistance_need') }}</textarea>
                                        @error('personal_assistance_need')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="autonomy_notes">Notas sobre Autonomía</label>
                                        <textarea class="form-control @error('autonomy_notes') is-invalid @enderror"
                                            style="border: 2px solid #18bc9c; border-radius: 8px;" name="autonomy_notes">{{ old('autonomy_notes') }}</textarea>
                                        @error('autonomy_notes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Tarjeta Educación -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header" style="background: #9b59b6; color: white;">
                                <h5 class="mb-0"><i class="fas fa-graduation-cap mr-2"></i>Educación y Ocupación</h5>
                            </div>
                            <div class="card-body">
                                <!-- Contenido educación -->
                                <!-- Campos de educación y ocupación -->
                                <div class="form-group">
                                    <label for="education_level">Nivel Educativo</label>
                                    <select class="form-control @error('education_level') is-invalid @enderror"
                                        style="border: 2px solid #18bc9c; border-radius: 8px;" name="education_level">
                                        <option value="">Seleccione un nivel educativo</option>
                                        <option value="Primaria"
                                            {{ old('education_level') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                                        <option value="Secundaria"
                                            {{ old('education_level') == 'Secundaria' ? 'selected' : '' }}>Secundaria
                                        </option>
                                        <option value="Técnico"
                                            {{ old('education_level') == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                                        <option value="Universitario"
                                            {{ old('education_level') == 'Universitario' ? 'selected' : '' }}>
                                            Universitario</option>
                                        <option value="Postgrado"
                                            {{ old('education_level') == 'Postgrado' ? 'selected' : '' }}>Postgrado
                                        </option>
                                        <option value="Sin Estudios"
                                            {{ old('education_level') == 'Sin Estudios' ? 'selected' : '' }}>Sin Estudios
                                        </option>
                                    </select>
                                    @error('education_level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="occupation">Ocupación</label>
                                    <input type="text" class="form-control @error('occupation') is-invalid @enderror"
                                        style="border: 2px solid #18bc9c; border-radius: 8px;" name="occupation"
                                        value="{{ old('occupation') }}">
                                    @error('occupation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="employment_status">Estado Laboral</label>
                                    <select class="form-control @error('employment_status') is-invalid @enderror"
                                        style="border: 2px solid #18bc9c; border-radius: 8px;" name="employment_status">
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                        <option value="Pensionista">Pensionista</option>
                                    </select>
                                    @error('employment_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección Observaciones -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header" style="background: #95a5a6; color: white;">
                        <h5 class="mb-0"><i class="fas fa-edit mr-2"></i>Observaciones Generales</h5>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control @error('observations') is-invalid @enderror"
                            style="border: 2px solid #18bc9c; border-radius: 8px;" rows="3" name="observations">{{ old('observations') }}</textarea>
                        @error('observations')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Botones Finales -->
                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-lg shadow-sm"
                        style="background: #2c3e50; border-color: #2c3e50; color: white; border-radius: 8px;">
                        <i class="fas fa-save"></i> Registrar Persona
                    </button>
                    <a href="{{ route('om-people.index') }}" class="btn btn-lg btn-secondary shadow-sm"
                        style="border-radius: 8px;">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal para nueva vivienda -->
    <div class="modal fade" id="dwellingModal" tabindex="-1" role="dialog" aria-labelledby="dwellingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content animate__animated animate__fadeInDown">
                <!-- Encabezado -->
                <div class="modal-header text-white" style="background-color: #f39c12;">
                    <h5 class="modal-title" id="dwellingModalLabel">Registrar Nueva Vivienda</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Cuerpo -->
                <div class="modal-body">
                    <form id="dwellingForm">
                        @csrf
                        <div class="row">
                            <!-- Primera Columna -->
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 mb-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exact_location">Localización Exacta</label>
                                            <input type="text" name="exact_location" class="form-control" required>
                                            <span class="error-message text-danger"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="reference">Referencia</label>
                                            <textarea name="reference" class="form-control"></textarea>
                                            <span class="error-message text-danger"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="annex_sector">Anexo/Sector</label>
                                            <input type="text" name="annex_sector" class="form-control">
                                            <span class="error-message text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Segunda Columna -->
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 mb-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="water_electricity">Agua y/o Luz</label>
                                            <select name="water_electricity" class="form-control">
                                                <option value="">Seleccione</option>
                                                <option value="Agua">Agua</option>
                                                <option value="Luz">Luz</option>
                                                <option value="Agua y Luz">Agua y Luz</option>
                                                <option value="Ninguno">Ninguno</option>
                                            </select>
                                            <span class="error-message text-danger"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="type">Tipo de Vivienda</label>
                                            <input type="text" name="type" class="form-control">
                                            <span class="error-message text-danger"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="ownership_status">Situación de Vivienda</label>
                                            <select name="ownership_status" class="form-control">
                                                <option value="">Seleccione</option>
                                                <option value="Propia">Propia</option>
                                                <option value="Alquilada">Alquilada</option>
                                                <option value="Prestada">Prestada</option>
                                            </select>
                                            <span class="error-message text-danger"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="permanent_occupants">Ocupantes Permanentes</label>
                                            <input type="number" name="permanent_occupants" class="form-control">
                                            <span class="error-message text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="button" class="btn text-white" style="background-color: #f39c12;" id="saveDwelling">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para discapacidad -->
    <div class="modal fade" id="disabilityModal" tabindex="-1" role="dialog" aria-labelledby="disabilityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #f00e1c; color: #fff;">
                    <h5 class="modal-title" id="disabilityModalLabel">Registrar Discapacidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="disabilityForm">
                        @csrf
                        <div class="card-deck">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>N° Certificado</label>
                                        <input type="text" name="certificate_number" class="form-control" required>
                                        <span class="text-danger error-certificate_number"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha de Emisión</label>
                                        <input type="date" name="certificate_issue_date" class="form-control"
                                            required>
                                        <span class="text-danger error-certificate_issue_date"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha de Caducidad</label>
                                        <input type="date" name="certificate_expiry_date" class="form-control">
                                        <span class="text-danger error-certificate_expiry_date"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Organización</label>
                                        <input type="text" name="organization_name" class="form-control" required>
                                        <span class="text-danger error-organization_name"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Diagnóstico</label>
                                        <input type="text" name="diagnosis" class="form-control" required>
                                        <span class="text-danger error-diagnosis"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipo de Discapacidad</label>
                                        <input type="text" name="disability_type" class="form-control" required>
                                        <span class="text-danger error-disability_type"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Nivel de Gravedad</label>
                                        <select name="severity_level" class="form-control">
                                            <option value="Leve">Leve</option>
                                            <option value="Moderado">Moderado</option>
                                            <option value="Severo">Severo</option>
                                        </select>
                                        <span class="text-danger error-severity_level"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Dispositivos Necesarios</label>
                                        <textarea name="required_support_devices" class="form-control"></textarea>
                                        <span class="text-danger error-required_support_devices"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Dispositivos Usados</label>
                                        <textarea name="used_support_devices" class="form-control"></textarea>
                                        <span class="text-danger error-used_support_devices"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="saveDisability" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para nuevo cuidador -->
    <div class="modal fade" id="caregiverModal" tabindex="-1" role="dialog" aria-labelledby="caregiverModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content animate__animated animate__fadeInDown">
                <!-- Encabezado -->
                <div class="modal-header text-white" style="background-color: #f00e1c;">
                    <h5 class="modal-title" id="caregiverModalLabel">Registrar Nuevo Cuidador</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Cuerpo -->
                <div class="modal-body">
                    <form id="caregiverForm">
                        @csrf
                        <div class="row">
                            <!-- Primera Columna -->
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 mb-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="full_name">Nombre Completo</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name"
                                                required oninput="formatName(this)">
                                            <span class="error-message text-danger"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="dni">DNI</label>
                                            <input type="text" class="form-control" id="dni" name="dni"
                                                maxlength="8" required oninput="validateDNI(this)">
                                            <span class="error-message text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Segunda Columna -->
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 mb-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="phone">Teléfono</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                maxlength="9" required oninput="validatePhone(this)">
                                            <span class="error-message text-danger"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="relationship">Relación</label>
                                            <select class="form-control" id="relationship" name="relationship" required>
                                                <option value="">Seleccione...</option>
                                                <option value="Padre">Padre</option>
                                                <option value="Madre">Madre</option>
                                                <option value="Hermano/a">Hermano/a</option>
                                                <option value="Tío/a">Tío/a</option>
                                                <option value="Abuelo/a">Abuelo/a</option>
                                                <option value="Tutor/a">Tutor/a</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="button" class="btn text-white" style="background-color: #f39c12;" id="saveCaregiver">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Animación para el modal */
        .modal.fade .modal-dialog {
            transform: translateY(-50px);
            transition: transform 0.3s ease-out;
        }

        .modal.show .modal-dialog {
            transform: translateY(0);
        }

        /* Estilo para las tarjetas */
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .form-control {
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3498db !important;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25) !important;
        }

        .select2-container--default .select2-selection--single {
            border: 2px solid #18bc9c !important;
            border-radius: 8px !important;
            height: calc(2.25rem + 4px) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
        }

        .input-group-text {
            background: #18bc9c;
            color: white;
            border: none;
        }

        /* Estilo para el botón circular */
        .btn-circle {
            width: 35px;
            height: 35px;
            padding: 6px;
            border-radius: 50%;
            text-align: center;
            font-size: 15px;
            line-height: 1.3;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Estilo para el botón rojo */
        .btn-red {
            background-color: #f00e1c;
        }

        .btn-red:hover {
            background-color: #d00c19;
            transform: translateY(-2px);
        }

        .btn-red:active {
            background-color: #b00a16;
            transform: translateY(0);
        }

        /* Botón azul */
        .btn-blue {
            background-color: #f39c12;
        }

        .btn-blue:hover {
            background-color: #ff9d00;
            transform: translateY(-2px);
        }

        .btn-blue:active {
            background-color: #c87b00;
            transform: translateY(0);
        }
    </style>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Validar nombres -->
    <script>
        // Función para formatear nombres con la primera letra en mayúscula
        function formatName(input) {
            input.value = input.value.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
        }

        // Función para validar el DNI (solo números y 8 dígitos)
        function validateDNI(input) {
            input.value = input.value.replace(/\D/g, ''); // Elimina cualquier carácter que no sea número
            if (input.value.length > 8) {
                input.value = input.value.slice(0, 8); // Limita a 8 caracteres
            }
        }

        // Función para validar el Teléfono (solo números y 9 dígitos)
        function validatePhone(input) {
            input.value = input.value.replace(/\D/g, ''); // Elimina cualquier carácter que no sea número
            if (input.value.length > 9) {
                input.value = input.value.slice(0, 9); // Limita a 9 caracteres
            }
        }
    </script>
    <!-- Select 2-->
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: "bootstrap",
                width: '100%'
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#disability_id').select2({
                placeholder: "Seleccione Discapacidad",
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#caregiver_id').select2({
                placeholder: "Seleccione Cuidador",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#om_dwelling_id').select2({
                placeholder: "Seleccione una Vivienda",
                allowClear: true
            });
        });
    </script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };
    </script>
    <!-- Calcular Edad -->
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

    <!-- Ajax del modal de vivienda -->
    <script>
        $(document).ready(function() {
            $('#saveDwelling').click(function() {
                $.ajax({
                    url: '{{ route('om-dwellings.store') }}',
                    method: 'POST',
                    data: $('#dwellingForm').serialize(),
                    dataType: 'json', // Añadir esta línea
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    beforeSend: function() {
                        $('#saveDwelling').prop('disabled', true).html(
                            '<i class="fas fa-spinner fa-spin"></i> Guardando...');
                    },
                    success: function(response) {
                        // Añadir nueva opción al select y seleccionarla
                        var newOption = new Option(response.dwelling.exact_location, response
                            .dwelling.id, true, true);
                        $('#om_dwelling_id').append(newOption).trigger('change');

                        // Cerrar modal y limpiar formulario
                        $('#dwellingModal').modal('hide');
                        $('#dwellingForm')[0].reset();

                        // Mostrar notificación
                        toastr.success('Vivienda registrada exitosamente');
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors || {};
                        let errorMessages = 'Error desconocido';

                        if (xhr.status === 422) {
                            errorMessages = Object.values(errors).join('\n');
                        }

                        toastr.error(errorMessages);
                    },
                    complete: function() {
                        $('#saveDwelling').prop('disabled', false).html('Guardar');
                        // Si aún queda un backdrop en el DOM, elimínalo
                        if ($('.modal-backdrop').length) {
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open');
                        }
                    }
                });
            });
        });
    </script>

    <!-- Ajax del modal de discapacidad -->

    <script>
        $(document).ready(function() {
            $('#saveDisability').click(function() {
                let formData = $('#disabilityForm').serialize();

                // Limpiar errores anteriores
                $('.text-danger').text('');

                $.ajax({
                    url: '{{ route('disabilities.store') }}',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    beforeSend: function() {
                        $('#saveDisability').prop('disabled', true).html(
                            '<i class="fas fa-spinner fa-spin"></i> Guardando...'
                        );
                    },
                    success: function(response) {
                        if (response.success && response.disability) {
                            // Crear y agregar la nueva opción al select
                            let newOption = new Option(
                                response.disability.certificate_number,
                                response.disability.id,
                                true, // selected
                                true // selected
                            );

                            // Agregar al select
                            $('#disability_id').append(newOption);

                            // Actualizar Select2 si está en uso
                            if ($('#disability_id').hasClass('select2-hidden-accessible')) {
                                $('#disability_id').trigger('change.select2');
                            }

                            // Cerrar modal y resetear formulario
                            $('#disabilityModal').modal('hide');
                            $('#disabilityForm')[0].reset();

                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Mostrar errores de validación
                            let errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(function(key) {
                                $('.error-' + key).text(errors[key][0]);
                            });
                        } else {
                            toastr.error('Error inesperado. Intente nuevamente.');
                        }
                    },
                    complete: function() {
                        $('#saveDisability').prop('disabled', false).html(
                            '<i class="fas fa-save"></i> Guardar'
                        );
                        // Limpiar backdrop si es necesario
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                    }
                });
            });
        });
    </script>

    <!-- Ajax del modal de cuidador -->
    <script>
        $(document).ready(function() {
            $('#saveCaregiver').click(function() {
                let formData = $('#caregiverForm').serialize();

                // Limpiar errores previos
                $('.error-message').text('');

                $.ajax({
                    url: '{{ route('caregivers.store') }}',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    beforeSend: function() {
                        $('#saveCaregiver').prop('disabled', true).html(
                            '<i class="fas fa-spinner fa-spin"></i> Guardando...'
                        );
                    },
                    success: function(response) {
                        if (response.success && response.caregiver) {
                            // Agregar la nueva opción al select
                            let newOption = new Option(
                                response.caregiver.full_name,
                                response.caregiver.id,
                                true, // selected
                                true // selected
                            );

                            $('#caregiver_id').append(newOption);

                            // Si se usa Select2, refrescar el select
                            if ($('#caregiver_id').hasClass('select2-hidden-accessible')) {
                                $('#caregiver_id').trigger('change.select2');
                            }

                            // Cerrar modal y resetear formulario
                            $('#caregiverModal').modal('hide');
                            $('#caregiverForm')[0].reset();

                            toastr.success('¡Cuidador registrado exitosamente!');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(function(key) {
                                $('.error-message').text(errors[key][0]);
                            });
                        } else {
                            toastr.error('Error inesperado. Intente nuevamente.');
                        }
                    },
                    complete: function() {
                        $('#saveCaregiver').prop('disabled', false).html(
                            '<i class="fas fa-save"></i> Guardar'
                        );
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                    }
                });
            });
        });
    </script>

@stop
