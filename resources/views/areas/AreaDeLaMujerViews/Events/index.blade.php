@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <!-- Imagen superior -->
    <div class="d-flex justify-content-center align-items-center py-3" style="background: #c06c84; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
    </div>
    <br>
    <h1 class="text-white" style="background: #355c7d; padding: 10px; border-radius: 8px; text-align: center;">
        Eventos Registrados
    </h1>
@stop

@section('content')
    <div class="container">
        <!-- Botones de acción -->
        <div class="mb-3 d-flex">
            <a href="{{ route('events.create') }}" class="btn text-white shadow-sm" style="background: #f67280; border-radius: 8px;">
                <i class="fa fa-plus"></i> Agregar Nuevo Evento
            </a>
            <a href="{{ route('amdashboard') }}" class="btn btn-secondary shadow-sm" style="border-radius: 8px;">
                <i class="fa fa-arrow-left"></i> Volver
            </a>
        </div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="alert alert-success shadow-sm" style="border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de datos -->
        <div class="card shadow-lg" style="border-radius: 15px;">
            <div class="card-header text-white" style="background: #6c5b7b; border-radius: 15px 15px 0 0;">
                <h3 class="card-title mb-0">Eventos Registrados</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="text-white" style="background: #355c7d;">
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
                                    <span class="badge text-white"
                                          style="font-size: 16px; padding: 8px; border-radius: 8px;
                                                 background: {{ $event->status === 'En proceso' ? '#f39c12' : 
                                                 ($event->status === 'Finalizado' ? '#28a745' : 
                                                 ($event->status === 'Cancelado' ? '#dc3545' : '#f0ad4e')) }};">
                                        {{ $event->status }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm shadow-sm">
                                        <i class="fa fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm shadow-sm">
                                        <i class="fa fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('¿Estás seguro?')">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginador -->
                <div class="mt-3">
                    {{ $events->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@stop
