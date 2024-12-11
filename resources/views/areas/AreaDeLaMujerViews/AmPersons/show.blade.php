<!-- resources/views/areas/AreaDeLaMujerViews/AmPersons/show.blade.php -->
@extends('adminlte::page')

@section('title', 'Detalle de Persona')

@section('content_header')
    <h1>Detalle de Persona</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalles de {{ $amPerson->given_name }} {{ $amPerson->paternal_last_name }} {{ $amPerson->maternal_last_name }}</h3>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">ID</dt>
                <dd class="col-sm-8">{{ $amPerson->id }}</dd>

                <dt class="col-sm-4">Documento de Identidad</dt>
                <dd class="col-sm-8">{{ $amPerson->identity_document }}</dd>

                <dt class="col-sm-4">Nombre</dt>
                <dd class="col-sm-8">{{ $amPerson->given_name }} {{ $amPerson->paternal_last_name }} {{ $amPerson->maternal_last_name }}</dd>

                <dt class="col-sm-4">Dirección</dt>
                <dd class="col-sm-8">{{ $amPerson->address ?? 'No disponible' }}</dd>

                <dt class="col-sm-4">Sexo</dt>
                <dd class="col-sm-8">{{ $amPerson->sex_type ? 'Masculino' : 'Femenino' }}</dd>

                <dt class="col-sm-4">Número de Teléfono</dt>
                <dd class="col-sm-8">{{ $amPerson->phone_number ?? 'No disponible' }}</dd>

                <dt class="col-sm-4">Fecha de Asistencia</dt>
                <dd class="col-sm-8">{{ $amPerson->attendance_date->format('d/m/Y H:i') }}</dd>

                <dt class="col-sm-4">Fecha de Creación</dt>
                <dd class="col-sm-8">{{ $amPerson->created_at->format('d/m/Y H:i') }}</dd>

                <dt class="col-sm-4">Fecha de Actualización</dt>
                <dd class="col-sm-8">{{ $amPerson->updated_at->format('d/m/Y H:i') }}</dd>
            </dl>
        </div>
        <div class="card-footer">
            <a href="{{ route('amPerson.edit', $amPerson->id) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('amPerson.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</div>
@stop
