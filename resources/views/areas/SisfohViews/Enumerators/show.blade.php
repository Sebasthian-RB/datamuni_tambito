<!-- resources/views/sisfoh/enumerators/show.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detalles del Encuestador</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $enumerator->name }}</h5>
            <p class="card-text"><strong>Correo Electrónico:</strong> {{ $enumerator->email }}</p>
        </div>
    </div>
    
    <a href="{{ route('enumerators.edit', $enumerator) }}" class="mt-3 btn btn-warning">Editar</a>
    <a href="{{ route('enumerators.index') }}" class="mt-3 btn btn-secondary">Volver a la lista</a>
</div>
@endsection