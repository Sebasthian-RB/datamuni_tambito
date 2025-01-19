@extends('adminlte::page')

@section('title', 'Detalle del Miembro de Familia')

@section('content_header')
    <h1>Detalle del Miembro de Familia</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header p-0 d-flex justify-content-center align-items-center" style="background-color: #3B1E54; height: 60px;">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="height: 80%; width: auto;">
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $vlFamilyMember->id }}</p>
            <p><strong>Tipo de Documento:</strong> {{ $vlFamilyMember->identity_document }}</p>
            <p><strong>Nombres:</strong> {{ $vlFamilyMember->given_name }}</p>
            <p><strong>Apellido Paterno:</strong> {{ $vlFamilyMember->paternal_last_name }}</p>
            <p><strong>Apellido Materno:</strong> {{ $vlFamilyMember->maternal_last_name }}</p>

        </div>
        <div class="card-footer">
            <a href="{{ route('vl_family_members.edit', $vlFamilyMember->id) }}" class="btn btn-secondary" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">Editar</a>
            <a href="{{ route('vl_family_members.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@stop
