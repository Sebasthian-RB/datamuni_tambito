<!-- resources/views/areas/SisfohViews/SfhDwellingSfhPerson/show.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Detalles de la Persona en la Vivienda</h1>

        <div class="mb-3">
            <strong>ID de Persona:</strong> {{ $sfhDwellingSfhPerson->sfh_person_id }}
        </div>

        <div class="mb-3">
            <strong>Estado:</strong> {{ $sfhDwellingSfhPerson->status }}
        </div>

        <div class="mb-3">
            <strong>Fecha de Actualización:</strong> {{ $sfhDwellingSfhPerson->update_date }}
        </div>

        <div class="mb-3">
            <strong>ID de Vivienda:</strong> {{ $sfhDwellingSfhPerson->sfh_dwelling_id }}
        </div>

        <a href="{{ route('sfh_dwelling_sfh_people.index') }}" class="btn btn-secondary">Volver a la Lista</a>
    </div>
@endsection

