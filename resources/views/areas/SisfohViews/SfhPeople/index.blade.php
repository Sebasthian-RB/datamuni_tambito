<!-- resources/views/sisfoh/sfh_people/index.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Lista de Personas</h1>
        <a href="{{ route('sfh_people.create') }}" class="mb-3 btn btn-primary">Crear Nueva Persona</a>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($people as $person)
                    <tr>
                        <td>{{ $person->id }}</td>
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->email }}</td>
                        <td>
                            <a href="{{ route('sfh_people.show', $person) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('sfh_people.edit', $person) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('sfh_people.destroy', $person) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
