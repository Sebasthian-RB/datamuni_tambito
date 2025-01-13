<!-- resources/views/instruments/show.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detalles del Instrumento</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $instrument->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Descripción:</strong> {{ $instrument->description }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('instruments.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('instruments.edit', $instrument->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection