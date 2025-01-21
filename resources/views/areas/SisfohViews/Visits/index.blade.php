@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Listado de Visitas</h1>
        <a href="{{ route('visits.create') }}" class="mb-3 btn btn-primary">Crear nueva visita</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha de Visita</th>
                    <th>Estado</th>
                    <th>Enumerador</th>
                    <th>Solicitud</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visits as $visit)
                    <tr>
                        <td>{{ $visit->visit_date }}</td>
                        <td>{{ $visit->status }}</td>
                        <td>{{ $visit->observations }}</td>
                        <td>{{ $visit->enumerator->given_name }} {{ $visit->enumerator->paternal_last_name }}</td>
                        <td>{{ $visit->request->id }}</td>
                        <td>
                            <a href="{{ route('visits.show', $visit->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('visits.edit', $visit->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('visits.destroy', $visit->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
