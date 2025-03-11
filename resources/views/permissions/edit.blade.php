@extends('adminlte::page')

@section('title', 'Editar Permiso')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name"><i class="fas fa-lock"></i> Nombre del Permiso</label>
                    <input type="text" name="name" class="form-control" value="{{ $permission->name }}" required>
                </div>
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Actualizar Permiso
                </button>
            </form>
        </div>
    </div>
@stop
