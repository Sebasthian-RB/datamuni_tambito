@extends('adminlte::page')

@section('title', 'Crear Tipo de Violencia')

@section('content_header')
    <h1>Crear Tipo de Violencia</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title">Nueva Violencia</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('violences.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kind_violence">Tipo de Violencia</label>
                <input type="text" name="kind_violence" id="kind_violence" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('violences.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
