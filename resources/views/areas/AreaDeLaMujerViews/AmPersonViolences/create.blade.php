@extends('adminlte::page')

@section('title', 'Registrar Relación de Violencia')

@section('content_header')
    <h1>Registrar Casos de Personas</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title">Nuevo Caso</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('am_person_violences.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="am_person_id">Persona</label>
                <select name="am_person_id" id="am_person_id" class="form-control select2" required>
                    <option value="">Seleccione una persona</option>
                    @foreach($amPersons as $person)
                        <option value="{{ $person->id }}">{{ $person->given_name }} {{ $person->paternal_last_name }}</option>
                    @endforeach
                </select>
                <!-- Botón para abrir el modal -->
                <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#addPersonModal">
                    Agregar Persona
                </button>
            </div>
            
            <div class="form-group">
                <label for="violence_id">Tipo de Violencia</label>
                <select name="violence_id" id="violence_id" class="form-control" required>
                    <option value="">Seleccione un tipo de violencia</option>
                    @foreach($violences as $violence)
                        <option value="{{ $violence->id }}">{{ $violence->kind_violence }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="registration_date">Fecha de Registro</label>
                <input type="datetime-local" name="registration_date" id="registration_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('am_person_violences.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
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
@endsection
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height:36px; /* Ajusta la altura según tus necesidades */
            padding: 10px; /* Ajusta el espaciado interno */
            font-size: 16px; /* Ajusta el tamaño de texto si es necesario */
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 20px; /* Alinea el texto verticalmente */
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 20px; /* Alinea la flecha del desplegable */
        }
    </style>

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
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
    <script>
        $(document).ready(function() {
            // Inicializar Select2
            $('#am_person_id').select2({
                placeholder: "Seleccione una persona",
                allowClear: true,
                width: '100%' // Ajustar al ancho del contenedor
            });
        });
    </script>
@stop