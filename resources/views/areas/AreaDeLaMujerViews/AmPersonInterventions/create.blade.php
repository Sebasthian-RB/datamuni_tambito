@extends('adminlte::page')

@section('title', 'Crear Relación Persona-Intervención')

@section('content_header')
<!-- Imagen superior -->
<div class="d-flex justify-content-center align-items-center py-3" style="background: #c06c84; border-radius: 0 0 15px 15px;">
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')

<div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
        <h3 class="card-title mb-0">Registro de Intervenciones</h3>
    </div>
    
    <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
        <form action="{{ route('am_person_interventions.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="am_person_id" class="font-weight-bold" style="color: #355c7d;">Seleccionar Persona</label>
                        <div class="input-group">
                            <select name="am_person_id" id="am_person_id" 
                                    class="form-control select2 shadow-sm" 
                                    style="border: 2px solid #c06c84; border-radius: 8px;" required>
                                <option value="">Buscar persona...</option>
                                @foreach ($amPersons as $person)
                                    <option value="{{ $person->id }}">
                                        {{ $person->given_name }} {{ $person->paternal_last_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" 
                                        style="background: #f67280; border-color: #f67280; border-radius: 0 8px 8px 0;"
                                        data-toggle="modal" data-target="#addPersonModal">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="status" class="font-weight-bold" style="color: #355c7d;">Estado de la Intervención</label>
                        <select name="status" id="status" 
                                class="form-control shadow-sm" 
                                style="border: 2px solid #c06c84; border-radius: 8px;" required>
                            <option value="En progreso" style="color: #355c7d;">🟡 En progreso</option>
                            <option value="Completado" style="color: #355c7d;">🟢 Completado</option>
                            <option value="Cancelado" style="color: #355c7d;">🔴 Cancelado</option>
                        </select>
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="intervention_id" class="font-weight-bold" style="color: #355c7d;">Tipo de Intervención</label>
                        <div class="input-group">
                            <select name="intervention_id" id="intervention_id" 
                                    class="form-control select2 shadow-sm" 
                                    style="border: 2px solid #c06c84; border-radius: 8px;" required>
                                <option value="">Seleccionar intervención...</option>
                                @foreach ($interventions as $intervention)
                                    <option value="{{ $intervention->id }}">{{ $intervention->appointment }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info" 
                                        style="background: #c06c84; border-color: #c06c84; border-radius: 0 8px 8px 0;"
                                        data-toggle="modal" data-target="#addInterventionModal">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="text-right mt-4">
                <button type="submit" class="btn btn-lg shadow-sm" 
                        style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('am_person_interventions.index') }}" class="btn btn-lg btn-secondary shadow-sm" 
                   style="border-radius: 8px;">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
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

    <!-- Modal para agregar intervención -->
    <div class="modal fade" id="addInterventionModal" tabindex="-1" aria-labelledby="addInterventionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="addInterventionModalLabel">Agregar Intervención</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addInterventionForm">
                        @csrf
                        <div class="form-group">
                            <label for="appointment">Cita</label>
                            <textarea name="appointment" id="appointment" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="derivation">Derivación</label>
                            <textarea name="derivation" id="derivation" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="appointment_date">Fecha de la Cita</label>
                            <input type="datetime-local" name="appointment_date" id="appointment_date"
                                class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-success" id="saveIntervention">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  
    <style>
        .select2-container--default .select2-selection--single {
            border-radius: 8px !important;
            border: 2px solid #c06c84 !important;
            height: calc(1.5em + 1rem + 2px) !important;
        }
        
        .card {
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .form-control:focus {
            border-color: #f67280 !important;
            box-shadow: 0 0 0 0.2rem rgba(246, 114, 128, 0.25) !important;
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Inicializar Select2 en todos los campos con la clase 'select2'
            $('.select2').select2({
                width: '100%', // Asegurar que ocupa el 100% del ancho del contenedor
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

    <!-- Modal para intervención -->

   <script>
    $(document).ready(function() {
        // Guardar intervención con AJAX
        $('#saveIntervention').on('click', function() {
            const formData = $('#addInterventionForm').serialize();

            $.ajax({
                url: "{{ route('interventions.store') }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // Agregar la nueva intervención al select
                        const newOption = new Option(response.data.appointment, response.data.id, true, true);
                        $('#intervention_id').append(newOption).trigger('change');

                        // Cerrar el modal
                        $('#addInterventionModal').modal('hide');

                        // Resetear el formulario
                        $('#addInterventionForm')[0].reset();

                        // Mensaje de éxito
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Error al agregar intervención. Por favor, verifica los datos.');
                }
            });
        });
    });
</script>
@stop
