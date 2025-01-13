@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Listado de Visitas</h1>
    <a href="{{ route('visits.create') }}" class="mb-3 btn btn-primary">Crear Nueva Visita</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($visits as $visit)
                <tr>
                    <td>{{ $visit->id }}</td>
                    <td>{{ $visit->name }}</td>
                    <td>{{ $visit->description }}</td>
                    <td>{{ $visit->date }}</td>
                    <td>
                        <a href="{{ route('visits.show', $visit->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('visits.edit', $visit->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('visits.destroy', $visit->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta visita?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay visitas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
