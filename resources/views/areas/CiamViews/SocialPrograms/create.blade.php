@extends('adminlte::page')

@section('title', 'Crear Programa Social')

@section('content_header')
<h1>Crear Programa Social</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('social_programs.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre del Programa Social</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Ingrese el nombre del programa social" value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('social_programs.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@stop