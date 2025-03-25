@extends('adminlte::page')

@section('title', 'Nueva Asistencia')

@section('content_header')
    <!-- Imagen superior -->
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #c06c84; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
        <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
            <h3 class="card-title mb-0">Registrar Nueva Asistencia</h3>
        </div>

        <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('am_person_events.store') }}" method="POST">
                @csrf

                <div class="form-group mb-4">
                    <label for="am_person_id" class="font-weight-bold" style="color: #355c7d;">Persona</label>
                    <div class="d-flex">
                        <select name="am_person_id" id="am_person_id" class="form-control select2" required>
                            <option value="">Seleccione una persona</option>
                            @foreach ($people as $person)
                                <option value="{{ $person->id }}">{{ $person->given_name }}
                                    {{ $person->paternal_last_name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-primary"
                            style="background: #f67280; border-color: #f67280; border-radius: 0 8px 8px 0;"
                            data-toggle="modal" data-target="#addPersonModal">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="event_id" class="font-weight-bold" style="color: #355c7d;">Evento</label>
                    <select name="event_id" id="event_id" class="form-control select2" required>
                        <option value="">Seleccione un evento</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="status" class="font-weight-bold" style="color: #355c7d;">Estado</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Seleccione un estado</option>
                        <option value="Asistió">Asistió</option>
                        <option value="No Asistió">No Asistió</option>
                        <option value="Justificado">Justificado</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="attendance_datetime" class="font-weight-bold" style="color: #355c7d;">Fecha y Hora</label>
                    <input type="datetime-local" name="attendance_datetime" id="attendance_datetime" class="form-control"
                        required value="{{ old('attendance_datetime') }}">
                </div>

                <!-- Botones de Acción -->
                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-lg shadow-sm"
                        style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    <a href="{{ route('am_person_events.index') }}" class="btn btn-lg btn-secondary shadow-sm"
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
                                    <select class="form-control" id="identity_document" name="identity_document" required>
                                        <option value="DNI">DNI</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                        <option value="Carnet">Carnet</option>
                                        <option value="Cedula">Cedula</option>
                                    </select>
                                    <span class="text-danger error-text identity_document_error"></span>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="given_name" class="font-weight-bold"
                                        style="color: #355c7d;">Nombre</label>
                                    <input type="text" class="form-control" id="given_name" name="given_name"
                                        required>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <style>
        /* Ajustes visuales del modal */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Colores del header */
        .modal-header {
            background: #355c7d;
            color: white;
            border-radius: 15px 15px 0 0;
        }

        /* Bordes redondeados y colores del input */
        .form-control {
            border: 2px solid #c06c84;
            border-radius: 8px;
        }

        /* Estilo de los select */
        .select2-container--default .select2-selection--single {
            border-radius: 8px !important;
            border: 2px solid #c06c84 !important;
            height: calc(1.5em + 1rem + 2px) !important;
        }

        /* Efecto en el input cuando se selecciona */
        .form-control:focus {
            border-color: #9ebbff !important;
            box-shadow: 0 0 0 0.2rem rgba(192, 221, 246, 0.25) !important;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Función para obtener la fecha/hora actual en GMT-5
            function getCurrentGMT5DateTime() {
                const now = new Date();
                // Ajustar a GMT-5 (5 horas de diferencia)
                const offset = 5 * 60 * 60 * 1000; // 5 horas en milisegundos
                const gmt5Time = new Date(now.getTime() - offset);

                // Formatear a YYYY-MM-DDTHH:mm (formato de datetime-local)
                return gmt5Time.toISOString().slice(0, 16);
            }
            document.getElementById('attendance_datetime').value = getCurrentGMT5DateTime();

            // Cuando se abre el modal
            $('#addPersonModal').on('shown.bs.modal', function() {
                // Establecer la fecha/hora actual en GMT-5
                document.getElementById('attendance_date').value = getCurrentGMT5DateTime();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: 'Seleccione una opción',
                allowClear: true
            });

            function validateField(field, errorMessage) {
                let value = $('#' + field).val().trim();
                if (value === '') {
                    $('#' + field).addClass('is-invalid');
                    $('.' + field + '_error').text(errorMessage);
                    return false;
                } else {
                    $('#' + field).removeClass('is-invalid').addClass('is-valid');
                    $('.' + field + '_error').text('');
                    return true;
                }
            }

            // Validación en tiempo real
            $('#id, #given_name, #paternal_last_name, #maternal_last_name, #address, #phone_number').on('input',
                function() {
                    validateField($(this).attr('id'), 'Este campo es obligatorio');
                });

            $('#identity_document, #sex_type').on('change', function() {
                validateField($(this).attr('id'), 'Debe seleccionar una opción');
            });

            // ✅ Si el usuario modifica el ID después de un error, habilitar el botón de guardar
            $('#id').on('input', function() {
                $('#savePerson').prop('disabled', false).html('<i class="fas fa-save"></i> Guardar');
            });

            $('#savePerson').on('click', function() {
                let isValid = true;

                // Validar todos los campos antes de enviar
                isValid &= validateField('id', 'Número de documento es obligatorio');
                isValid &= validateField('identity_document', 'Debe seleccionar un tipo de documento');
                isValid &= validateField('given_name', 'Nombre es obligatorio');
                isValid &= validateField('paternal_last_name', 'Apellido paterno es obligatorio');
                isValid &= validateField('maternal_last_name', 'Apellido materno es obligatorio');
                isValid &= validateField('address', 'Dirección es obligatoria');
                isValid &= validateField('sex_type', 'Debe seleccionar un género');
                isValid &= validateField('phone_number', 'Número de teléfono es obligatorio');
                isValid &= validateField('attendance_date', 'Debe seleccionar una fecha');

                if (!isValid) {
                    Swal.fire('Error', 'Corrige los campos en rojo antes de continuar', 'error');
                    return;
                }

                // Evitar múltiples envíos
                $('#savePerson').prop('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin"></i> Guardando...');

                // Enviar datos por AJAX
                $.ajax({
                    url: "{{ route('am_people.store') }}",
                    method: "POST",
                    data: $('#addPersonForm').serialize(),
                    success: function(response) {
                        if (response.success) {
                            // Agregar opción al select2
                            const newOption = new Option(
                                response.given_name + ' ' + response.paternal_last_name,
                                response.id,
                                true,
                                true
                            );
                            $('#am_person_id').append(newOption).trigger('change');

                            // Cerrar el modal y limpiar formulario
                            $('#addPersonModal').modal('hide');
                            $('#addPersonForm')[0].reset();

                            Swal.fire('Éxito', 'Persona agregada correctamente', 'success');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            // Mostrar errores en los campos correspondientes
                            $.each(errors, function(field, messages) {
                                $('#' + field).addClass(
                                    'is-invalid'); // Resaltar el campo en rojo
                                $('.' + field + '_error').text(messages[
                                    0]); // Mostrar el mensaje de error
                            });

                            Swal.fire('Error', 'Corrige los errores antes de continuar',
                                'error');

                            // ✅ Habilitar el botón después de un error
                            $('#savePerson').prop('disabled', false).html(
                                '<i class="fas fa-save"></i> Guardar');
                        } else {
                            Swal.fire('Error',
                                'Hubo un problema, verifica los datos ingresados', 'error');

                            // ✅ También habilitar el botón si hay otro tipo de error
                            $('#savePerson').prop('disabled', false).html(
                                '<i class="fas fa-save"></i> Guardar');
                        }
                    },
                    complete: function() {
                        // Asegurar que el botón se habilita si hay errores
                        $('#savePerson').prop('disabled', false).html(
                            '<i class="fas fa-save"></i> Guardar');
                    }
                });
            });
        });
    </script>
    <!-- Validadciones para persona -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const docType = document.getElementById('identity_document');
            const docNumber = document.getElementById('id');
            const errorSpan = document.querySelector('.id_error');

            // Configurar validación inicial
            setValidationRules(docType.value);

            docType.addEventListener('change', function() {
                setValidationRules(this.value);
                docNumber.value = '';
                validateDocument();
                docNumber.focus(); // Mejorar UX en modales
            });

            docNumber.addEventListener('input', function(e) {
                this.value = sanitizeInput(this.value, docType.value);
                validateDocument();
            });

            function sanitizeInput(value, type) {
                switch (type) {
                    case 'DNI':
                    case 'Cedula':
                    case 'Carnet':
                        return value.replace(/\D/g, ''); // Solo números
                    case 'Pasaporte':
                        return value.replace(/[^A-Za-z0-9]/g, ''); // Alfanumérico
                    default:
                        return value;
                }
            }

            function setValidationRules(type) {
                docNumber.classList.remove('is-invalid');
                errorSpan.textContent = '';

                switch (type) {
                    case 'DNI':
                    case 'Cedula':
                        docNumber.maxLength = 8;
                        docNumber.pattern = '^[0-9]{8}$';
                        docNumber.placeholder = 'Ingrese 8 dígitos';
                        docNumber.inputMode = 'numeric';
                        break;
                    case 'Pasaporte':
                        docNumber.maxLength = 12;
                        docNumber.pattern = '^[A-Za-z0-9]{6,12}$';
                        docNumber.placeholder = 'Mínimo 6 caracteres alfanuméricos';
                        docNumber.inputMode = 'text';
                        break;
                    case 'Carnet':
                        docNumber.maxLength = 10;
                        docNumber.pattern = '^[0-9]{6,10}$';
                        docNumber.placeholder = 'Entre 6 y 10 dígitos';
                        docNumber.inputMode = 'numeric';
                        break;
                }
            }

            function validateDocument() {
                const value = docNumber.value.trim();
                errorSpan.textContent = '';
                let isValid = true;

                if (!value) {
                    errorSpan.textContent = 'Este campo es obligatorio';
                    docNumber.classList.add('is-invalid');
                    return false;
                }

                switch (docType.value) {
                    case 'DNI':
                    case 'Cedula':
                        isValid = /^[0-9]{8}$/.test(value);
                        errorSpan.textContent = isValid ? '' : 'Debe contener 8 dígitos exactos';
                        break;
                    case 'Pasaporte':
                        isValid = /^[A-Za-z0-9]{6,12}$/.test(value);
                        errorSpan.textContent = isValid ? '' : 'Entre 6-12 caracteres alfanuméricos';
                        break;
                    case 'Carnet':
                        isValid = /^[0-9]{6,10}$/.test(value);
                        errorSpan.textContent = isValid ? '' : 'Entre 6-10 dígitos numéricos';
                        break;
                }

                docNumber.classList.toggle('is-invalid', !isValid);
                return isValid;
            }
            
            // Manejar submit del formulario en Laravel
            document.querySelector('form').addEventListener('submit', function(e) {
                if (!validateDocument()) {
                    e.preventDefault();
                    // Enfocar el campo en modales
                    const invalidField = document.querySelector('.is-invalid');
                    if (invalidField) {
                        invalidField.focus();
                        if (invalidField.scrollIntoView) {
                            invalidField.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }
                    }
                }
            });

            // Reiniciar validación al abrir el modal (si usas Bootstrap)
            $('#yourModalId').on('shown.bs.modal', function() {
                docNumber.value = '';
                setValidationRules(docType.value);
                docNumber.classList.remove('is-invalid');
                errorSpan.textContent = '';
            });
        });
    </script>
@stop
