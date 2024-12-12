@extends('adminlte::page')

@section('title', 'Relaciones de Violencia con Personas')

@section('content_header')
    <h1>Relaciones de Violencia con Personas</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title">Listado de Relaciones</h3>
        <div class="card-tools">
            <a href="{{ route('am_person_violences.create') }}" class="btn btn-success btn-sm">Nueva Relación</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
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
                            <a href="{{ route('am_person_violences.show', $relation->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('am_person_violences.edit', $relation->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('am_person_violences.destroy', $relation->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
