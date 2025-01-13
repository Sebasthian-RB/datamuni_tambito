<!-- resources/views/sisfoh/sfh_people/show.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Detalles de Persona</h1>

        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $sfhPerson->id }}</p>
                <p><strong>Nombre:</strong> {{ $sfhPerson->name }}</p>
                <p><strong>Correo:</strong> {{ $sfhPerson->email }}</p>
            </div>
        </div>

        <a href="{{ route('sfh_people.index') }}" class="mt-3 btn btn-primary">Volver a la Lista</a>
    </div>
@endsection
