@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Detalles del Instrumento</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nombre: {{ $instrument->name_instruments }}</h5>
                <p><strong>Tipo:</strong> {{ $instrument->type_instruments }}</p>
                <p><strong>Descripción:</strong> {{ $instrument->description }}</p>

                <a href="{{ route('instruments.index') }}" class="btn btn-primary">Volver a la lista</a>
            </div>
        </div>
    </div>
@endsection
