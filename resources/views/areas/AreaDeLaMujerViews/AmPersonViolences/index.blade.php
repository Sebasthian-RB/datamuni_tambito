@extends('adminlte::page')

@section('title', 'Relaciones de Violencia con Personas')

@section('content_header')
    <h1>Casos de Personas</h1>
@stop

@section('content')
<div class="container">
    <!-- Botones de acción -->
    <a href="{{ route('am_person_violences.create') }}" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Nuevo Caso</a>
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
            <h3 class="card-title">Listado de Casos</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Persona</th>
                        <th>Tipo de Violencia</th>
                        <th>Fecha de Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($amPersonViolences as $relation)
                        <tr>
                            <td>{{ $relation->amPerson->given_name }} {{ $relation->amPerson->paternal_last_name }}</td>
                            <td>{{ $relation->violence->kind_violence }}</td>
                            <td>{{ $relation->registration_date->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('am_person_violences.show', $relation->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('am_person_violences.edit', $relation->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('am_person_violences.destroy', $relation->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta relación?')">
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
