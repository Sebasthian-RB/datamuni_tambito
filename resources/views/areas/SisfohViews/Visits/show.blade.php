@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Detalles de la Visita</h1>
        <a href="{{ route('visits.index') }}" class="mb-3 btn btn-secondary">Volver al listado</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong>Fecha de Visita:</strong> {{ $visit->formatted_visit_date }}</h5>
                <p class="card-text"><strong>Estado:</strong> {{ $visit->status }}</p>
                <p class="card-text">
                    <strong>Enumerador:</strong> 
                    {{ $visit->enumerator->given_name }} {{ $visit->enumerator->paternal_last_name }} {{ $visit->enumerator->maternal_last_name }}
                </p>
                <p class="card-text"><strong>Solicitud:</strong> {{ $visit->request->id }}</p>
                <p class="card-text"><strong>Observaciones:</strong> {{ $visit->observations }}</p>
            </div>
        </div>
    </div>
@endsection
