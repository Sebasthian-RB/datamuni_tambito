<!-- resources/views/instruments/index.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Lista de Instrumentos</h1>
    <a href="{{ route('instruments.create') }}" class="mb-3 btn btn-primary">Crear Nuevo Instrumento</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($instruments as $instrument)
                <tr>
                    <td>{{ $instrument->id }}</td>
                    <td>{{ $instrument->name }}</td>
                    <td>{{ $instrument->description }}</td>
                    <td>
                        <a href="{{ route('instruments.show', $instrument->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('instruments.edit', $instrument->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('instruments.destroy', $instrument->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay instrumentos disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection