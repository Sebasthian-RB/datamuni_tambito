<!-- resources/views/sisfoh/requests/show.blade.php -->

@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Detalles de la Solicitud #{{ $sfhRequest->id }}</h1>
        <ul>
            <li><strong>Nombre:</strong> {{ $sfhRequest->name }}</li>
            <li><strong>Descripción:</strong> {{ $sfhRequest->description }}</li>
            <li><strong>Fecha de Creación:</strong> {{ $sfhRequest->created_at->format('d-m-Y') }}</li>
        </ul>
        <a href="{{ route('sfh_requests.index') }}" class="btn btn-primary">Volver al listado</a>
    </div>
@endsection
