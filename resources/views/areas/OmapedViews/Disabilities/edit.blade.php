@extends('adminlte::page')

@section('title', 'Editar Discapacidad')

@section('content_header')
    <h1>Editar Discapacidad</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('disabilities.update', $disability) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Similar al formulario de creación, pero con los valores del modelo -->
                <div class="form-group">
                    <label>N° Certificado</label>
                    <input type="text" name="certificate_number" class="form-control" value="{{ old('certificate_number', $disability->certificate_number) }}" required>
                </div>
                <div class="form-group">
                    <label>Fecha de Emisión</label>
                    <input type="date" name="certificate_issue_date" class="form-control" value="{{ old('certificate_issue_date', $disability->certificate_issue_date) }}" required>
                </div>
                <div class="form-group">
                    <label>Fecha de Caducidad</label>
                    <input type="date" name="certificate_expiry_date" class="form-control" value="{{ old('certificate_expiry_date', $disability->certificate_expiry_date) }}">
                </div>
                <div class="form-group">
                    <label>Organización</label>
                    <input type="text" name="organization_name" class="form-control" value="{{ old('organization_name', $disability->organization_name) }}" required>
                </div>
                <div class="form-group">
                    <label>Diagnóstico</label>
                    <input type="text" name="diagnosis" class="form-control" value="{{ old('diagnosis', $disability->diagnosis) }}" required>
                </div>
                <div class="form-group">
                    <label>Tipo de Discapacidad</label>
                    <input type="text" name="disability_type" class="form-control" value="{{ old('disability_type', $disability->disability_type) }}" required>
                </div>
                <div class="form-group">
                    <label>Nivel de Gravedad</label>
                    <select name="severity_level" class="form-control">
                        <option value="Leve" {{ $disability->severity_level == 'Leve' ? 'selected' : '' }}>Leve</option>
                        <option value="Moderado" {{ $disability->severity_level == 'Moderado' ? 'selected' : '' }}>Moderado</option>
                        <option value="Severo" {{ $disability->severity_level == 'Severo' ? 'selected' : '' }}>Severo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Dispositivos Necesarios</label>
                    <textarea name="required_support_devices" class="form-control">{{ old('required_support_devices', $disability->required_support_devices) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Dispositivos Usados</label>
                    <textarea name="used_support_devices" class="form-control">{{ old('used_support_devices', $disability->used_support_devices) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
@stop
