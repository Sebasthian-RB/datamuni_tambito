<!-- resources/views/sisfoh/enumerators/show.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detalles del Encuestador</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Nombre Completo:</strong> {{ $enumerator->given_name }} {{ $enumerator->paternal_last_name }} {{ $enumerator->maternal_last_name }}</h5>
            
            <p class="card-text"><strong>Tipo de Documento:</strong> {{ $enumerator->identity_document }}</p>
            <p class="card-text"><strong>Número de Documento:</strong> {{ $enumerator->id }}</p>
            <p class="card-text"><strong>Número de Teléfono:</strong> {{ $enumerator->phone_number }}</p>
        </div>
    </div>
    
    <a href="{{ route('enumerators.edit', $enumerator) }}" class="mt-3 btn btn-warning">Editar</a>
    <a href="{{ route('enumerators.index') }}" class="mt-3 btn btn-secondary">Volver a la lista</a>
</div>
@endsection
