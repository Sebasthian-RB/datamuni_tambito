<!-- resources/views/areas/SisfohViews/SfhDwelling/index.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Listado de Viviendas</h1>
        <a href="{{ route('sfh_dwelling.create') }}" class="mb-3 btn btn-primary">Crear Vivienda</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dirección</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sfhDwellings as $sfhDwelling)
                    <tr>
                        <td>{{ $sfhDwelling->id }}</td>
                        <td>{{ $sfhDwelling->address }}</td>
                        <td>{{ $sfhDwelling->type }}</td>
                        <td>
                            <a href="{{ route('sfh_dwelling.show', $sfhDwelling->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('sfh_dwelling.edit', $sfhDwelling->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('sfh_dwelling.destroy', $sfhDwelling->id) }}" method="POST" style="display:inline;">
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
