@extends('adminlte::page')

@section('title', 'Editar Tipo de Violencia')

@section('content_header')
    <h1>Editar Tipo de Violencia</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-warning">
        <h3 class="card-title">Editar Violencia</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('violences.update', $violence->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kind_violence">Tipo de Violencia</label>
                <input type="text" name="kind_violence" id="kind_violence" value="{{ $violence->kind_violence }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $violence->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
        </form>
    </div>
</div>
@endsection
