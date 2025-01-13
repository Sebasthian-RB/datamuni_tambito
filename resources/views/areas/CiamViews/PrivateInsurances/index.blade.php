@extends('adminlte::page')

@section('title', 'Lista de Seguros Privados')

@section('content_header')
<div>
    <h1>Seguros Privados</h1>
</div>
@stop

@section('content')
<div class="card">
    <a href="{{ route('private_insurances.create') }}" class="btn btn-success float-right">Crear Nuevo</a>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($privateInsurances as $insurance)
                <tr>
                    <td>{{ $insurance->id }}</td>
                    <td>{{ $insurance->private_insurances_name }}</td>
                    <td>
                        <a href="{{ route('private_insurances.show', $insurance->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('private_insurances.edit', $insurance->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('private_insurances.destroy', $insurance->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop