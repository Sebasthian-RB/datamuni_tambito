@extends('adminlte::page')

@section('title', 'Agregar Producto')

@section('content_header')
    <h1>Agregar Producto</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulario para agregar producto</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Guardar Producto</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop
