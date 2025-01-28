<!-- resources/views/areas/AreaDeLaMujerViews/AmPersons/index.blade.php -->
@extends('adminlte::page')

@section('title', 'Listado de Personas')

@section('content_header')
    <h1>Listado de Personas</h1>
@stop

@section('content')
<div class="container">
    <!-- Botones de acción -->
    <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#addPersonModal">
        <i class="fa fa-plus"></i> Agregar Persona
    </button>
    <a href="{{ route('amdashboard') }}" class="btn btn-danger mb-3">
        <i class="fa fa-arrow-left"></i> Volver
    </a>
    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla de datos -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Personas Registradas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>N° Documento</th>
                        <th>Documento de Identidad</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($people as $person)
                        <tr>
                            <td>{{ $person->id }}</td>
                            <td>{{ $person->identity_document }}</td>
                            <td>{{ $person->given_name }} {{ $person->paternal_last_name }} {{ $person->maternal_last_name }}</td>
                            <td>
                                <a href="{{ route('am_people.show', $person->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</a>
                                <a href="{{ route('am_people.edit', $person->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                <form action="{{ route('am_people.destroy', $person->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar a esta persona?')">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addPersonModal" tabindex="-1" aria-labelledby="addPersonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="addPersonModalLabel">Agregar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addPersonForm">
                    @csrf
                    <div class="form-group">
                        <label for="id">N° Documento</label>
                        <input type="text" class="form-control" id="id" name="id" required>
                    </div>
                    <div class="form-group">
                        <label for="identity_document">Documento de Identidad</label>
                        <select class="form-control" id="identity_document" name="identity_document" required>
                            <option value="DNI">DNI</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="Carnet">Carnet</option>
                            <option value="Cedula">Cedula</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="given_name">Nombre</label>
                        <input type="text" class="form-control" id="given_name" name="given_name" required>
                    </div>
                    <div class="form-group">
                        <label for="paternal_last_name">Apellido Paterno</label>
                        <input type="text" class="form-control" id="paternal_last_name" name="paternal_last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="maternal_last_name">Apellido Materno</label>
                        <input type="text" class="form-control" id="maternal_last_name" name="maternal_last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="sex_type">Sexo</label>
                        <select class="form-control" id="sex_type" name="sex_type" required>
                            <option value="1">Masculino</option>
                            <option value="0">Femenino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Número de Teléfono</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number" min="0">
                    </div>
                    <div class="form-group">
                        <label for="attendance_date">Fecha de Asistencia</label>
                        <input type="datetime-local" class="form-control" id="attendance_date" name="attendance_date" required>
                    </div>
                    <button type="button" class="btn btn-success" id="savePerson">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Guardar persona con AJAX
            $('#savePerson').on('click', function() {
                const formData = $('#addPersonForm').serialize();

                $.ajax({
                    url: "{{ route('am_people.store') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        // Recargar la página para ver la nueva persona agregada
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Error al agregar persona. Por favor, verifica los datos.');
                    }
                });
            });
        });
    </script>
@stop