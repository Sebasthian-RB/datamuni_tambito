@extends('adminlte::page')

@section('title', 'Gestión de Permisos')

@section('content_header')
    <h1 class="m-0 text-dark"><i class="fas fa-lock"></i> Gestión de Permisos</h1>
@stop

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-gradient-primary">
            <h3 class="card-title">
                <i class="fas fa-key"></i> Listado de Permisos
            </h3>
            <div class="card-tools">
                <a href="{{ route('permissions.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus"></i> Nuevo Permiso
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="bg-secondary">
                        <tr>
                            <th>Nombre del Permiso</th>
                            <th>Roles Asociados</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->roles->pluck('name')->join(', ') }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle"
                                            data-toggle="dropdown">
                                            Acciones
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('permissions.show', $permission) }}">
                                                <i class="fas fa-eye text-info"></i> Ver Detalles
                                            </a>
                                            <a class="dropdown-item" href="{{ route('permissions.edit', $permission) }}">
                                                <i class="fas fa-edit text-warning"></i> Editar
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('¿Confirmar eliminación?')">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
@stop
