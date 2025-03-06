@extends('adminlte::page')

@section('title', 'Crear Rol')

@section('content_header')
    <h1><i class="fas fa-user-shield"></i> Crear Rol</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nombre del Rol</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Permisos</label>
                <select name="permissions[]" class="form-control select2" multiple>
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
        </form>
    </div>
</div>
@stop
