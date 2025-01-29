@extends('adminlte::page')

@section('title', 'Registrar Relación de Violencia')

@section('content_header')
<!-- Imagen superior -->
<div class="d-flex justify-content-center align-items-center py-3" style="background: #c06c84; border-radius: 0 0 15px 15px;">
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')

<div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
        <h3 class="card-title mb-0">Nuevo Caso</h3>
    </div>
    
    <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
        <form action="{{ route('am_person_violences.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="am_person_id" class="font-weight-bold" style="color: #355c7d;">Persona</label>
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
                </div>

                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="violence_id" class="font-weight-bold" style="color: #355c7d;">Tipo de Violencia</label>
                        <select name="violence_id" id="violence_id" 
                                class="form-control select2 shadow-sm" 
                                style="border: 2px solid #c06c84; border-radius: 8px;" required>
                            <option value="">Seleccionar tipo...</option>
                            @foreach ($violences as $violence)
                                <option value="{{ $violence->id }}">{{ $violence->kind_violence }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Fila completa para fecha -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-4">
                        <label for="registration_date" class="font-weight-bold" style="color: #355c7d;">Fecha de Registro</label>
                        <input type="datetime-local" name="registration_date" id="registration_date" 
                               class="form-control shadow-sm" 
                               style="border: 2px solid #c06c84; border-radius: 8px;" required>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="text-right mt-4">
                <button type="submit" class="btn btn-lg shadow-sm" 
                        style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('am_person_violences.index') }}" class="btn btn-lg btn-secondary shadow-sm" 
                   style="border-radius: 8px;">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Modal para agregar persona -->
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
                    <div class="form-group mb-4">
                        <label for="id" class="font-weight-bold" style="color: #355c7d;">N° Documento</label>
                        <input type="text" class="form-control shadow-sm" 
                               style="border: 2px solid #c06c84; border-radius: 8px;" 
                               id="id" name="id" required>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="identity_document" class="font-weight-bold" style="color: #355c7d;">Documento de Identidad</label>
                        <select class="form-control shadow-sm" 
                                style="border: 2px solid #c06c84; border-radius: 8px;" 
                                id="identity_document" name="identity_document" required>
                            <option value="DNI">DNI</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="Carnet">Carnet</option>
                            <option value="Cedula">Cedula</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="given_name" class="font-weight-bold" style="color: #355c7d;">Nombre</label>
                                <input type="text" class="form-control shadow-sm" 
                                       style="border: 2px solid #c06c84; border-radius: 8px;" 
                                       id="given_name" name="given_name" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="paternal_last_name" class="font-weight-bold" style="color: #355c7d;">Apellido Paterno</label>
                                <input type="text" class="form-control shadow-sm" 
                                       style="border: 2px solid #c06c84; border-radius: 8px;" 
                                       id="paternal_last_name" name="paternal_last_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="maternal_last_name" class="font-weight-bold" style="color: #355c7d;">Apellido Materno</label>
                        <input type="text" class="form-control shadow-sm" 
                               style="border: 2px solid #c06c84; border-radius: 8px;" 
                               id="maternal_last_name" name="maternal_last_name" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="address" class="font-weight-bold" style="color: #355c7d;">Dirección</label>
                        <input type="text" class="form-control shadow-sm" 
                               style="border: 2px solid #c06c84; border-radius: 8px;" 
                               id="address" name="address">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="sex_type" class="font-weight-bold" style="color: #355c7d;">Sexo</label>
                                <select class="form-control shadow-sm" 
                                        style="border: 2px solid #c06c84; border-radius: 8px;" 
                                        id="sex_type" name="sex_type" required>
                                    <option value="1">Masculino</option>
                                    <option value="0">Femenino</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="phone_number" class="font-weight-bold" style="color: #355c7d;">Teléfono</label>
                                <input type="number" class="form-control shadow-sm" 
                                       style="border: 2px solid #c06c84; border-radius: 8px;" 
                                       id="phone_number" name="phone_number" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="attendance_date" class="font-weight-bold" style="color: #355c7d;">Fecha de Asistencia</label>
                        <input type="datetime-local" class="form-control shadow-sm" 
                               style="border: 2px solid #c06c84; border-radius: 8px;" 
                               id="attendance_date" name="attendance_date" required>
                    </div>

                    <div class="text-right">
                        <button type="button" class="btn btn-lg shadow-sm" 
                                style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;" 
                                id="savePerson">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                    </div>
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
    
    .modal-content {
        border-radius: 15px;
        border: none;
    }
    
    .modal-header {
        border-radius: 15px 15px 0 0;
    }
    
    .input-group-append button {
        transition: all 0.3s ease;
    }
    
    .input-group-append button:hover {
        filter: brightness(90%);
    }
</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>

<script>
    $(document).ready(function() {
        // Inicializar Select2
        $('.select2').select2({
            width: '100%',
            placeholder: 'Seleccione una opción',
            allowClear: true
        });

        // Manejar agregar persona
        $('#savePerson').on('click', function() {
            const formData = $('#addPersonForm').serialize();

            $.ajax({
                url: "{{ route('am_people.store') }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    const newOption = new Option(
                        response.given_name + ' ' + response.paternal_last_name, 
                        response.id, 
                        true, 
                        true
                    );
                    $('#am_person_id').append(newOption).trigger('change');
                    $('#addPersonModal').modal('hide');
                    $('#addPersonForm')[0].reset();
                    Swal.fire('Éxito', 'Persona agregada correctamente', 'success');
                },
                error: function(xhr) {
                    Swal.fire('Error', 'Verifique los datos ingresados', 'error');
                }
            });
        });
    });
</script>
@stop