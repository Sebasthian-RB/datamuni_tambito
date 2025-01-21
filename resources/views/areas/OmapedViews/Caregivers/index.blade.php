@extends('adminlte::page')

@section('title', 'Listado de Cuidadores')

@section('content_header')
    <h1>Listado de Cuidadores</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('caregivers.create') }}" class="btn btn-success">Registrar Cuidador</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Parentesco</th>
                        <th>DNI</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($caregivers as $caregiver)
                        <tr>
                            <td>{{ $caregiver->id }}</td>
                            <td>{{ $caregiver->full_name }}</td>
                            <td>{{ $caregiver->relationship }}</td>
                            <td>{{ $caregiver->dni }}</td>
                            <td>{{ $caregiver->phone }}</td>
                            <td>
                                <a href="{{ route('caregivers.show', $caregiver) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('caregivers.edit', $caregiver) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('caregivers.destroy', $caregiver) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este cuidador?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
