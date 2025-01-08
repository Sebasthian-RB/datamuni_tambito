@extends('adminlte::page')

@section('title', 'Crear Seguro Privado')

@section('content_header')
<h1>Crear Seguro Privado</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('private_insurances.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id">ID del Seguro</label>
                <input type="text" name="id" class="form-control" value="{{ old('id') }}" placeholder="Ingrese el ID" maxlength="12" required>
                @error('id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="private_insurances_name">Nombre del Seguro</label>
                <input type="text" name="private_insurances_name" class="form-control" value="{{ old('private_insurances_name') }}" placeholder="Ingrese el nombre del seguro" maxlength="255" required>
                @error('private_insurances_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('private_insurances.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop