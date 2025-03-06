@extends('adminlte::page')

@section('title', 'Gestión de Roles')

@section('content_header')
    <h1><i class="fas fa-user-shield"></i> Gestión de Roles</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Roles</h3>
        <div class="card-tools">
            <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Nuevo Rol
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="bg-secondary">
                <tr>
                    <th>Nombre</th>
                    <th>Permisos</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ implode(', ', $role->permissions->pluck('name')->toArray()) }}</td>
                    <td class="text-center">
                        <a href="{{ route('roles.show', $role) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar rol?')">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $roles->links() }}
        </div>
    </div>
</div>
@stop
