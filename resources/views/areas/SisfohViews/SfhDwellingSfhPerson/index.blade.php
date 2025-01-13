<!-- resources/views/areas/SisfohViews/SfhDwellingSfhPeople/index.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Lista de Personas en Vivienda</h1>
        <a href="{{ route('sfh_dwelling_sfh_people.create') }}" class="btn btn-primary">Agregar Persona</a>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sfhPersons as $person)
                    <tr>
                        <td>{{ $person->id }}</td>
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->age }}</td>
                        <td>
                            <a href="{{ route('sfh_dwelling_sfh_people.show', $person->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('sfh_dwelling_sfh_people.edit', $person->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('sfh_dwelling_sfh_people.destroy', $person->id) }}" method="POST" class="d-inline">
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
