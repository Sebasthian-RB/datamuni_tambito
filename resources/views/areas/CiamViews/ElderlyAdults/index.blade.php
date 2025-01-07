@extends('adminlte::page')

@section('title', 'Adultos Mayores')

@section('content_header')
    <h1>Listado de Adultos Mayores</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('elderly_adults.create') }}" class="btn btn-success">Nuevo Adulto Mayor</a>
        </div>
        <div class="card-body">
            <table id="elderlyAdultsTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elderlyAdults as $elderlyAdult)
                        <tr>
                            <td>{{ $elderlyAdult->id }}</td>
                            <td>{{ $elderlyAdult->given_name }}</td>
                            <td>{{ $elderlyAdult->paternal_last_name }}</td>
                            <td>{{ $elderlyAdult->maternal_last_name }}</td>
                            <td>
                                <a href="{{ route('elderly_adults.show', $elderlyAdult->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('elderly_adults.edit', $elderlyAdult->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('elderly_adults.destroy', $elderlyAdult->id) }}" method="POST" style="display:inline;">
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

@section('css')
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#elderlyAdultsTable').DataTable();
        });
    </script>
@stop
