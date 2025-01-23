@extends('adminlte::page')

@section('title', 'Listado de Personas')

@section('content_header')
    <h1>Listado de Personas</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('om-people.create') }}" class="btn btn-success mb-3">Registrar Nueva Persona</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>Estado Civil</th>
                <th>DNI</th>
                <th>Edad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($people as $person)
                <tr>
                    <td>{{ $person->paternal_last_name }} {{ $person->maternal_last_name }} {{ $person->given_name }}</td>
                    <td>{{ $person->marital_status }}</td>
                    <td>{{ $person->dni }}</td>
                    <td>{{ $person->age }}</td>
                    <td>
                        <a href="{{ route('om-people.show', $person->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('om-people.edit', $person->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('om-people.destroy', $person->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
