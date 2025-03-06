@extends('adminlte::page')

@section('title', 'Asignar Rol')

@section('content_header')
    <h1><i class="fas fa-user-tag"></i> Asignar Rol a {{ $user->name }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('users.assignRole', $user) }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Selecciona un Rol</label>
                <select name="role" class="form-control select2">
                    @foreach ($roles as $id => $name)
                        <option value="{{ $name }}" {{ $user->hasRole($name) ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Asignar Rol</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
        </form>
    </div>
</div>
@stop
