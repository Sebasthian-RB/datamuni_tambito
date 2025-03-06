@extends('adminlte::page')

@section('title', 'Detalles del Usuario')

@section('content_header')
    <h1 class="m-0 text-dark"><i class="fas fa-user-circle"></i> Detalles del Usuario</h1>
@stop

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-gradient-primary">
        <h3 class="card-title">
            <i class="fas fa-id-card"></i> Información del Usuario
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <div class="user-badge mx-auto">
                    <span class="user-initial">{{ substr($user->name, 0, 1) }}</span>
                </div>
                <h3 class="mt-3">{{ $user->name }}</h3>
                <p class="text-muted">Registrado: {{ $user->created_at->format('d/m/Y H:i') }}</p>
            </div>
            
            <div class="col-md-8">
                <table class="table table-hover details-table">
                    <tbody>
                        <tr>
                            <td class="font-weight-bold" style="width: 30%">
                                <i class="fas fa-user-tag text-primary"></i> Nombre Completo
                            </td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                <i class="fas fa-envelope text-primary"></i> Correo Electrónico
                            </td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                <i class="fas fa-calendar-alt text-primary"></i> Fecha de Registro
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                <i class="fas fa-user-shield text-primary"></i> Rol Asignado
                            </td>
                            <td>
                                @if($user->roles->isNotEmpty())
                                    <span class="badge badge-success">{{ $user->roles->pluck('name')->join(', ') }}</span>
                                @else
                                    <span class="badge badge-secondary">Sin Rol</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer bg-white">
        <a href="{{ route('users.index') }}" class="btn btn-lg btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver al Listado
        </a>
        <a href="{{ route('users.edit', $user) }}" class="btn btn-lg btn-warning float-right">
            <i class="fas fa-edit"></i> Editar Usuario
        </a>
    </div>
</div>

@push('css')
<style>
    .user-badge {
        width: 120px;
        height: 120px;
        background-color: #f0f0f0;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        font-weight: bold;
        color: #333;
        box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .user-badge:hover {
        transform: scale(1.05);
    }

    .details-table td {
        vertical-align: middle;
        padding: 1.25rem;
        border-color: #f8f9fa;
    }

    .details-table tr:hover {
        background-color: #f8f9fa;
    }

    .details-table i {
        width: 25px;
        margin-right: 10px;
    }
</style>
@endpush

@stop