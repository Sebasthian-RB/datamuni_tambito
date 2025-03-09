@extends('adminlte::page')

@section('title', 'Agregar Adulto Mayor')

@section('content_header')
<h1>Agregar Adulto Mayor</h1>
@stop

@section('content')
<div class="container">

    <!--  AQUÍ colocamos el código para mostrar los errores -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!--  FIN DEL CÓDIGO PARA MOSTRAR ERRORES -->

    <form action="{{ route('elderly_adults.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header" style="background-color: #708f3a; color: white;">
                <h3 class="card-title">Formulario para agregar adulto mayor</h3>
            </div>
            <div class="card-body">

                <!-- Tipo de Documento -->
                <div class="form-group">
                    <label for="document_type">Tipo de Documento</label>
                    <select class="form-control" id="document_type" name="document_type" required>
                        <option value="" disabled selected>Seleccione</option>
                        @foreach(['DNI', 'Pasaporte', 'Carnet', 'Cedula'] as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('document_type')
                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- ID -->
                <div class="form-group">
                    <label for="id">Número de Documento</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" required>
                    @error('id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    @error('id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nombres-->
                <div class="form-group">
                    <label for="given_name">Nombres</label>
                    <input type="text" class="form-control" id="given_name" name="given_name"
                        value="{{ old('given_name') }}" required>
                    @error('given_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Apellido Paterno -->
                <div class="form-group">
                    <label for="paternal_last_name">Apellido Paterno</label>
                    <input type="text" class="form-control" id="paternal_last_name" name="paternal_last_name"
                        value="{{ old('paternal_last_name') }}" required>
                    @error('paternal_last_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Apellido Materno -->
                <div class="form-group">
                    <label for="maternal_last_name">Apellido Materno</label>
                    <input type="text" class="form-control" id="maternal_last_name" name="maternal_last_name"
                        value="{{ old('maternal_last_name') }}" required>
                    @error('maternal_last_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fecha de Nacimiento -->
                <div class="form-group">
                    <label for="birth_date">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date"
                        value="{{ old('birth_date') }}" required>
                    @error('birth_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sexo -->
                <div class="form-group">
                    <label class="form-label fw-bold" style="font-size: 1.2rem;">Sexo</label>
                    <div class="d-flex justify-content-start align-items-center mt-3" style="gap: 20px;">
                        <!-- Masculino -->
                        <div class="form-check" style="border: 2px solid #6E8E59; border-radius: 10px; padding: 10px 15px; background-color: #CCE6FF; display: flex; align-items: center; gap: 15px; cursor: pointer;">
                            <input class="form-check-input" type="radio" name="sex_type" id="male" value="1"
                                style="margin-right: 10px;"
                                {{ old('sex_type') == '1' ? 'checked' : '' }} required>
                            <label class="form-check-label fw-bold d-flex align-items-center" for="male" style="color: #333; margin: 0; cursor: pointer;">
                                <i class="fas fa-mars" style="color: #6E8E59; font-size: 1.5rem; margin-right: 10px;"></i> Masculino
                            </label>
                        </div>

                        <!-- Femenino -->
                        <div class="form-check" style="border: 2px solid #780C28; border-radius: 10px; padding: 10px 15px; background-color: #FFE6E6; display: flex; align-items: center; gap: 15px; cursor: pointer;">
                            <input class="form-check-input" type="radio" name="sex_type" id="female" value="0"
                                style="margin-right: 10px;"
                                {{ old('sex_type') == '0' ? 'checked' : '' }} required>
                            <label class="form-check-label fw-bold d-flex align-items-center" for="female" style="color: #333; margin: 0; cursor: pointer;">
                                <i class="fas fa-venus" style="color: #780C28; font-size: 1.5rem; margin-right: 10px;"></i> Femenino
                            </label>
                        </div>
                    </div>
                    @error('sex_type')
                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Idioma(s) -->
                <div class="form-group">
                    <label>Idioma(s)</label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="language[]" id="language_es" value="Español"
                                {{ in_array('Español', old('language', $elderlyAdult->language ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="language_es">Español</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="language[]" id="language_qu" value="Quechua"
                                {{ in_array('Quechua', old('language', $elderlyAdult->language ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="language_qu">Quechua</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="language[]" id="language_ay" value="Aimara"
                                {{ in_array('Aimara', old('language', $elderlyAdult->language ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="language_ay">Aimara</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="language[]" id="language_otro" value="Otro"
                                {{ in_array('Otro', old('language', $elderlyAdult->language ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="language_otro">Otro</label>
                        </div>
                    </div>
                </div>

                <!-- Teléfono -->
                <div class="form-group">
                    <label for="phone_number">Teléfono</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                        id="phone_number" name="phone_number"
                        value="{{ old('phone_number', $elderlyAdult->phone_number ?? '') }}"
                        maxlength="9" placeholder="Ingrese 9 dígitos">
                    @error('phone_number')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Dirección -->
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                        value="{{ old('address') }}" required maxlength="255">
                    @error('address')
                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Referencia -->
                <div class="form-group">
                    <label for="reference">Referencia</label>
                    <input type="text" class="form-control @error('reference') is-invalid @enderror" id="reference" name="reference"
                        value="{{ old('reference') }}" maxlength="255">
                    @error('reference')
                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Número de miembros del hogar -->
                <div class="form-group">
                    <label for="household_members">Número de Miembros en el Hogar</label>
                    <input type="number" class="form-control @error('household_members') is-invalid @enderror"
                        id="household_members" name="household_members"
                        value="{{ old('household_members') }}"
                        min="1"
                        max="20">
                    @error('household_members')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo para seleccionar el guardián con Select2 -->
                <div class="form-group">
                    <label for="guardian_id" style="font-weight: bold;">Seleccionar Guardián</label>
                    <select id="guardian_id" name="guardian_id" class="form-control select2" style="width: 100%; text-align-last: center;">
                        <option value="" disabled selected>Seleccione un guardián...</option>
                        @foreach($guardians as $guardian)
                        <option value="{{ $guardian->id }}">
                            {{ $guardian->given_name }} {{ $guardian->paternal_last_name }} {{ $guardian->maternal_last_name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipo de Discapacidad -->
                <div class="form-group">
                    <label for="type_of_disability">Tipo de Discapacidad</label>
                    <select class="form-control" name="type_of_disability">
                        <option value="">Ninguna</option>
                        <option value="Visual">Visual</option>
                        <option value="Motriz">Motriz</option>
                        <option value="Mental">Mental</option>
                    </select>
                </div>

                <!-- Atención Permanente -->
                <div class="form-group">
                    <label for="permanent_attention" class="form-label fw-bold" style="font-size: 1.2rem;">Requiere Atención Permanente</label>
                    <div class="d-flex align-items-center mt-3">
                        <div class="form-check" style="border: 2px solid #6E8E59; border-radius: 10px; padding: 10px 15px; background-color: #FFEECC;">
                            <input class="form-check-input" type="checkbox" name="permanent_attention" id="permanent_attention" value="1" style="transform: scale(1.5); margin-right: 10px;">
                            <label class="form-check-label fw-bold" for="permanent_attention" style="color: #333;">
                                <i class="fas fa-question-circle" style="margin-right: 5px; color: #FFA500;"></i> Atención Permanente
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Seguro Público -->
                <div class="form-group">
                    <label for="public_insurance">Seguro Público</label>
                    <select class="form-control" name="public_insurance">
                        <option value="">Sin seguro</option>
                        <option value="SIS">SIS</option>
                        <option value="ESSALUD">ESSALUD</option>
                    </select>
                </div>

                <!-- Seguro Privado -->
                <div class="form-group">
                    <label for="private_insurance">Seguro Privado</label>
                    <input type="text" class="form-control" name="private_insurance">
                </div>

                <!-- Programas Sociales -->
                <div class="form-group">
                    <label>Programas Sociales</label>
                    @foreach(['Pensión 65', 'Qali Warma', 'FOCAM'] as $program)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="social_program[]" id="program_{{ $loop->index }}" value="{{ $program }}">
                        <label class="form-check-label" for="program_{{ $loop->index }}">{{ $program }}</label>
                    </div>
                    @endforeach
                </div>

                <!-- Estado -->
                <div class="form-group">
                    <label class="form-label fw-bold" style="font-size: 1.2rem;">Estado</label>
                    <div class="d-flex justify-content-start align-items-center mt-3" style="gap: 20px;">
                        <!-- Botón Activo -->
                        <div class="form-check" style="border: 2px solid #6E8E59; border-radius: 10px; padding: 10px 15px; background-color: #E6FFCC;">
                            <input class="form-check-input" type="radio" name="state" id="state_active" value="1" style="transform: scale(1.5); margin-right: 10px;" required>
                            <label class="form-check-label fw-bold d-flex align-items-center" for="state_active" style="color: #333;">
                                <i class="fas fa-smile" style="color: #6E8E59; font-size: 1.5rem; margin-right: 10px;"></i> Activo
                            </label>
                        </div>

                        <!-- Botón Inactivo -->
                        <div class="form-check" style="border: 2px solid #780C28; border-radius: 10px; padding: 10px 15px; background-color: #FFCCCC;">
                            <input class="form-check-input" type="radio" name="state" id="state_inactive" value="0" style="transform: scale(1.5); margin-right: 10px;" required>
                            <label class="form-check-label fw-bold d-flex align-items-center" for="state_inactive" style="color: #333;">
                                <i class="fas fa-frown" style="color: #780C28; font-size: 1.5rem; margin-right: 10px;"></i> Inactivo
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="form-group">
                    <label for="observation">Observaciones</label>
                    <textarea class="form-control" name="observation"></textarea>
                </div>


            </div>

            <div class="card-footer">
                <button type="submit" class="btn" style="background-color: #708f3a; color: white;">Guardar</button>
                <a href="{{ route('elderly_adults.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop


<!-- JAVA SECTION-->

@section('js')

<!-- Select2 JS -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- PARA EL TIPO DE DOCUMENTOS Y ID'S -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const documentTypeSelect = document.getElementById('document_type');
        const documentInput = document.getElementById('id');

        documentTypeSelect.addEventListener('change', function() {
            const selectedType = this.value;

            // Resetea restricciones
            documentInput.value = '';
            documentInput.removeAttribute('maxlength');
            documentInput.removeAttribute('pattern');

            if (selectedType === 'DNI') {
                documentInput.setAttribute('maxlength', '8');
                documentInput.setAttribute('pattern', '\\d{8}');
                documentInput.setAttribute('placeholder', 'Ingrese 8 dígitos');
                documentInput.title = 'Debe tener 8 dígitos numéricos.';
                documentInput.dataset.type = 'numeric';
            } else if (selectedType === 'Pasaporte') {
                documentInput.setAttribute('maxlength', '9');
                documentInput.setAttribute('pattern', '[A-Za-z0-9]{9}');
                documentInput.setAttribute('placeholder', 'Ingrese 9 caracteres alfanuméricos');
                documentInput.title = 'Debe tener 9 caracteres alfanuméricos.';
                documentInput.dataset.type = 'alphanumeric';
            } else if (selectedType === 'Carnet') {
                documentInput.setAttribute('maxlength', '12');
                documentInput.setAttribute('pattern', '\\d{12}');
                documentInput.setAttribute('placeholder', 'Ingrese 12 dígitos numéricos');
                documentInput.title = 'Debe tener 12 dígitos numéricos.';
                documentInput.dataset.type = 'numeric';
            } else if (selectedType === 'Cedula') {
                documentInput.setAttribute('maxlength', '10');
                documentInput.setAttribute('pattern', '\\d{10}');
                documentInput.setAttribute('placeholder', 'Ingrese 10 dígitos numéricos');
                documentInput.title = 'Debe tener 10 dígitos numéricos.';
                documentInput.dataset.type = 'numeric';
            }
        });

        // Validación en tiempo real del contenido del campo
        documentInput.addEventListener('input', function() {
            const type = documentInput.dataset.type;
            if (type === 'numeric') {
                // Permitir solo números
                this.value = this.value.replace(/[^0-9]/g, '');
            } else if (type === 'alphanumeric') {
                // Permitir solo caracteres alfanuméricos
                this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
            }
        });
    });
</script>

<!--  PARA LOS NOMBRES-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let nameInputs = ['given_name', 'paternal_last_name', 'maternal_last_name'];

        nameInputs.forEach(function(inputId) {
            let input = document.getElementById(inputId);
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
            });
        });
    });
</script>


<!-- PARA GUARDIAN -->
<script>
    $(document).ready(function() {
        $('#guardian_id').select2({
            placeholder: "Seleccione un guardián",
            allowClear: true,
            width: 'resolve'
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#guardian_id').select2({
            placeholder: "Seleccione un guardián",
            allowClear: true,
            width: 'resolve',
            templateResult: formatGuardian, // Formato para las opciones
            templateSelection: formatGuardianSelection // Formato para la selección
        });

        function formatGuardian(guardian) {
            if (!guardian.id) {
                return guardian.text; // Muestra la opción por defecto
            }

            // Personaliza las opciones con íconos o diseño
            var html = `<div class="d-flex align-items-center">
                            <i class="fas fa-user" style="color: #6E8E59; margin-right: 8px;"></i>
                            ${guardian.text}
                        </div>`;
            return $(html);
        }

        function formatGuardianSelection(guardian) {
            return guardian.text; // Texto seleccionado
        }
    });
</script>

<!-- PARA EL TELEFONO -->
<script>
    document.getElementById("phone_number").addEventListener("input", function(e) {
        // Eliminar caracteres que no sean números
        e.target.value = e.target.value.replace(/\D/g, '');

        // Limitar a 9 caracteres
        if (e.target.value.length > 9) {
            e.target.value = e.target.value.slice(0, 9);
        }
    });
</script>

<!-- PARA MIEMBROS DEL hogar  -->
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        var householdMembers = document.getElementById('household_members').value;
        var numMembers = parseInt(householdMembers, 2);

        if (numMembers > 20) {
            alert('Error: Solo puedes ingresar hasta 20 miembros del hogar.');
            event.preventDefault(); // Evita que el formulario se envíe
        }
    });
</script>

@stop


<!-- CSS SECTION-->

@section('css')

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    .select2-container--default .select2-selection--single {
        height: 38px;
        /* Ajustar la altura */
        border-radius: 5px;
        /* Bordes redondeados */
        border: 1px solid #6E8E59;
        /* Color del borde */
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #6E8E59;
        /* Color del texto */
        font-weight: bold;
        /* Negrita */
        padding: 8px;
        /* Espaciado interno */
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 6px;
        /* Centrar la flecha */
        color: #6E8E59;
        /* Color de la flecha */
    }

    .select2-results__option {
        color: black;
        /* Color de las opciones */
    }

    .select2-results__option--highlighted {
        background-color: #CAE0BC;
        /* Color de fondo al pasar el mouse */
        color: black;
        /* Color del texto al resaltar */
    }
</style>

<!-- Estilos adicionales -->
<style>
    .select2-container--default .select2-selection--single {
        height: 45px;
        /* Altura del select */
        display: flex;
        /* Para centrar el contenido */
        align-items: center;
        /* Centrar verticalmente */

        border: 2px solid #d9d9d9;
        /* Bordes */
        border-radius: 5px;
        /* Bordes redondeados */
        background-color: #fff;
        /* Fondo blanco */
        font-size: 16px;
        /* Tamaño de texto */
        color: #333;
        /* Color del texto */
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100%;
        /* Flecha centrada */
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<style>
    /* Personalización de los radios con casillas */
    .form-check-input {
        width: 20px;
        height: 20px;
        border: 2px solid #333;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #333;
        border-color: #333;
    }

    .form-check {
        transition: all 0.2s ease-in-out;
    }

    .form-check:hover {
        transform: scale(1.05);
    }
</style>

@stop