@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Visita</h1>
    <form action="{{ route('visits.update', $visit->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $visit->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="3" required>{{ $visit->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Fecha</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $visit->date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('visits.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
