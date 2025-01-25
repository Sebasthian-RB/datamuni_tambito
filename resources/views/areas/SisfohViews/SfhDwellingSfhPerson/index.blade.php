<!-- resources/views/areas/SisfohViews/SfhDwellingSfhPerson/index.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Lista de Personas en la Vivienda</h1>
        <a href="{{ route('sfh_dwelling_sfh_people.create') }}" class="mb-3 btn btn-primary">Añadir Persona</a>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Persona ID</th>
                    <th>Estado</th>
                    <th>Fecha de Actualización</th>
                    <th>Vivienda ID</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sfhPersons as $person)
                    <tr>
                        <td>{{ $person->id }}</td>
                        <td>{{ $person->sfh_person_id }}</td>
                        <td>{{ $person->status }}</td>
                        <td>{{ $person->update_date }}</td>
                        <td>{{ $person->sfh_dwelling_id }}</td>
                        <td>
                            <a href="{{ route('sfh_dwelling_sfh_people.show', $person->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('sfh_dwelling_sfh_people.edit', $person->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('sfh_dwelling_sfh_people.destroy', $person->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta persona?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
