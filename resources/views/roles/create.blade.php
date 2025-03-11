@extends('adminlte::page')

@section('title', 'Crear Rol')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name"><i class="fas fa-user-shield"></i> Nombre del Rol</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar Rol
                </button>
            </form>
        </div>
    </div>
@stop
