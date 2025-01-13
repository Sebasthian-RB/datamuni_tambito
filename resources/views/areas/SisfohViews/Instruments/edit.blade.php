<!-- resources/views/instruments/edit.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Instrumento</h1>
    <form action="{{ route('instruments.update', $instrument->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $instrument->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $instrument->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('instruments.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection