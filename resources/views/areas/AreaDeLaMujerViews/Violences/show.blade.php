@extends('adminlte::page')

@section('title', 'Detalles de Violencia')

@section('content_header')
    <h1>Detalles de Violencia</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-info">
        <h3 class="card-title">Detalles</h3>
        <div class="card-tools">
            <a href="{{ route('violences.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $violence->id }}</p>
        <p><strong>Tipo de Violencia:</strong> {{ $violence->kind_violence }}</p>
        <p><strong>Descripción:</strong> {{ $violence->description }}</p>
    </div>
</div>
@endsection
