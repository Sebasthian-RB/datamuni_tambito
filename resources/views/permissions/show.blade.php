@extends('adminlte::page')

@section('title', 'Detalle del Permiso')

@section('content_header')
    <h1><i class="fas fa-key"></i> Detalles del Permiso</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <p><strong>Nombre del Permiso:</strong> {{ $permission->name }}</p>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
</div>
@stop
