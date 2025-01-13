@extends('adminlte::page')

@section('title', 'Editar Adulto Mayor')

@section('content_header')
    <h1>Editar Adulto Mayor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('elderly_adults.index') }}" class="btn btn-secondary">Volver</a>
        </div>
        <div class="card-body">
            <form action="{{ route('elderly_adults.update', $elderlyAdult->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Same form structure as create.blade.php -->
                <!-- Form fields here, pre-filled with $elderlyAdult->field_name -->
                <button type="submit" class="btn btn-primary">Actualizar Adulto Mayor</button>
            </form>
        </div>
    </div>
@stop
