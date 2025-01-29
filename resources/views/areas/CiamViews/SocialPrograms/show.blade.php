@extends('adminlte::page')

@section('title', 'Detalles del Programa Social')

@section('content_header')
<h1>Detalles del Programa Social</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <h4><strong>ID:</strong> {{ $socialProgram->id }}</h4>
        <h4><strong>Nombre:</strong> {{ $socialProgram->name }}</h4>
    </div>
    <div class="card-footer">
        <a href="{{ route('social_programs.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@stop