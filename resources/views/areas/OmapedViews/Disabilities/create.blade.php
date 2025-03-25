@extends('adminlte::page')

@section('title', 'Nueva Discapacidad')

@section('content_header')
    <h1>Registrar Discapacidad</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('disabilities.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>N° Certificado</label>
                    <input type="text" name="certificate_number" class="form-control" value="{{ old('certificate_number') }}"
                        required>
                </div>
                <div class="form-group">
                    <label>Fecha de Emisión</label>
                    <input type="date" name="certificate_issue_date" class="form-control"
                        value="{{ old('certificate_issue_date') }}" required>
                </div>
                <div class="form-group">
                    <label>Fecha de Caducidad</label>
                    <input type="date" name="certificate_expiry_date" class="form-control"
                        value="{{ old('certificate_expiry_date') }}">
                </div>
                <div class="form-group">
                    <label>Organización</label>
                    <input type="text" name="organization_name" class="form-control"
                        value="{{ old('organization_name') }}" required>
                </div>
                <div class="form-group">
                    <label>Diagnóstico</label>
                    <input type="text" name="diagnosis" class="form-control" value="{{ old('diagnosis') }}" required>
                </div>
                <div class="form-group">
                    <label>Tipo de Discapacidad</label>
                    <input type="text" name="disability_type" class="form-control" value="{{ old('disability_type') }}"
                        required>
                </div>
                <div class="form-group">
                    <label>Nivel de Gravedad</label>
                    <select name="severity_level" class="form-control">
                        <option value="Leve">Leve</option>
                        <option value="Moderado">Moderado</option>
                        <option value="Severo">Severo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Dispositivos Necesarios</label>
                    <textarea name="required_support_devices" class="form-control">{{ old('required_support_devices') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Dispositivos Usados</label>
                    <textarea name="used_support_devices" class="form-control">{{ old('used_support_devices') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
@stop
