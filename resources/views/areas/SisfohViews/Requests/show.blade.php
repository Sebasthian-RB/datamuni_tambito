@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detalles de la Solicitud</h1>

    {{-- Detalles de la solicitud --}}
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $sfhRequest->id }}</p>
            <p><strong>Fecha de Solicitud:</strong> {{ $sfhRequest->formatted_request_date }}</p>
            <p><strong>Descripción:</strong> {{ $sfhRequest->description }}</p>
            <p><strong>Persona Relacionada:</strong> {{ $sfhRequest->sfhPerson->given_name ?? 'N/A' }} {{ $sfhRequest->sfhPerson->paternal_last_name ?? '' }} {{ $sfhRequest->sfhPerson->maternal_last_name ?? '' }}</p>
        </div>
    </div>

    {{-- Botones de acción --}}
    <a href="{{ route('sfh_requests.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('sfh_requests.edit', $sfhRequest->id) }}" class="btn btn-warning">Editar</a>
</div>
@endsection
