@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Lista de Instrumentos/Visitas</h1>
    <a href="{{ route('instrument_visits.create') }}" class="mb-3 btn btn-primary">Crear Nuevo</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Instrumento</th>
                <th>Visita</th>
                <th>Fecha de Aplicación</th>
                <th>Descripciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($instrumentVisits as $visit)
                <tr>
                    <td>{{ $visit->id }}</td>
                    <td>{{ $visit->instrument->name ?? 'N/A' }}</td>
                    <td>{{ $visit->visit->name ?? 'N/A' }}</td>
                    <td>{{ $visit->application_date }}</td>
                    <td>{{ $visit->descriptions }}</td>
                    <td>
                        <a href="{{ route('instrument_visits.show', $visit) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('instrument_visits.edit', $visit) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('instrument_visits.destroy', $visit) }}" method="POST" style="display:inline-block;">
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
@endsection
