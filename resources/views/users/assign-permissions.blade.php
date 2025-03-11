@extends('adminlte::page')

@section('title', 'Asignar Permisos')

@section('content_header')
    <h1 class="m-0 text-dark"><i class="fas fa-user-shield"></i> Asignar Permisos a {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-gradient-primary">
            <h3 class="card-title"><i class="fas fa-key"></i> Permisos Disponibles</h3>
        </div>
        <form action="{{ route('users.assignPermissions', $user) }}" method="POST">
            @csrf
            <div class="card-body">
                @foreach ($permissions as $permission)
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" value="{{ $permission }}"
                               @if($user->hasPermissionTo($permission)) checked @endif>
                        <label>{{ ucfirst($permission) }}</label>
                    </div>
                @endforeach
            </div>
            <div class="card-footer bg-white">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
            </div>
        </form>
    </div>
@stop
