@extends('adminlte::page')

@section('title', 'Listado de Cuidadores')

@section('content_header')
    <h1>Listado de Cuidadores</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('caregivers.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Agregar Cuidador
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre Completo</th>
                    <th>Relación</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($caregivers as $caregiver)
                    <tr>
                        <td>{{ $caregiver->id }}</td>
                        <td>{{ $caregiver->full_name }}</td>
                        <td>{{ $caregiver->relationship }}</td>
                        <td>{{ $caregiver->dni }}</td>
                        <td>{{ $caregiver->phone ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('caregivers.show', $caregiver) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('caregivers.edit', $caregiver) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('caregivers.destroy', $caregiver) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este cuidador?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay cuidadores registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css">
@stop

@section('js')
    <script>
        console.log('Listado de Cuidadores cargado.');
    </script>
@stop
