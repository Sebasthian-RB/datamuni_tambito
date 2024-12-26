@extends('adminlte::page')

@section('title', 'Listado de Intervenciones')

@section('content_header')
    <h1>Listado de Intervenciones</h1>
@stop

@section('content')
<div class="container">
    <!-- Botón de acción -->
    <a href="{{ route('interventions.create') }}" class="btn btn-info mb-3">
        <i class="fa fa-plus"></i> Crear Intervención
    </a>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla de datos -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Intervenciones Registradas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Cita</th>
                        <th>Derivación</th>
                        <th>Fecha de la Cita</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($interventions as $intervention)
                        <tr>
                            <td>{{ $intervention->id }}</td>
                            <td>{{ Str::limit($intervention->appointment, 50) }}</td>
                            <td>{{ $intervention->derivation ?? 'N/A' }}</td>
                            <td>{{ $intervention->appointment_date }}</td>
                            <td>
                                <a href="{{ route('interventions.show', $intervention->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('interventions.edit', $intervention->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('interventions.destroy', $intervention->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">
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
