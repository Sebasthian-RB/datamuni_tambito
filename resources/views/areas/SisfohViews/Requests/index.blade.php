@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Listado de Solicitudes</h1>

    {{-- Mensajes de éxito --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla de solicitudes --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha de Solicitud</th>
                <th>Descripción</th>
                <th>Persona Relacionada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->formatted_request_date }}</td>
                    <td>{{ $request->description }}</td>
                    <td>{{ $request->sfhPerson->given_name ?? 'N/A' }} {{ $request->sfhPerson->paternal_last_name ?? '' }} {{ $request->sfhPerson->maternal_last_name ?? '' }}</td>
                    <td>
                        <a href="{{ route('sfh_requests.show', $request->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('sfh_requests.edit', $request->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('sfh_requests.destroy', $request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta solicitud?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay solicitudes registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Botón para crear nueva solicitud --}}
    <a href="{{ route('sfh_requests.create') }}" class="btn btn-primary">Nueva Solicitud</a>
</div>
@endsection
