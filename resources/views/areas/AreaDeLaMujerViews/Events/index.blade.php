@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <h1>Eventos</h1>
@stop

@section('content')
<div class="container">
    <!-- Botones de acción -->
    <a href="{{ route('events.create') }}" class="btn btn-info mb-3">
        <i class="fa fa-plus"></i> Agregar Nuevo Evento
    </a>
    <a href="{{ route('sectors.create') }}" class="btn btn-danger mb-3"><i class="fa fa-arrow-left"></i> Volver</a>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla de datos -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Eventos Registrados</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Lugar</th>
                        <th>Programa</th>
                        <th>Estado</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->place }}</td>
                            <td>{{ $event->program->name }}</td>
                            <td>
                                <span class="badge {{ $event->status === 'Activo' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $event->status }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">
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
