@extends('adminlte::page')

@section('title', 'Nueva Asistencia')

@section('content_header')
    <h1>Nueva Asistencia</h1>
@stop

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('am_person_events.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="am_person_id">Persona</label>
                    <select name="am_person_id" id="am_person_id" class="form-control select2" required>
                        <option value="">Seleccione una persona</option>
                        @foreach($people as $person)
                            <option value="{{ $person->id }}">{{ $person->given_name }} {{ $person->paternal_last_name }}</option>
                        @endforeach
                    </select>
                    <!-- Botón para abrir el modal -->
                    <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#addPersonModal">
                        Agregar Persona
                    </button>
                </div>
                <div class="form-group">
                    <label for="event_id">Evento</label>
                    <select name="event_id" id="event_id" class="form-control select2" required>
                        <option value="">Seleccione un evento</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Seleccione un estado</option>
                        <option value="Asistió">Asistió</option>
                        <option value="No Asistió">No Asistió</option>
                        <option value="Justificado">Justificado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="attendance_datetime">Fecha y Hora de Asistencia</label>
                    <input 
                        type="datetime-local" 
                        name="attendance_datetime" 
                        id="attendance_datetime" 
                        class="form-control" 
                        value="{{ old('attendance_datetime') }}" 
                        required
                    >
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('am_person_events.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

    <!-- Modal personas -->
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
                            <input type="text" class="form-control" id="paternal_last_name" name="paternal_last_name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="maternal_last_name">Apellido Materno</label>
                            <input type="text" class="form-control" id="maternal_last_name" name="maternal_last_name"
                                required>
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
                            <input type="number" class="form-control" id="phone_number" name="phone_number"
                                min="0">
                        </div>
                        <div class="form-group">
                            <label for="attendance_date">Fecha de Asistencia</label>
                            <input type="datetime-local" class="form-control" id="attendance_date"
                                name="attendance_date" required>
                        </div>
                        <button type="button" class="btn btn-success" id="savePerson">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 36px; /* Ajusta la altura según tus necesidades */
            padding: 10px;
            font-size: 16px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 20px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 20px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2 en los campos Persona y Evento
            $('.select2').select2({
                width: '100%', // Ocupa el 100% del ancho del contenedor
                placeholder: 'Seleccione una opción', // Placeholder para campos vacíos
                allowClear: true // Permitir limpiar la selección
            });
        });
    </script>
    <!-- Modal para persona -->
    <script>
        $(document).ready(function() {
            $('#am_person_id').select2({
                placeholder: "Seleccione una persona",
                allowClear: true,
                width: '100%'
            });

            // Guardar persona con AJAX
            $('#savePerson').on('click', function() {
                const formData = $('#addPersonForm').serialize();

                $.ajax({
                    url: "{{ route('am_people.store') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        // Actualizar el select con la nueva persona
                        const newOption = new Option(response.given_name + ' ' + response.paternal_last_name, response.id, true, true);
                        $('#am_person_id').append(newOption).trigger('change');

                        // Cerrar el modal
                        $('#addPersonModal').modal('hide');

                        // Resetear el formulario
                        $('#addPersonForm')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error al agregar persona. Por favor, verifica los datos.');
                    }
                });
            });
        });
    </script>
@stop
