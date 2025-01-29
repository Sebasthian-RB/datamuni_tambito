@extends('adminlte::page')

@section('title', 'Relaciones')

@section('content_header')
<h1>Relaciones entre Adultos Mayores y Seguros Privados</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('elderly_adult_private_insurances.create') }}" class="btn btn-primary">Nueva Relación</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Adulto Mayor</th>
                    <th>Seguro Privado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($relations as $relation)
                <tr>
                    <td>{{ $relation->id }}</td>
                    <td>{{ $relation->elderlyAdult->given_name }} {{ $relation->elderlyAdult->paternal_last_name }}</td>
                    <td>{{ $relation->privateInsurance->private_insurances_name }}</td>
                    <td>
                        <a href="{{ route('elderly_adult_private_insurances.show', $relation->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('elderly_adult_private_insurances.edit', $relation->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('elderly_adult_private_insurances.destroy', $relation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop