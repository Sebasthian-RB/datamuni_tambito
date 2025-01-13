<!-- resources/views/instruments/create.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Crear Nuevo Instrumento</h1>
    <form action="{{ route('instruments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('instruments.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection