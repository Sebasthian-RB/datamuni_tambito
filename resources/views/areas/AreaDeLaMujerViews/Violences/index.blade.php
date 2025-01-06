@extends('adminlte::page')

@section('title', 'Tipos de Violencia')

@section('content_header')
    <h1>Tipos de Violencia</h1>
@endsection

@section('content')
<div class="container">
    <!-- Botón de acción -->
    <a href="{{ route('violences.create') }}" class="btn btn-info mb-3">
        <i class="fa fa-plus"></i> Nueva Violencia
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
            <h3 class="card-title">Listado de Violencias</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($violences as $violence)
                        <tr>
                            <td>{{ $violence->id }}</td>
                            <td>{{ $violence->kind_violence }}</td>
                            <td>{{ Str::limit($violence->description, 50) }}</td> <!-- Limitar a 50 caracteres -->
                            <td>
                                <a href="{{ route('violences.show', $violence->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('violences.edit', $violence->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('violences.destroy', $violence->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro?')">
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
@endsection
