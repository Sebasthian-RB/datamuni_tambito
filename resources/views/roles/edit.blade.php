@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name"><i class="fas fa-user-shield"></i> Nombre del Rol</label>
                    <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
                </div>
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Actualizar Rol
                </button>
            </form>
        </div>
    </div>
@stop
