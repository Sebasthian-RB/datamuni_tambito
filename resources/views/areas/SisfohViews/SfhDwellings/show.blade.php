<!-- resources/views/areas/SisfohViews/SfhDwelling/show.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Detalles de Vivienda</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">ID: {{ $sfhDwelling->id }}</h5>
                <p><strong>Dirección:</strong> {{ $sfhDwelling->address }}</p>
                <p><strong>Tipo:</strong> {{ $sfhDwelling->type }}</p>
            </div>
        </div>

        <a href="{{ route('sfh_dwelling.index') }}" class="mt-3 btn btn-primary">Volver al listado</a>
    </div>
@endsection
