@extends('adminlte::page')

@section('title', 'Detalles de Persona')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #930813; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card shadow-lg" style="border-radius: 15px;">
            <div class="card-header" style="background: #B20A16; color: white; border-radius: 15px 15px 0 0;">
                <h3 class="card-title mb-0"><i class="fas fa-user-tag mr-2"></i>Información Completa</h3>
            </div>
            <div class="card-body" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col-md-6">
                        <!-- Datos Generales -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header" style="background: #18bc9c; color: white;">
                                <h5 class="mb-0"><i class="fas fa-id-card mr-2"></i>Datos Generales</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="font-weight-bold">Fecha de Registro</label>
                                    <div class="form-control-static"
                                        style="border: 2px solid #18bc9c; border-radius: 8px; padding: 8px;">
                                        {{ $omPerson->registration_date }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Nombre Completo</label>
                                    <div class="form-control-static"
                                        style="border: 2px solid #18bc9c; border-radius: 8px; padding: 8px;">
                                        {{ $omPerson->paternal_last_name }} {{ $omPerson->maternal_last_name }}
                                        {{ $omPerson->given_name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Estado Civil</label>
                                            <div class="form-control-static"
                                                style="border: 2px solid #18bc9c; border-radius: 8px; padding: 8px;">
                                                {{ $omPerson->marital_status }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Género</label>
                                            <div class="form-control-static"
                                                style="border: 2px solid #18bc9c; border-radius: 8px; padding: 8px;">
                                                {{ $omPerson->gender }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">DNI</label>
                                            <div class="form-control-static"
                                                style="border: 2px solid #18bc9c; border-radius: 8px; padding: 8px;">
                                                {{ $omPerson->dni }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Edad</label>
                                            <div class="form-control-static"
                                                style="border: 2px solid #18bc9c; border-radius: 8px; padding: 8px;">
                                                {{ $omPerson->age }} años
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Fecha de Nacimiento</label>
                                    <div class="form-control-static"
                                        style="border: 2px solid #18bc9c; border-radius: 8px; padding: 8px;">
                                        {{ \Carbon\Carbon::parse($omPerson->birth_date)->format('d/m/Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Datos de Contacto -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header" style="background: #3498db; color: white;">
                                <h5 class="mb-0"><i class="fas fa-address-book mr-2"></i>Contacto</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Teléfono</label>
                                            <div class="form-control-static"
                                                style="border: 2px solid #3498db; border-radius: 8px; padding: 8px;">
                                                {{ $omPerson->phone ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Correo Electrónico</label>
                                            <div class="form-control-static"
                                                style="border: 2px solid #3498db; border-radius: 8px; padding: 8px;">
                                                {{ $omPerson->email ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Vivienda -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header" style="background: #f39c12; color: white;">
                                <h5 class="mb-0"><i class="fas fa-home mr-2"></i>Vivienda</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="font-weight-bold">Ubicación Exacta</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-control-static flex-grow-1"
                                            style="border: 2px solid #f39c12; border-radius: 8px; padding: 8px;">
                                            {{ $omPerson->dwelling->exact_location ?? 'No asignada' }}
                                        </div>
                                        @if (!empty($omPerson->dwelling->exact_location))
                                            <a href="{{ route('om-dwellings.show', $omPerson->dwelling->id) }}"
                                                class="btn btn-sm btn-show ml-2">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div class="col-md-6">
                        <!-- Salud -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header" style="background: #F00E1C; color: white;">
                                <h5 class="mb-0"><i class="fas fa-heartbeat mr-2"></i>Salud</h5>
                            </div>
                            <div class="card-body">

                                <!-- Discapacidad -->
                                <div class="form-group">
                                    <label class="font-weight-bold">Certificado de Discapacidad</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-control-static flex-grow-1"
                                            style="border: 2px solid #F00E1C; border-radius: 8px; padding: 8px;">
                                            {{ $omPerson->disability->certificate_number ?? 'No registrada' }}
                                        </div>
                                        @if (!empty($omPerson->disability->certificate_number))
                                            <a href="{{ route('disabilities.show', $omPerson->disability->id) }}"
                                                class="btn btn-sm btn-show ml-2">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Cuidador</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-control-static flex-grow-1"
                                            style="border: 2px solid #F00E1C; border-radius: 8px; padding: 8px;">
                                            {{ $omPerson->caregiver->full_name ?? 'No asignado' }}
                                        </div>
                                        @if (!empty($omPerson->caregiver->full_name))
                                            <a href="{{ route('caregivers.show', $omPerson->caregiver->id) }}"
                                                class="btn btn-sm btn-show ml-2">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Seguro de Salud</label>
                                    <div class="form-control-static"
                                        style="border: 2px solid #F00E1C; border-radius: 8px; padding: 8px;">
                                        {{ $omPerson->health_insurance }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">SISFOH</label>
                                    <div class="form-control-static"
                                        style="border: 2px solid #F00E1C; border-radius: 8px; padding: 8px;">
                                        {{ $omPerson->sisfoh ? 'Sí' : 'No' }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Estado de Pensión</label>
                                    <div class="form-control-static"
                                        style="border: 2px solid #F00E1C; border-radius: 8px; padding: 8px;">
                                        {{ $omPerson->pension_status }}
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="font-weight-bold">Necesidad de Asistencia Personal</label>
                                    <div class="form-control-static"
                                        style="border: 2px solid #F00E1C; border-radius: 8px; padding: 8px;">
                                        {{ $omPerson->personal_assistance_need ?? 'N/A' }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Notas sobre </label>
                                    <div class="form-control-static"
                                        style="border: 2px solid #F00E1C; border-radius: 8px; padding: 8px;">
                                        {{ $omPerson->autonomy_notes ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Educación y Ocupación -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header" style="background: #9b59b6; color: white;">
                                <h5 class="mb-0"><i class="fas fa-briefcase mr-2"></i>Educación y Ocupación</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nivel Educativo</label>
                                            <div class="form-control-static"
                                                style="border: 2px solid #9b59b6; border-radius: 8px; padding: 8px;">
                                                {{ $omPerson->education_level }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Ocupación</label>
                                            <div class="form-control-static"
                                                style="border: 2px solid #9b59b6; border-radius: 8px; padding: 8px;">
                                                {{ $omPerson->occupation ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Estado Laboral</label>
                                    <div class="form-control-static"
                                        style="border: 2px solid #9b59b6; border-radius: 8px; padding: 8px;">
                                        {{ $omPerson->employment_status }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header" style="background: #95a5a6; color: white;">
                        <h5 class="mb-0"><i class="fas fa-edit mr-2"></i>Observaciones</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-control-static"
                            style="border: 2px solid #95a5a6; border-radius: 8px; padding: 8px; min-height: 100px;">
                            {{ $omPerson->observations ?? 'Sin observaciones' }}
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="text-right mt-4">
                    <a href="{{ route('om-people.index') }}" class="btn btn-lg btn-secondary shadow-sm"
                        style="border-radius: 8px;">
                        <i class="fas fa-arrow-left mr-2"></i>Volver al Listado
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .form-control-static {
            background: white;
            min-height: 40px;
            display: flex;
            align-items: center;
            padding: 0 12px;
        }
    </style>
@stop
