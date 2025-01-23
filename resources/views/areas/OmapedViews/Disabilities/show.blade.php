@extends('adminlte::page')

@section('title', 'Detalles de Discapacidad')

@section('content_header')
    <h1>Detalles de la Discapacidad</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label><strong>N° Certificado:</strong></label>
                <p>{{ $disability->certificate_number }}</p>
            </div>
            <div class="form-group">
                <label><strong>Fecha de Emisión:</strong></label>
                <p>{{ $disability->certificate_issue_date->format('d/m/Y') }}</p>
            </div>
            <div class="form-group">
                <label><strong>Fecha de Caducidad:</strong></label>
                <p>
                    {{ $disability->certificate_expiry_date 
                        ? $disability->certificate_expiry_date->format('d/m/Y') 
                        : 'No especificada' }}
                </p>
            </div>
            <div class="form-group">
                <label><strong>Organización:</strong></label>
                <p>{{ $disability->organization_name }}</p>
            </div>
            <div class="form-group">
                <label><strong>Diagnóstico:</strong></label>
                <p>{{ $disability->diagnosis }}</p>
            </div>
            <div class="form-group">
                <label><strong>Tipo de Discapacidad:</strong></label>
                <p>{{ $disability->disability_type }}</p>
            </div>
            <div class="form-group">
                <label><strong>Nivel de Gravedad:</strong></label>
                <p>{{ $disability->severity_level }}</p>
            </div>
            <div class="form-group">
                <label><strong>Dispositivos Necesarios:</strong></label>
                <p>
                    {{ $disability->required_support_devices 
                        ? $disability->required_support_devices 
                        : 'No se especificaron dispositivos necesarios.' }}
                </p>
            </div>
            <div class="form-group">
                <label><strong>Dispositivos Usados:</strong></label>
                <p>
                    {{ $disability->used_support_devices 
                        ? $disability->used_support_devices 
                        : 'No se especificaron dispositivos usados.' }}
                </p>
            </div>
            <a href="{{ route('disabilities.index') }}" class="btn btn-secondary">Volver al Listado</a>
        </div>
    </div>
@stop
