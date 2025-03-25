@extends('adminlte::page')

@section('title', 'Editar Discapacidad')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #930813; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="card shadow-lg"
        style="border-radius: 15px; max-width: 800px; margin: 2rem auto; border-left: 5px solid #99050f;">

        <!-- Encabezado -->
        <div class="card-header text-center" style="background: #f00e1c; color: white; border-radius: 15px 15px 0 0;">
            <h3 class="card-title mb-0">Editar Discapacidad</h3>
        </div>

        <!-- Cuerpo -->
        <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%); padding: 2rem;">
            <form action="{{ route('disabilities.update', $disability) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="certificate_number"><strong>N° Certificado</strong></label>
                        <input type="text" name="certificate_number" id="certificate_number"
                            class="form-control @error('certificate_number') is-invalid @enderror"
                            value="{{ old('certificate_number', $disability->certificate_number) }}" required>
                        @error('certificate_number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="certificate_issue_date"><strong>Fecha de Emisión</strong></label>
                        <input type="date" name="certificate_issue_date" id="certificate_issue_date"
                            class="form-control @error('certificate_issue_date') is-invalid @enderror"
                            value="{{ old('certificate_issue_date', $disability->certificate_issue_date->format('Y-m-d')) }}"
                            required>
                        @error('certificate_issue_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="certificate_expiry_date"><strong>Fecha de Caducidad</strong></label>
                        <input type="date" name="certificate_expiry_date" id="certificate_expiry_date"
                            class="form-control @error('certificate_expiry_date') is-invalid @enderror"
                            value="{{ old('certificate_expiry_date', $disability->certificate_expiry_date->format('Y-m-d')) }}">
                        @error('certificate_expiry_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="organization_name"><strong>Organización</strong></label>
                        <input type="text" name="organization_name" id="organization_name"
                            class="form-control @error('organization_name') is-invalid @enderror"
                            value="{{ old('organization_name', $disability->organization_name) }}" required>
                        @error('organization_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="diagnosis"><strong>Diagnóstico</strong></label>
                        <input type="text" name="diagnosis" id="diagnosis"
                            class="form-control @error('diagnosis') is-invalid @enderror"
                            value="{{ old('diagnosis', $disability->diagnosis) }}" required>
                        @error('diagnosis')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="disability_type"><strong>Tipo de Discapacidad</strong></label>
                        <input type="text" name="disability_type" id="disability_type"
                            class="form-control @error('disability_type') is-invalid @enderror"
                            value="{{ old('disability_type', $disability->disability_type) }}" required>
                        @error('disability_type')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="severity_level"><strong>Nivel de Gravedad</strong></label>
                        <select name="severity_level" id="severity_level"
                            class="form-control @error('severity_level') is-invalid @enderror">
                            <option value="Leve"
                                {{ old('severity_level', $disability->severity_level) == 'Leve' ? 'selected' : '' }}>Leve
                            </option>
                            <option value="Moderado"
                                {{ old('severity_level', $disability->severity_level) == 'Moderado' ? 'selected' : '' }}>
                                Moderado</option>
                            <option value="Severo"
                                {{ old('severity_level', $disability->severity_level) == 'Severo' ? 'selected' : '' }}>
                                Severo</option>
                        </select>
                        @error('severity_level')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="required_support_devices"><strong>Dispositivos Necesarios</strong></label>
                        <textarea name="required_support_devices" id="required_support_devices"
                            class="form-control @error('required_support_devices') is-invalid @enderror">{{ old('required_support_devices', $disability->required_support_devices) }}</textarea>
                        @error('required_support_devices')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="used_support_devices"><strong>Dispositivos Usados</strong></label>
                        <textarea name="used_support_devices" id="used_support_devices"
                            class="form-control @error('used_support_devices') is-invalid @enderror">{{ old('used_support_devices', $disability->used_support_devices) }}</textarea>
                        @error('used_support_devices')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="text-center mt-4">
                    <a href="javascript:history.back()" class="btn btn-custom">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-custom">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <style>
        .btn-custom {
            background-color: #930813;
            border: 1px solid #930813;
            color: white;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .btn-custom:hover {
            background-color: #50030a;
            color: #fff;
        }

        .card {
            transition: transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
@stop
