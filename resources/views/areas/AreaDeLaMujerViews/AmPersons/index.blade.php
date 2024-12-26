<!-- resources/views/areas/AreaDeLaMujerViews/AmPersons/index.blade.php -->
@extends('adminlte::page')

@section('title', 'Listado de Personas')

@section('content_header')
    <h1>Listado de Personas</h1>
@stop

@section('content')
<div class="container">
    <!-- Botones de acción -->
    <a href="{{ route('am_people.create') }}" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Agregar Persona</a>
    <a href="{{ route('sectors.create') }}" class="btn btn-danger mb-3">Volver</a>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla de datos -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Personas Registradas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>N° Documento</th>
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
                                <a href="{{ route('am_people.show', $person->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</a>
                                <a href="{{ route('am_people.edit', $person->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                <form action="{{ route('am_people.destroy', $person->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar a esta persona?')">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </button>
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
