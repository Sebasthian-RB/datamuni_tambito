@extends('adminlte::page')

@section('title', 'Comités')

@section('content_header')
    <h1>Lista de Comités</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('committees.create') }}" class="btn btn-info mb-3">Agregar Comité</a>
    <a href="{{ route('sectors.create') }}" class="btn btn-danger mb-3">Volver</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Comités Registrados</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Número de Sector</th>
                        <th>Nombre</th>
                        <th>Presidente(a)</th>
                        <th>Núcleo Urbano</th>
                        <th>Número de beneficiarios</th>
                        <th>Sector</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($committees as $committee)
                        <tr>
                            <td>{{ $committee->id }}</td>
                            <td>{{ $committee->name }}</td>
                            <td>{{ $committee->president }}</td>
                            <td>{{ $committee->urban_core }}</td>
                            <td>{{ $committee->beneficiaries_count }}</td>
                            <td>{{ $committee->sector->name }}</td>
                            <td>
                                <a href="{{ route('committees.show', $committee->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('committees.edit', $committee->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('committees.destroy', $committee->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este comité?')">Eliminar</button>
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
