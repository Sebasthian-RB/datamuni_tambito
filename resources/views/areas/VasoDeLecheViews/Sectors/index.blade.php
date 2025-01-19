@extends('adminlte::page')

@section('title', 'Sectores')

@section('content_header')
    <h1>Lista de Sectores</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('sectors.create') }}" class="btn mb-3" style="background-color: #9B7EBD; color: white;">Agregar Sector</a>
    <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-secondary mb-3">Volver</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($sectors->isEmpty())
        <div class="alert alert-secondary">
            No hay sectores disponibles para mostrar.
        </div>
    @else
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sectores Registrados</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Responsable</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sectors as $sector)
                            <tr>
                                <td>{{ $sector->id }}</td>
                                <td>{{ $sector->name }}</td>
                                <td>{{ $sector->responsible_person }}</td>
                                <td>
                                    <a href="{{ route('sectors.show', $sector->id) }}" class="btn btn-sm" style="background-color: #9B7EBD; color: white;">Ver</a>
                                    <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-sm" style="background-color: #D4BEE4; color: white;">Editar</a>
                                    <form action="{{ route('sectors.destroy', $sector->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este sector?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
</div>
@stop
