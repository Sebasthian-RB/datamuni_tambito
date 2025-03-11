@extends('adminlte::page')

@section('title', 'Crear Permiso')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name"><i class="fas fa-lock"></i> Nombre del Permiso</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar Permiso
                </button>
            </form>
        </div>
    </div>
@stop
