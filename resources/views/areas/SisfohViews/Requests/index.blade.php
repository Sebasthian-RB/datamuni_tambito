<!-- resources/views/sisfoh/requests/index.blade.php -->

@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Lista de Solicitudes</h1>
        <a href="{{ route('sfh_requests.create') }}" class="mb-3 btn btn-primary">Crear Nueva Solicitud</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->name }}</td>
                        <td>{{ $request->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('sfh_requests.show', $request) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('sfh_requests.edit', $request) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('sfh_requests.destroy', $request) }}" method="POST" class="d-inline">
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
@endsection
