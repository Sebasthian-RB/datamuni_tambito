@extends('adminlte::page')

@section('title', 'Tipos de Violencia')

@section('content_header')
    <h1>Tipos de Violencia</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title">Listado de Violencias</h3>
        <div class="card-tools">
            <a href="{{ route('violences.create') }}" class="btn btn-success btn-sm">Nueva Violencia</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
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
                        <td>{{ $violence->description }}</td>
                        <td>
                            <a href="{{ route('violences.show', $violence->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('violences.edit', $violence->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('violences.destroy', $violence->id) }}" method="POST" style="display:inline;">
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
