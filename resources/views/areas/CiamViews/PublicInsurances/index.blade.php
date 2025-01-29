@extends('adminlte::page')

@section('title', 'Lista de Seguros Públicos')

@section('content_header')
<h1>Seguros Públicos</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('public_insurances.create') }}" class="btn btn-success">Crear Nuevo Seguro Público</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Seguro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($publicInsurances as $insurance)
                <tr>
                    <td>{{ $insurance->id }}</td>
                    <td>{{ $insurance->public_insurances_name }}</td>
                    <td>
                        <a href="{{ route('public_insurances.show', $insurance->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('public_insurances.edit', $insurance->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('public_insurances.destroy', $insurance->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este seguro público?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No hay seguros públicos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop