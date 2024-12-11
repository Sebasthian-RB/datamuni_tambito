<!-- resources/views/areas/AreaDeLaMujerViews/AmPersons/index.blade.php -->
@extends('adminlte::page')

@section('title', 'Listado de Personas')

@section('content_header')
    <h1>Listado de Personas</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('amPerson.create') }}" class="btn btn-primary mb-3">Agregar Persona</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Personas Registradas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Documento de Identidad</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($people as $person)
                        <tr>
                            <td>{{ $person->id }}</td>
                            <td>{{ $person->identity_document }}</td>
                            <td>{{ $person->given_name }} {{ $person->paternal_last_name }} {{ $person->maternal_last_name }}</td>
                            <td>
                                <a href="{{ route('amPerson.show', $person->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('amPerson.edit', $person->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('amPerson.destroy', $person->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
