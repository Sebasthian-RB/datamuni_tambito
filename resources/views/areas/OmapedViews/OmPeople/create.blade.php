@extends('adminlte::page')

@section('title', 'Registrar Persona')

@section('content_header')
    <h1>Registrar Nueva Persona</h1>
@stop

@section('content')

    <form action="{{ route('om-people.store') }}" method="POST">
        @csrf
        <label for="paternal_last_name">Fecha de Registro</label>
        <input type="datetime-local" class="form-control @error('registration_date') is-invalid @enderror"
            name="registration_date"
            value="{{ old('registration_date') ? \Carbon\Carbon::parse(old('registration_date'))->format('Y-m-d\TH:i') : '' }}"
            required>

        @error('registration_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="paternal_last_name">Apellido Paterno</label>
            <input type="text" class="form-control @error('paternal_last_name') is-invalid @enderror"
                name="paternal_last_name" value="{{ old('paternal_last_name') }}" required>
            @error('paternal_last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="maternal_last_name">Apellido Materno</label>
            <input type="text" class="form-control @error('maternal_last_name') is-invalid @enderror"
                name="maternal_last_name" value="{{ old('maternal_last_name') }}" required>
            @error('maternal_last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="given_name">Nombres</label>
            <input type="text" class="form-control @error('given_name') is-invalid @enderror" name="given_name"
                value="{{ old('given_name') }}" required>
            @error('given_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="marital_status">Estado Civil</label>
            <select class="form-control @error('marital_status') is-invalid @enderror" name="marital_status" required>
                <option value="Soltero">Soltero</option>
                <option value="Casado">Casado</option>
                <option value="Divorciado">Divorciado</option>
                <option value="Viudo">Viudo</option>
                <option value="Unión libre">Unión libre</option>
            </select>
            @error('marital_status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control @error('dni') is-invalid @enderror" name="dni"
                value="{{ old('dni') }}" required pattern="[0-9]{8}" title="El DNI debe tener exactamente 8 dígitos"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="8">
            @error('dni')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="birth_date">Fecha de Nacimiento</label>
            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                id="birth_date" value="{{ old('birth_date') }}" required onchange="calcularEdad()">
            @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="age">Edad</label>
            <input type="number" class="form-control @error('age') is-invalid @enderror" name="age" id="age"
                value="{{ old('age') }}" required min="0" readonly>
            @error('age')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="gender">Género</label>
            <select class="form-control" name="gender" required>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                value="{{ old('phone') }}" pattern="[0-9]+" title="Solo se permiten números"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="education_level">Nivel Educativo</label>
            <select class="form-control @error('education_level') is-invalid @enderror" name="education_level">
                <option value="">Seleccione un nivel educativo</option>
                <option value="Primaria" {{ old('education_level') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                <option value="Secundaria" {{ old('education_level') == 'Secundaria' ? 'selected' : '' }}>Secundaria
                </option>
                <option value="Técnico" {{ old('education_level') == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                <option value="Universitario" {{ old('education_level') == 'Universitario' ? 'selected' : '' }}>
                    Universitario</option>
                <option value="Postgrado" {{ old('education_level') == 'Postgrado' ? 'selected' : '' }}>Postgrado</option>
                <option value="Sin Estudios" {{ old('education_level') == 'Sin Estudios' ? 'selected' : '' }}>Sin Estudios
                </option>
            </select>
            @error('education_level')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="occupation">Ocupación</label>
            <input type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation"
                value="{{ old('occupation') }}">
            @error('occupation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="health_insurance">Seguro de Salud</label>
            <select class="form-control @error('health_insurance') is-invalid @enderror" name="health_insurance">
                <option value="SIS">SIS</option>
                <option value="EsSalud">EsSalud</option>
                <option value="Seguro Privado">Seguro Privado</option>
                <option value="Ninguno">Ninguno</option>
            </select>
            @error('health_insurance')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="sisfoh">SISFOH</label>
            <select class="form-control @error('sisfoh') is-invalid @enderror" name="sisfoh">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
            @error('sisfoh')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="employment_status">Estado Laboral</label>
            <select class="form-control @error('employment_status') is-invalid @enderror" name="employment_status">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
                <option value="Pensionista">Pensionista</option>
            </select>
            @error('employment_status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="pension_status">Estado de Pensión</label>
            <select class="form-control @error('pension_status') is-invalid @enderror" name="pension_status">
                <option value="Pensionado">Pensionado</option>
                <option value="No Pensionado">No Pensionado</option>
            </select>
            @error('pension_status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Añade esto en la sección del dropdown de viviendas -->
        <div class="form-group">
            <label for="om_dwelling_id">Vivienda</label>
            <div class="input-group">
                <select class="form-control @error('om_dwelling_id') is-invalid @enderror" name="om_dwelling_id"
                    id="om_dwelling_id" required>
                    <option value="">Seleccione Vivienda</option>
                    @foreach ($dwellings as $dwelling)
                        <option value="{{ $dwelling->id }}"
                            {{ old('om_dwelling_id') == $dwelling->id ? 'selected' : '' }}>
                            {{ $dwelling->exact_location }}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dwellingModal">
                        <i class="fas fa-plus"></i> Nueva Vivienda
                    </button>
                </div>
            </div>
            @error('om_dwelling_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="disability_id">Discapacidad</label>
            <select class="form-control select2 @error('disability_id') is-invalid @enderror" name="disability_id"
                id="disability_id" data-placeholder="Seleccione Discapacidad">
                <option value=""></option>
                @foreach ($disabilities as $disability)
                    <option value="{{ $disability->id }}"
                        {{ old('disability_id') == $disability->id ? 'selected' : '' }}>
                        {{ $disability->certificate_number }}
                    </option>
                @endforeach
            </select>
            <!-- Botón para abrir el modal de discapacidad -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#disabilityModal">
                <i class="fas fa-plus"></i> Nueva Discapacidad
            </button>
            @error('disability_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="caregiver_id">Cuidador</label>
            <select class="form-control @error('caregiver_id') is-invalid @enderror" name="caregiver_id">
                <option value="">Seleccione Cuidador</option>
                @foreach ($caregivers as $caregiver)
                    <option value="{{ $caregiver->id }}" {{ old('caregiver_id') == $caregiver->id ? 'selected' : '' }}>
                        {{ $caregiver->full_name }}
                    </option>
                @endforeach
            </select>
            @error('caregiver_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="personal_assistance_need">Necesidad de Asistencia Personal</label>
            <textarea class="form-control @error('personal_assistance_need') is-invalid @enderror"
                name="personal_assistance_need">{{ old('personal_assistance_need') }}</textarea>
            @error('personal_assistance_need')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="autonomy_notes">Notas sobre Autonomía</label>
            <textarea class="form-control @error('autonomy_notes') is-invalid @enderror" name="autonomy_notes">{{ old('autonomy_notes') }}</textarea>
            @error('autonomy_notes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="observations">Observaciones</label>
            <textarea class="form-control @error('observations') is-invalid @enderror" name="observations">{{ old('observations') }}</textarea>
            @error('observations')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Registrar Persona</button>
        <a href="{{ route('om-people.index') }}" class="btn btn-secondary">Volver al listado</a>
    </form>


    <!-- Modal para nueva vivienda -->
    <div class="modal fade" id="dwellingModal" tabindex="-1" role="dialog" aria-labelledby="dwellingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dwellingModalLabel">Registrar Nueva Vivienda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dwellingForm">
                        @csrf
                        <div class="form-group">
                            <label for="exact_location">Localización Exacta</label>
                            <input type="text" name="exact_location" class="form-control" required>
                            <span class="error-message text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="reference">Referencia</label>
                            <textarea name="reference" class="form-control"></textarea>
                            <span class="error-message text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="annex_sector">Anexo/Sector</label>
                            <input type="text" name="annex_sector" class="form-control">
                            <span class="error-message text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="water_electricity">Agua y/o Luz</label>
                            <select name="water_electricity" class="form-control">
                                <option value="">Seleccione</option>
                                <option value="Agua">Agua</option>
                                <option value="Luz">Luz</option>
                                <option value="Agua y Luz">Agua y Luz</option>
                                <option value="Ninguno">Ninguno</option>
                            </select>
                            <span class="error-message text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="type">Tipo de Vivienda</label>
                            <input type="text" name="type" class="form-control">
                            <span class="error-message text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="ownership_status">Situación de Vivienda</label>
                            <select name="ownership_status" class="form-control">
                                <option value="">Seleccione</option>
                                <option value="Propia">Propia</option>
                                <option value="Alquilada">Alquilada</option>
                                <option value="Prestada">Prestada</option>
                            </select>
                            <span class="error-message text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="permanent_occupants">Ocupantes Permanentes</label>
                            <input type="number" name="permanent_occupants" class="form-control">
                            <span class="error-message text-danger"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="saveDwelling">Guardar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal para discapacidad -->
    <div class="modal fade" id="disabilityModal" tabindex="-1" role="dialog" aria-labelledby="disabilityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="disabilityModalLabel">Registrar Discapacidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="disabilityForm">
                        @csrf
                        <div class="form-group">
                            <label>N° Certificado</label>
                            <input type="text" name="certificate_number" class="form-control" required>
                            <span class="text-danger error-certificate_number"></span> <!-- Aquí se mostrará el error -->
                        </div>

                        <div class="form-group">
                            <label>Fecha de Emisión</label>
                            <input type="date" name="certificate_issue_date" class="form-control" required>
                            <span class="text-danger error-certificate_issue_date"></span>
                        </div>

                        <div class="form-group">
                            <label>Fecha de Caducidad</label>
                            <input type="date" name="certificate_expiry_date" class="form-control">
                            <span class="text-danger error-certificate_expiry_date"></span>
                        </div>

                        <div class="form-group">
                            <label>Organización</label>
                            <input type="text" name="organization_name" class="form-control" required>
                            <span class="text-danger error-organization_name"></span>
                        </div>

                        <div class="form-group">
                            <label>Diagnóstico</label>
                            <input type="text" name="diagnosis" class="form-control" required>
                            <span class="text-danger error-diagnosis"></span>
                        </div>

                        <div class="form-group">
                            <label>Tipo de Discapacidad</label>
                            <input type="text" name="disability_type" class="form-control" required>
                            <span class="text-danger error-disability_type"></span>
                        </div>

                        <div class="form-group">
                            <label>Nivel de Gravedad</label>
                            <select name="severity_level" class="form-control">
                                <option value="Leve">Leve</option>
                                <option value="Moderado">Moderado</option>
                                <option value="Severo">Severo</option>
                            </select>
                            <span class="text-danger error-severity_level"></span>
                        </div>

                        <div class="form-group">
                            <label>Dispositivos Necesarios</label>
                            <textarea name="required_support_devices" class="form-control"></textarea>
                            <span class="text-danger error-required_support_devices"></span>
                        </div>

                        <div class="form-group">
                            <label>Dispositivos Usados</label>
                            <textarea name="used_support_devices" class="form-control"></textarea>
                            <span class="text-danger error-used_support_devices"></span>
                        </div>

                        <button type="button" id="saveDisability" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };
    </script>
    <!-- Calcular Edad -->
    <script>
        function calcularEdad() {
            let birthDate = document.getElementById("birth_date").value;
            if (birthDate) {
                let today = new Date();
                let birth = new Date(birthDate);
                let age = today.getFullYear() - birth.getFullYear();
                let monthDiff = today.getMonth() - birth.getMonth();
                let dayDiff = today.getDate() - birth.getDate();

                // Ajuste si el cumpleaños no ha pasado aún este año
                if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                    age--;
                }

                document.getElementById("age").value = age > 0 ? age : 0;
            }
        }
    </script>

    <!-- Ajax del modal de vivienda -->
    <script>
        $(document).ready(function() {
            $('#saveDwelling').click(function() {
                $.ajax({
                    url: '{{ route('om-dwellings.store') }}',
                    method: 'POST',
                    data: $('#dwellingForm').serialize(),
                    dataType: 'json', // Añadir esta línea
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    beforeSend: function() {
                        $('#saveDwelling').prop('disabled', true).html(
                            '<i class="fas fa-spinner fa-spin"></i> Guardando...');
                    },
                    success: function(response) {
                        // Añadir nueva opción al select y seleccionarla
                        var newOption = new Option(response.dwelling.exact_location, response
                            .dwelling.id, true, true);
                        $('#om_dwelling_id').append(newOption).trigger('change');

                        // Cerrar modal y limpiar formulario
                        $('#dwellingModal').modal('hide');
                        $('#dwellingForm')[0].reset();

                        // Mostrar notificación
                        toastr.success('Vivienda registrada exitosamente');
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors || {};
                        let errorMessages = 'Error desconocido';

                        if (xhr.status === 422) {
                            errorMessages = Object.values(errors).join('\n');
                        }

                        toastr.error(errorMessages);
                    },
                    complete: function() {
                        $('#saveDwelling').prop('disabled', false).html('Guardar');
                        // Si aún queda un backdrop en el DOM, elimínalo
                        if ($('.modal-backdrop').length) {
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open');
                        }
                    }
                });
            });
        });
    </script>

    <!-- Ajax del modal de discapacidad -->

    <script>
        $(document).ready(function() {
            $('#saveDisability').click(function() {
                let formData = $('#disabilityForm').serialize();

                // Limpiar errores anteriores
                $('.text-danger').text('');

                $.ajax({
                    url: '{{ route('disabilities.store') }}',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    beforeSend: function() {
                        $('#saveDisability').prop('disabled', true).html(
                            '<i class="fas fa-spinner fa-spin"></i> Guardando...'
                        );
                    },
                    success: function(response) {
                        if (response.success && response.disability) {
                            // Crear y agregar la nueva opción al select
                            let newOption = new Option(
                                response.disability.certificate_number,
                                response.disability.id,
                                true, // selected
                                true // selected
                            );

                            // Agregar al select
                            $('#disability_id').append(newOption);

                            // Actualizar Select2 si está en uso
                            if ($('#disability_id').hasClass('select2-hidden-accessible')) {
                                $('#disability_id').trigger('change.select2');
                            }

                            // Cerrar modal y resetear formulario
                            $('#disabilityModal').modal('hide');
                            $('#disabilityForm')[0].reset();

                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Mostrar errores de validación
                            let errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(function(key) {
                                $('.error-' + key).text(errors[key][0]);
                            });
                        } else {
                            toastr.error('Error inesperado. Intente nuevamente.');
                        }
                    },
                    complete: function() {
                        $('#saveDisability').prop('disabled', false).html(
                            '<i class="fas fa-save"></i> Guardar'
                        );
                        // Limpiar backdrop si es necesario
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                    }
                });
            });
        });
    </script>
    <script>
        // En tu sección JS
        $(document).ready(function() {
            $('#disability_id').select2({
                placeholder: "Seleccione Discapacidad",
                allowClear: true
            });
        });
    </script>
@stop
