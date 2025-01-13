@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detalles de la Visita</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nombre: {{ $visit->name }}</h5>
            <p class="card-text">Descripción: {{ $visit->description }}</p>
            <p class="card-text">Fecha: {{ $visit->date }}</p>
            <a href="{{ route('visits.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('visits.edit', $visit->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection
