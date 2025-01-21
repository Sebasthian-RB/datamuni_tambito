<!-- resources/views/areas/SisfohViews/SfhDwellings/index.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Lista de Viviendas</h1>
    <a href="{{ route('sfh_dwelling.create') }}" class="mb-3 btn btn-primary">Crear Nueva Vivienda</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Dirección</th>
                <th>Referencia</th>
                <th>Vecindario</th>
                <th>Distrito</th>
                <th>Provincia</th>
                <th>Región</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sfhDwellings as $dwelling)
            <tr>
                <td>{{ $dwelling->id }}</td>
                <td>{{ $dwelling->street_address }}</td>
                <td>{{ $dwelling->reference }}</td>
                <td>{{ $dwelling->neighborhood }}</td>
                <td>{{ $dwelling->district }}</td>
                <td>{{ $dwelling->provincia }}</td>
                <td>{{ $dwelling->region }}</td>
                <td>
                    <a href="{{ route('sfh_dwelling.show', $dwelling) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('sfh_dwelling.edit', $dwelling) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('sfh_dwelling.destroy', $dwelling) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta vivienda?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection