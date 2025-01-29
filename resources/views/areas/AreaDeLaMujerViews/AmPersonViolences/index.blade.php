@extends('adminlte::page')

@section('title', 'Relaciones de Violencia con Personas')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #c06c84; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
    <br>
    <h1 class="text-white text-center" style="background: #355c7d; padding: 10px; border-radius: 8px;">
        Casos de Violencia por Persona
    </h1>
@stop

@section('content')
    <div class="container">
        <!-- Botones de acción -->
        <div class="mb-3 d-flex">
            <a href="{{ route('am_person_violences.create') }}" class="btn text-white shadow-sm"
                style="background: #f67280; border-radius: 8px;">
                <i class="fa fa-plus"></i> Nuevo Caso
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
                <h3 class="card-title mb-0">Listado de Casos</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="text-white" style="background: #355c7d;">
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
                                    <a href="{{ route('am_person_violences.show', $relation->id) }}"
                                        class="btn btn-info btn-sm shadow-sm">
                                        <i class="fa fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('am_person_violences.edit', $relation->id) }}"
                                        class="btn btn-warning btn-sm shadow-sm">
                                        <i class="fa fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('am_person_violences.destroy', $relation->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm"
                                            onclick="return confirm('¿Está seguro de eliminar esta relación?')">
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
                    {{ $amPersonViolences->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@stop
