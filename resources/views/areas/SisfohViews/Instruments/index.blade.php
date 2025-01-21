@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Listado de Instrumentos</h1>
        <a href="{{ route('instruments.create') }}" class="mb-3 btn btn-primary">Crear Nuevo Instrumento</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($instruments as $instrument)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $instrument->name_instruments }}</td>
                        <td>{{ $instrument->type_instruments }}</td>
                        <td>{{ $instrument->description }}</td>
                        <td>
                            <a href="{{ route('instruments.show', $instrument) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('instruments.edit', $instrument) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('instruments.destroy', $instrument) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
