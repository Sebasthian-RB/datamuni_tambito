@extends('adminlte::page')

@section('title', 'Editar Permiso')

@section('content_header')
    <h1><i class="fas fa-key"></i> Editar Permiso</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('permissions.update', $permission) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombre del Permiso</label>
                <input type="text" name="name" class="form-control" value="{{ $permission->name }}" required>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cambios</button>
            <a href="{{ route('permissions.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
        </form>
    </div>
</div>
@stop
