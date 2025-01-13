<!-- resources/views/areas/SisfohViews/SfhDwellingSfhPeople/show.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Detalle de Persona</h1>

        <div class="card">
            <div class="card-header">
                Persona #{{ $sfhDwellingSfhPerson->id }}
            </div>
            <div class="card-body">
                <h5 class="card-title">Nombre: {{ $sfhDwellingSfhPerson->name }}</h5>
                <p class="card-text">Edad: {{ $sfhDwellingSfhPerson->age }}</p>
            </div>
        </div>

        <a href="{{ route('areas.SisfohViews.SfhDwellingSfhPerson.index') }}" class="mt-4 btn btn-primary">Volver</a>
    </div>
@endsection
