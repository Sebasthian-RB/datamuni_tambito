@extends('adminlte::page')

@section('title', 'Editar Programa Social')

@section('content_header')
<h1>Editar Programa Social</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('social_programs.update', $socialProgram) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre del Programa Social</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $socialProgram->name) }}">
                @error('name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('social_programs.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@stop