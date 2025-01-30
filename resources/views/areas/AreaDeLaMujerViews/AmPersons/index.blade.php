<!-- resources/views/areas/AreaDeLaMujerViews/AmPersons/index.blade.php -->
@extends('adminlte::page')

@section('title', 'Listado de Personas')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #c06c84; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
    <br>
    <h1 class="text-white text-center" style="background: #355c7d; padding: 10px; border-radius: 8px;">
        Personas Registradas
</h1>@stop

@section('content')
    <div class="container">

        <!-- Botones de acción -->
        <div class="mb-3 d-flex">
            <button type="button" class="btn text-white shadow-sm me-2" data-toggle="modal" data-target="#addPersonModal"
                style="background: #f67280; border-radius: 8px;">
                <i class="fa fa-plus"></i> Agregar Persona
            </button>
            <a href="{{ route('amdashboard') }}" class="btn btn-secondary shadow-sm" style="border-radius: 8px;">
                <i class="fa fa-arrow-left"></i> Volver
            </a>

        </div>
        <!-- Formulario de búsqueda con diseño compacto -->
        <div class="d-flex justify-content-start">
            <form method="GET" action="{{ route('am_people.index') }}" class="d-flex" style="max-width: 1000px;">
                <input type="text" name="search" class="form-control ms-3" placeholder="Buscar por nombre o DNI"
                    value="{{ request('search') }}" style="border-radius: 8px; max-width: 250px;">
                <button type="submit" class="btn text-white shadow-sm" style="background: #f67280; border-radius: 8px;">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success shadow-sm" style="border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif
        <br>
        <!-- Tabla de datos -->
        <div class="card shadow-lg" style="border-radius: 15px;">
            <div class="card-header text-white" style="background: #6c5b7b; border-radius: 15px 15px 0 0;">
                <h3 class="card-title mb-0">Lista de Personas</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="text-white" style="background: #355c7d;">
                        <tr>
                            <th>N° Documento</th>
                            <th>Nombres</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($people as $person)
                            <tr>
                                <td>{{ $person->id }}</td>
                                <td>{{ $person->given_name }} {{ $person->paternal_last_name }}
                                    {{ $person->maternal_last_name }}</td>
                                <td>{{ $person->phone_number }}</td>
                                <td>
                                    <a href="{{ route('am_people.show', $person->id) }}"
                                        class="btn btn-info btn-sm shadow-sm">
                                        <i class="fa fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('am_people.edit', $person->id) }}"
                                        class="btn btn-warning btn-sm shadow-sm">
                                        <i class="fa fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('am_people.destroy', $person->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm"
                                            onclick="return confirm('¿Estás seguro de eliminar a esta persona?')">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginador centrado -->
                <div class="mt-3">
                    {{ $people->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addPersonModal" tabindex="-1" aria-labelledby="addPersonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg" style="border-radius: 15px;">
                <div class="modal-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
                    <h5 class="modal-title" id="addPersonModalLabel">Agregar Persona</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
                    <form id="addPersonForm">
                        @csrf
                        <div class="row">
                            <!-- Columna Izquierda -->
                            <div class="col-md-6">

                                <div class="form-group mb-4">
                                    <label for="identity_document" class="font-weight-bold"
                                        style="color: #355c7d;">Documento de Identidad</label>
                                    <select class="form-control select2" id="identity_document" name="identity_document"
                                        required>
                                        <option value="DNI">DNI</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                        <option value="Carnet">Carnet</option>
                                        <option value="Cedula">Cedula</option>
                                    </select>
                                    <span class="text-danger error-text identity_document_error"></span>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="given_name" class="font-weight-bold" style="color: #355c7d;">Nombre</label>
                                    <input type="text" class="form-control" id="given_name" name="given_name" required>
                                    <span class="text-danger error-text given_name_error"></span>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="maternal_last_name" class="font-weight-bold"
                                        style="color: #355c7d;">Apellido Materno</label>
                                    <input type="text" class="form-control" id="maternal_last_name"
                                        name="maternal_last_name" required>
                                    <span class="text-danger error-text maternal_last_name_error"></span>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="address" class="font-weight-bold"
                                        style="color: #355c7d;">Dirección</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                    <span class="text-danger error-text address_error"></span>
                                </div>

                            </div>

                            <!-- Columna Derecha -->
                            <div class="col-md-6">

                                <div class="form-group mb-4">
                                    <label for="id" class="font-weight-bold" style="color: #355c7d;">N°
                                        Documento</label>
                                    <input type="text" class="form-control" id="id" name="id" required>
                                    <span class="text-danger error-text id_error"></span>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="paternal_last_name" class="font-weight-bold"
                                        style="color: #355c7d;">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="paternal_last_name"
                                        name="paternal_last_name" required>
                                    <span class="text-danger error-text paternal_last_name_error"></span>
                                </div>



                                <div class="form-group mb-4">
                                    <label for="sex_type" class="font-weight-bold" style="color: #355c7d;">Sexo</label>
                                    <select class="form-control" id="sex_type" name="sex_type" required>
                                        <option value="1">Masculino</option>
                                        <option value="0">Femenino</option>
                                    </select>
                                    <span class="text-danger error-text sex_type_error"></span>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="phone_number" class="font-weight-bold" style="color: #355c7d;">Número de
                                        Teléfono</label>
                                    <input type="number" class="form-control" id="phone_number" name="phone_number"
                                        min="0">
                                    <span class="text-danger error-text phone_number_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Fecha de Asistencia -->
                        <div class="form-group mb-4">
                            <label for="attendance_date" class="font-weight-bold" style="color: #355c7d;">Fecha de
                                Asistencia</label>
                            <input type="datetime-local" class="form-control" id="attendance_date"
                                name="attendance_date" required>
                            <span class="text-danger error-text attendance_date_error"></span>
                        </div>

                        <!-- Botones -->
                        <div class="text-right mt-4">
                            <button type="button" class="btn btn-lg shadow-sm" id="savePerson"
                                style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                            <button type="button" class="btn btn-lg btn-secondary shadow-sm" data-dismiss="modal"
                                style="border-radius: 8px;">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <style>
        .select2-container--default .select2-selection--single {
            border-radius: 8px !important;
            border: 2px solid #c06c84 !important;
            height: calc(1.5em + 1rem + 2px) !important;
        }

        .card,
        .modal-content {
            transition: transform 0.3s ease;
        }

        .card:hover,
        .modal-content:hover {
            transform: translateY(-5px);
        }

        .form-control:focus {
            border-color: #9ebbff !important;
            box-shadow: 0 0 0 0.2rem rgba(188, 217, 243, 0.25) !important;
        }

        /* Botón de agregar persona */
        #savePerson {
            background: #f67280;
            border-color: #f67280;
            color: white;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        #savePerson:hover {
            filter: brightness(90%);
        }
    </style>
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#savePerson').on('click', function() {
                let formData = $('#addPersonForm').serialize();

                // Limpiar mensajes de error previos
                $('.error-text').text('');

                $.ajax({
                    url: "{{ route('am_people.store') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            // Limpiar el formulario
                            $('#addPersonForm')[0].reset();

                            // Cerrar el modal
                            $('#addPersonModal').modal('hide');

                            // Mostrar un mensaje de éxito (puedes cambiarlo por una notificación más elegante)
                            alert(response.message);

                            // Recargar la página para ver los cambios
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            // Mostrar errores en los campos correspondientes
                            $.each(errors, function(field, messages) {
                                $('.' + field + '_error').text(messages[0]);
                            });
                        } else {
                            alert('Error inesperado. Intente de nuevo.');
                        }
                    }
                });
            });
        });
    </script>
@stop
