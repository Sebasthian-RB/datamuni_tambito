@extends('adminlte::page')

@section('title', 'Programas')

@section('content_header')
    <h1>Programas</h1>
@stop

@section('content')
<div class="container">
    <!-- Botón de acción -->
    <a href="{{ route('programs.create') }}" class="btn btn-info mb-3">
        <i class="fa fa-plus"></i> Agregar Nuevo Programa
    </a>
    <a href="{{ route('amdashboard') }}" class="btn btn-danger mb-3">
        <i class="fa fa-arrow-left"></i> Volver
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
            <h3 class="card-title">Lista de Programas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $program)
                        <tr>
                            <td>{{ $program->id }}</td>
                            <td>{{ $program->name }}</td>
                            <td>{{ $program->program_type }}</td>
                            <td>
                                <span class="badge 
                                    @if($program->status == 'Pendiente') bg-warning 
                                    @elseif($program->status == 'Finalizado') bg-success 
                                    @elseif($program->status == 'En proceso') bg-primary 
                                    @elseif($program->status == 'Cancelado') bg-danger 
                                    @endif">
                                    {{ $program->status }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($program->start_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($program->end_date)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('programs.show', $program) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('programs.edit', $program) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('programs.destroy', $program) }}" method="POST" class="d-inline">
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
