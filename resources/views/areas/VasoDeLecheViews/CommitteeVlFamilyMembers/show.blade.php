@extends('adminlte::page')

@section('title', 'Detalle del Miembro de Familia del Comité')

@section('content_header')
    <h1>Detalle del Miembro de Familia del Comité</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success p-0 d-flex justify-content-center align-items-center" style="height: 60px;">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="height: 80%; width: auto;">
        </div>
        <div class="card-body">
            <p><strong>Comité:</strong> {{ $committeeVlFamilyMember->committee->name }}</p>
            <p><strong>Miembro de Familia:</strong> {{ $committeeVlFamilyMember->vlFamilyMember->name }}</p>
            <p><strong>Fecha de Cambio:</strong> {{ $committeeVlFamilyMember->change_date }}</p>
            <p><strong>Descripción:</strong> {{ $committeeVlFamilyMember->description }}</p>
            <p><strong>Estado:</strong> {{ $committeeVlFamilyMember->status ? 'Activo' : 'Inactivo' }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('committee_vl_family_members.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@stop
