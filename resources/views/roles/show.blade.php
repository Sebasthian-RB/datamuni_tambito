@extends('adminlte::page')

@section('title', 'Detalle del Rol')

@section('content_header')
    <h1><i class="fas fa-user-tag"></i> Detalles del Rol</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <p><strong>Nombre del Rol:</strong> {{ $role->name }}</p>
        <p><strong>Permisos:</strong> {{ implode(', ', $role->permissions->pluck('name')->toArray()) }}</p>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
</div>
@stop
