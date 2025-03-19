@extends('adminlte::page')

@section('title', 'Lista de Asistencias')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #c06c84; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
    <br>
    <h1 class="text-white" style="background: #355c7d; padding: 10px; border-radius: 8px; text-align: center;">
        Lista de Asistencias
    </h1>
@stop

@section('content')
<div class="container">
    <!-- Botones de acción -->
    <div class="mb-3 d-flex justify-content-between">
        @can('crear')
        <a href="{{ route('am_person_events.create') }}" class="btn text-white shadow-sm"
            style="background: #f67280; border-radius: 8px; font-size: 1.1rem;">
            <i class="fa fa-plus"></i> Nueva Asistencia
        </a>
        @endcan
        <a href="{{ route('amdashboard') }}" class="btn btn-secondary shadow-sm" style="border-radius: 8px; font-size: 1.1rem;">
            <i class="fa fa-arrow-left"></i> Volver
        </a>
    </div>
<!-- Formulario de búsqueda con diseño compacto -->
<div class="d-flex justify-content-start">
    <form method="GET" action="{{ route('am_person_events.index') }}" class="d-flex" style="max-width: 600px;">
        <input type="text" name="search" class="form-control me-2" placeholder="Buscar por nombre o DNI"
            value="{{ request('search') }}" style="border-radius: 8px; max-width: 250px;">
        
        <select name="event" class="form-control me-2" style="border-radius: 8px; max-width: 250px;">
            <option value="">Todos los eventos</option>
            @foreach($events as $event)
                <option value="{{ $event->id }}" {{ request('event') == $event->id ? 'selected' : '' }}>
                    {{ $event->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn text-white shadow-sm" style="background: #f67280; border-radius: 8px;">
            <i class="fa fa-search"></i>
        </button>
    </form>
</div>
    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm" style="border-radius: 8px;">
            {{ session('success') }}
        </div>
    @endif
<br>
    <!-- Tabla de datos -->
    <div class="card shadow-lg" style="border-radius: 15px;">
        <div class="card-header text-white" style="background: #6c5b7b; border-radius: 15px 15px 0 0;">
            <h3 class="card-title mb-0">Asistencias Registradas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="text-white" style="background: #355c7d;">
                    <tr>
                        <th>#</th>
                        <th>Persona</th>
                        <th>Evento</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personEvents as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->amPerson->given_name }} {{ $record->amPerson->paternal_last_name }} {{ $record->amPerson->given_name }} </td>
                            <td>{{ $record->event->name }}</td>
                            <td>
                                <span class="badge text-white"
                                    style="font-size: 16px; padding: 8px; border-radius: 8px; 
                                        background: {{ $record->status === 'Asistió' ? '#28a745' : '#f39c12' }};">
                                    {{ $record->status }}
                                </span>
                            </td>
                            <td>
                                @can('ver detalles')
                                <a href="{{ route('am_person_events.show', $record->id) }}" class="btn btn-info btn-sm shadow-sm">
                                    <i class="fa fa-eye"></i> Ver
                                </a>
                                @endcan
                                @can('editar')
                                <a href="{{ route('am_person_events.edit', $record->id) }}" class="btn btn-warning btn-sm shadow-sm">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                @endcan
                                <form action="{{ route('am_person_events.destroy', $record->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    @can('eliminar')
                                    <button type="submit" class="btn btn-danger btn-sm shadow-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar esta asistencia?')">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $personEvents->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .btn {
            border-radius: 8px;
        }

        .shadow-lg {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .card-header h3 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .alert {
            border-radius: 8px;
        }

        .badge {
            font-size: 1rem;
            padding: 6px 12px;
        }

        .table th {
            text-align: center;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #ffffff;
        }

        .btn-sm {
            font-size: 0.85rem;
        }

        .table {
            font-size: 0.9rem;
        }
    </style>
@stop

@section('js')
    <script>
        // JS adicional si lo necesitas
    </script>
@stop
