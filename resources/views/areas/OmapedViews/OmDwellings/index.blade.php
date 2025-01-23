@extends('adminlte::page')

@section('title', 'Listado de Viviendas')

@section('content_header')
    <h1>Listado de Viviendas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('om-dwellings.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Vivienda
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Localización</th>
                        <th>Referencia</th>
                        <th>Agua/Luz</th>
                        <th>Tipo</th>
                        <th>Ocupantes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dwellings as $dwelling)
                        <tr>
                            <td>{{ $dwelling->id }}</td>
                            <td>{{ $dwelling->exact_location }}</td>
                            <td>{{ $dwelling->reference ?? 'N/A' }}</td>
                            <td>{{ $dwelling->water_electricity }}</td>
                            <td>{{ $dwelling->type }}</td>
                            <td>{{ $dwelling->permanent_occupants }}</td>
                            <td>
                                <a href="{{ route('om-dwellings.show', $dwelling->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('om-dwellings.edit', $dwelling->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('om-dwellings.destroy', $dwelling->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta vivienda?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
