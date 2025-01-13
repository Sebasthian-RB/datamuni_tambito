<!-- resources/views/sisfoh/enumerators/index.blade.php -->
@extends('adminlte::page')  // Cambiar el nombre 

@section('content')
<div class="container">
    <h1>Listado de Encuestadores</h1>
    <a href="{{ route('enumerators.create') }}" class="btn btn-primary">Nuevo Encuestador</a>
    
    @if(session('success'))
        <div class="mt-3 alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table mt-3 table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enumerators as $enumerator)
                <tr>
                    <td>{{ $enumerator->id }}</td>
                    <td>{{ $enumerator->name }}</td>
                    <td>
                        <a href="{{ route('enumerators.show', $enumerator) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('enumerators.edit', $enumerator) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('enumerators.destroy', $enumerator) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este encuestador?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection