@extends('adminlte::page')

@section('title', 'Listado de Adultos Mayores')

@section('content_header')
<h1 class="text-center">Listado de Adultos Mayores</h1>
@stop

@section('content')
<div class="container">
    <!-- Botones de acción -->
    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('elderly_adults.create') }}" class="btn" style="background-color: #6E8E59; color: white;">
            <i class="fas fa-user-plus"></i> Agregar Adulto Mayor
        </a>
        <a href="{{ route('ciamdashboard') }}" class="btn btn-secondary" style="background-color: #CAE0BC; color: black;">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <!-- Mensaje de éxito -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Tabla de Adultos Mayores -->
    <div class="card">
        <div class="card-header text-white" style="background-color: #6E8E59;">
            <h3 class="card-title"><i class="fas fa-users"></i> Adultos Mayores Registrados</h3>
        </div>
        <div class="card-body">
            <table id="elderlyAdultsTable" class="table table-bordered table-striped">
                <thead style="background-color: #CAE0BC; color: black;">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Sexo</th>
                        <th>Edad</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elderlyAdults as $elderlyAdult)
                    <tr>
                        <td class="text-center">{{ $elderlyAdult->id }}</td>
                        <td>{{ $elderlyAdult->given_name }} {{ $elderlyAdult->paternal_last_name }} {{ $elderlyAdult->maternal_last_name }}</td>
                        <td class="text-center">{{ $elderlyAdult->sex_type == 0 ? 'Femenino' : 'Masculino' }}</td>
                        <td class="text-center">{{ $elderlyAdult->birth_date->age }} años</td>
                        <td class="text-center">{{ $elderlyAdult->phone_number ?? 'No registrado' }}</td>
                        <td class="text-center">
                            <!-- Botones de acciones -->
                            <a href="{{ route('elderly_adults.show', $elderlyAdult->id) }}" class="btn btn-sm text-white" style="background-color: #6E8E59;">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                            <a href="{{ route('elderly_adults.edit', $elderlyAdult->id) }}" class="btn btn-sm text-white" style="background-color: #CAE0BC;">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $elderlyAdult->id }}">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </td>
                    </tr>

                    <!-- Modal de Confirmación de Eliminación -->
                    <div class="modal fade" id="deleteModal{{ $elderlyAdult->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #780C28; color: white;">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar a <strong>{{ $elderlyAdult->given_name }} {{ $elderlyAdult->paternal_last_name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('elderly_adults.destroy', $elderlyAdult->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#elderlyAdultsTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
            },
            responsive: true,
            autoWidth: false,
        });
    });
</script>
@stop