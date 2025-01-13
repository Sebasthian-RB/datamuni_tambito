<!-- resources/views/areas/SisfohViews/InstrumentVisit/index.blade.php -->
@extends('adminlte::page')

@section('content')
    <h1>Instrument Visits</h1>

    <a href="{{ route('instrument_visits.create') }}" class="btn btn-primary">Crear Nueva Visita</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Instrumento</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instrumentVisits as $instrumentVisit)
                <tr>
                    <td>{{ $instrumentVisit->id }}</td>
                    <td>{{ $instrumentVisit->instrument_name }}</td>
                    <td>{{ $instrumentVisit->visit_date }}</td>
                    <td>
                        <a href="{{ route('instrument_visits.show', $instrumentVisit->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('instrument_visits.edit', $instrumentVisit->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('instrument_visits.destroy', $instrumentVisit->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
