@extends('adminlte::page')

@section('title', 'Diagnósticos Psicológicos')

@section('content_header')
    <h1>Listado de Diagnósticos Psicológicos</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('psychological-diagnoses.create') }}" class="btn btn-primary">Nuevo Diagnóstico</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Persona</th>
                    <th>Diagnóstico</th>
                    <th>Sesiones</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($diagnoses as $diagnostic)
                    <tr>
                        <td>{{ $diagnostic->id }}</td>
                        <td>{{ $diagnostic->person->given_name }} {{ $diagnostic->person->paternal_last_name }} {{ $diagnostic->person->maternal_last_name }}</td>
                        <td>{{ Str::limit($diagnostic->diagnosis, 40) }}</td>
                        <td>{{ $diagnostic->recommended_sessions }}</td>
                        <td>{{ \Carbon\Carbon::parse($diagnostic->diagnosis_date)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('psychological-diagnoses.show', $diagnostic) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('psychological-diagnoses.edit', $diagnostic) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('psychological-diagnoses.destroy', $diagnostic) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar diagnóstico?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No hay diagnósticos registrados aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
