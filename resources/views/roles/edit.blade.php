@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content_header')
    <h1><i class="fas fa-user-shield"></i> Editar Rol</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombre del Rol</label>
                <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
            </div>

            <div class="form-group">
                <label>Permisos</label>
                <select name="permissions[]" class="form-control select2" multiple>
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}" 
                            {{ $role->permissions->contains($permission) ? 'selected' : '' }}>
                            {{ $permission->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cambios</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
        </form>
    </div>
</div>
@stop
