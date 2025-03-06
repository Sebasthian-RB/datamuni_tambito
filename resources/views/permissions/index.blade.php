@extends('adminlte::page')

@section('title', 'Gestión de Permisos')

@section('content_header')
    <h1><i class="fas fa-key"></i> Gestión de Permisos</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Permisos</h3>
        <div class="card-tools">
            <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Nuevo Permiso
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="bg-secondary">
                <tr>
                    <th>Nombre</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td class="text-center">
                        <a href="{{ route('permissions.show', $permission) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                        <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar permiso?')">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $permissions->links() }}
        </div>
    </div>
</div>
@stop
