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

        <form id="create-elderly-form" action="{{ route('elderly_adults.store') }}" method="POST">
            @csrf

            <div class="card">
                <div class="card-header" style="background-color: #708f3a; color: white;">
                    <h3 class="card-title">Formulario para agregar adulto mayor</h3>
                </div>
                <div class="card-body">

                    <!-- Tarjeta 1: Información Personal -->
                    <div class="card mb-4 border-success">
                        <div class="card-header" style="background-color: #708f3a; color: white;">
                            <h3 class="card-title">
                                <i class="fas fa-user-circle mr-2"></i> Información Personal
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-6">

                                    <!-- Tipo de Documento -->
                                    <div class="form-group">
                                        <label for="document_type">
                                            <i class="fas fa-file-alt mr-1 text-success"></i> Tipo de Documento
                                        </label>
                                        <select class="form-control" id="document_type" name="document_type" required>
                                            <option value="" disabled selected>Seleccione</option>
                                            @foreach (['DNI', 'Pasaporte', 'Carnet', 'Cedula'] as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        @error('document_type')
                                            <span class="text-danger d-block mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- ID -->
                                    <div class="form-group">
                                        <label for="id">
                                            <i class="fas fa-hashtag mr-1 text-success"></i> Número de Documento
                                        </label>
                                        <input type="text" class="form-control @error('id') is-invalid @enderror"
                                            id="id" name="id" required>
                                        @error('id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div id="id-error" class="alert alert-danger" style="display: none;"></div>
                                    </div>

                                    <!-- Nombres-->
                                    <div class="form-group">
                                        <label for="given_name">
                                            <i class="fas fa-signature mr-1 text-success"></i> Nombres
                                        </label>
                                        <input type="text" class="form-control" id="given_name" name="given_name"
                                            value="{{ old('given_name') }}" required>
                                        @error('given_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Columna Derecha -->
                                <div class="col-md-6">

                                    <!-- Apellido Paterno -->
                                    <div class="form-group">
                                        <label for="paternal_last_name">
                                            <i class="fas fa-signature mr-1 text-success"></i> Apellido Paterno
                                        </label>
                                        <input type="text" class="form-control" id="paternal_last_name"
                                            name="paternal_last_name" value="{{ old('paternal_last_name') }}" required>
                                        @error('paternal_last_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Apellido Materno -->
                                    <div class="form-group">
                                        <label for="maternal_last_name">
                                            <i class="fas fa-signature mr-1 text-success"></i> Apellido Materno
                                        </label>
                                        <input type="text" class="form-control" id="maternal_last_name"
                                            name="maternal_last_name" value="{{ old('maternal_last_name') }}" required>
                                        @error('maternal_last_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Fecha de Nacimiento -->
                                    <div class="form-group">
                                        <label for="birth_date">
                                            <i class="fas fa-birthday-cake mr-1 text-success"></i> Fecha de Nacimiento
                                        </label>
                                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                            id="birth_date" name="birth_date" value="{{ old('birth_date') }}"
                                            max="{{ now()->subYears(60)->format('Y-m-d') }}"
                                            min="{{ now()->subYears(125)->format('Y-m-d') }}" required>
                                        @error('birth_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Edad permitida: entre 60 y 125 años
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <!-- Campos de ancho completo (debajo de las columnas) -->

                            <!-- Sexo -->
                            <div class="form-group">
                                <label class="form-label fw-bold" style="font-size: 1.2rem;"><i
                                        class="fas fa-venus-mars mr-1 text-success"></i> Sexo
                                </label>
                                <div class="d-flex justify-content-start align-items-center mt-3" style="gap: 20px;">
                                    <!-- Masculino -->
                                    <div class="form-check"
                                        style="border: 2px solid #6E8E59; border-radius: 10px; padding: 10px 15px; background-color: #CCE6FF; display: flex; align-items: center; gap: 15px; cursor: pointer;">
                                        <input class="form-check-input" type="radio" name="sex_type" id="male"
                                            value="1" style="margin-right: 10px;"
                                            {{ old('sex_type') == '1' ? 'checked' : '' }} required>
                                        <label class="form-check-label fw-bold d-flex align-items-center" for="male"
                                            style="color: #333; margin: 0; cursor: pointer;">
                                            <i class="fas fa-mars"
                                                style="color: #6E8E59; font-size: 1.5rem; margin-right: 10px;"></i>
                                            Masculino
                                        </label>
                                    </div>

                                    <!-- Femenino -->
                                    <div class="form-check"
                                        style="border: 2px solid #780C28; border-radius: 10px; padding: 10px 15px; background-color: #FFE6E6; display: flex; align-items: center; gap: 15px; cursor: pointer;">
                                        <input class="form-check-input" type="radio" name="sex_type" id="female"
                                            value="0" style="margin-right: 10px;"
                                            {{ old('sex_type') == '0' ? 'checked' : '' }} required>
                                        <label class="form-check-label fw-bold d-flex align-items-center" for="female"
                                            style="color: #333; margin: 0; cursor: pointer;">
                                            <i class="fas fa-venus"
                                                style="color: #780C28; font-size: 1.5rem; margin-right: 10px;"></i>
                                            Femenino
                                        </label>
                                    </div>
                                </div>
                                @error('sex_type')
                                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Idioma(s) -->
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-language mr-1 text-success"></i> Idioma(s)
                                </label>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="language[]"
                                            id="language_es" value="Español"
                                            {{ in_array('Español', old('language', $elderlyAdult->language ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="language_es">Español</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="language[]"
                                            id="language_qu" value="Quechua"
                                            {{ in_array('Quechua', old('language', $elderlyAdult->language ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="language_qu">Quechua</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="language[]"
                                            id="language_ay" value="Aimara"
                                            {{ in_array('Aimara', old('language', $elderlyAdult->language ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="language_ay">Aimara</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="language[]"
                                            id="language_otro" value="Otro"
                                            {{ in_array('Otro', old('language', $elderlyAdult->language ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="language_otro">Otro</label>
                                    </div>
                                </div>
                                <!-- Mensaje de error (se mostrará con JavaScript) -->
                                <div id="language-error" class="alert alert-danger" style="display: none;">
                                    Debe seleccionar al menos un idioma.
                                </div>
                            </div>

                            <!-- Teléfono -->
                            <div class="form-group">
                                <label for="phone_number"><i class="fas fa-phone-alt mr-1 text-success"></i>
                                    Teléfono</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                                    maxlength="9" placeholder="Ingrese 9 dígitos" pattern="\d{9}"
                                    title="Debe contener exactamente 9 dígitos numéricos">
                                @error('phone_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted" id="phoneHelp">Ingrese exactamente 9 dígitos
                                    numéricos</small>
                            </div>

                        </div>
                    </div>

                    <!-- Dirección -->
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" value="{{ old('address') }}" required maxlength="255">
                        @error('address')
                            <span class="text-danger d-block mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Referencia -->
                    <div class="form-group">
                        <label for="reference">Referencia</label>
                        <input type="text" class="form-control @error('reference') is-invalid @enderror"
                            id="reference" name="reference" value="{{ old('reference') }}" maxlength="255">
                        @error('reference')
                            <span class="text-danger d-block mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Número de miembros del hogar -->
                    <div class="form-group">
                        <label for="household_members">Número de Miembros en el Hogar</label>
                        <input type="number" class="form-control @error('household_members') is-invalid @enderror"
                            id="household_members" name="household_members" value="{{ old('household_members') }}"
                            min="1" max="20"
                            onkeydown="return event.key !== 'e' && event.key !== 'E' && event.key !== '-' && event.key !== '+' && event.key !== '.'">
                        @error('household_members')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para seleccionar el guardián con Select2 -->
                    <div class="form-group">
                        <label for="guardian_id" style="font-weight: bold;">Seleccionar Guardián</label>
                        <select id="guardian_id" name="guardian_id" class="form-control select2"
                            style="width: 100%; text-align-last: center;">
                            <option value="" disabled selected>Seleccione un guardián...</option>
                            @foreach ($guardians as $guardian)
                                <option value="{{ $guardian->id }}">
                                    {{ $guardian->given_name }} {{ $guardian->paternal_last_name }}
                                    {{ $guardian->maternal_last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- TIPO DE DISCAPACIDAD -->
                    <div class="form-group">
                        <label class="fw-bold">Tipo de Discapacidad</label>
                        <div class="btn-group" role="group" aria-label="Discapacidades">
                            <!-- Visual -->
                            <button type="button" class="btn btn-outline-primary toggle-button" data-value="Visual">
                                <i class="fas fa-eye"></i> Visual
                            </button>
                            <!-- Auditiva -->
                            <button type="button" class="btn btn-outline-primary toggle-button" data-value="Auditiva">
                                <i class="fas fa-deaf"></i> Auditiva
                            </button>
                            <!-- Motriz -->
                            <button type="button" class="btn btn-outline-primary toggle-button" data-value="Motriz">
                                <i class="fas fa-wheelchair"></i> Motriz
                            </button>
                            <!-- Mental -->
                            <button type="button" class="btn btn-outline-primary toggle-button" data-value="Mental">
                                <i class="fas fa-brain"></i> Mental
                            </button>
                            <!-- Del Habla -->
                            <button type="button" class="btn btn-outline-primary toggle-button" data-value="Del Habla">
                                <i class="fas fa-comments"></i> Del Habla
                            </button>
                            <!-- Otra -->
                            <button type="button" class="btn btn-outline-primary toggle-button" data-value="Otra">
                                <i class="fas fa-question-circle"></i> Otra
                            </button>
                        </div>
                        <input type="hidden" name="type_of_disability" id="type_of_disability"
                            value="{{ old('type_of_disability', json_encode($elderlyAdult->type_of_disability ?? [])) }}">
                    </div>

                    <!-- Atención Permanente -->
                    <div class="form-group">
                        <label for="permanent_attention" class="form-label fw-bold" style="font-size: 1.2rem;">Requiere
                            Atención Permanente</label>
                        <div class="d-flex align-items-center mt-3">
                            <div class="form-check"
                                style="border: 2px solid #6E8E59; border-radius: 10px; padding: 10px 15px; background-color: #FFEECC;">
                                <input class="form-check-input" type="checkbox" name="permanent_attention"
                                    id="permanent_attention" value="1"
                                    style="transform: scale(1.5); margin-right: 10px;">
                                <label class="form-check-label fw-bold" for="permanent_attention" style="color: #333;">
                                    <i class="fas fa-question-circle" style="margin-right: 5px; color: #FFA500;"></i>
                                    Atención Permanente
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
                        <label>Programa(s) Social(es)</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="social_program[]"
                                    id="social_program_pension65" value="Pensión 65"
                                    {{ in_array('Pensión 65', old('social_program', $elderlyAdult->social_program ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="social_program_pension65">Pensión 65</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="social_program[]"
                                    id="social_program_pvl" value="P.V.L."
                                    {{ in_array('P.V.L.', old('social_program', $elderlyAdult->social_program ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="social_program_pvl">P.V.L.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="social_program[]"
                                    id="social_program_comedor" value="Comedor Popular"
                                    {{ in_array('Comedor Popular', old('social_program', $elderlyAdult->social_program ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="social_program_comedor">Comedor Popular</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="social_program[]"
                                    id="social_program_otros" value="Otros"
                                    {{ in_array('Otros', old('social_program', $elderlyAdult->social_program ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="social_program_otros">Otros</label>
                            </div>
                        </div>
                    </div>

                    <!-- Estado -->
                    <div class="form-group">
                        <label class="form-label fw-bold" style="font-size: 1.2rem;">Estado</label>
                        <div class="d-flex justify-content-start align-items-center mt-3" style="gap: 20px;">
                            <!-- Botón Activo -->
                            <div class="form-check"
                                style="border: 2px solid #6E8E59; border-radius: 10px; padding: 10px 15px; background-color: #E6FFCC;">
                                <input class="form-check-input" type="radio" name="state" id="state_active"
                                    value="1" style="transform: scale(1.5); margin-right: 10px;" required>
                                <label class="form-check-label fw-bold d-flex align-items-center" for="state_active"
                                    style="color: #333;">
                                    <i class="fas fa-smile"
                                        style="color: #6E8E59; font-size: 1.5rem; margin-right: 10px;"></i> Activo
                                </label>
                            </div>

                            <!-- Botón Inactivo -->
                            <div class="form-check"
                                style="border: 2px solid #780C28; border-radius: 10px; padding: 10px 15px; background-color: #FFCCCC;">
                                <input class="form-check-input" type="radio" name="state" id="state_inactive"
                                    value="0" style="transform: scale(1.5); margin-right: 10px;" required>
                                <label class="form-check-label fw-bold d-flex align-items-center" for="state_inactive"
                                    style="color: #333;">
                                    <i class="fas fa-frown"
                                        style="color: #780C28; font-size: 1.5rem; margin-right: 10px;"></i> Inactivo
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
                    <button type="submit" class="btn"
                        style="background-color: #708f3a; color: white;">Guardar</button>
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

    <!--  PARA mandar lista de Ids y evitar duplicidad de id's-->
    <script>
        const existingIds = @json($existingIds); // Convertir la lista de IDs a JSON
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('create-elderly-form');
            const idInput = document.getElementById('id');
            const idError = document.getElementById('id-error');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar que el formulario se envíe automáticamente

                // Validar el campo de idiomas (si lo tienes)
                const languageCheckboxes = document.querySelectorAll('input[name="language[]"]:checked');
                if (languageCheckboxes.length === 0) {
                    document.getElementById('language-error').style.display = 'block';
                    document.getElementById('language-error').scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    return; // Detener la ejecución si no se selecciona ningún idioma
                }

                // Validar el ID
                const id = idInput.value;

                if (existingIds.includes(id)) {
                    // Mostrar mensaje de error si el ID ya existe
                    idError.textContent = 'El ID ya está registrado.'; // Mensaje de error personalizado
                    idError.style.display = 'block';
                    idError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                } else {
                    // Enviar el formulario si el ID no está duplicado
                    form.submit();
                }
            });
        });
    </script>

    <!--  PARA LOS NOMBRES-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('JavaScript cargado correctamente'); // Depuración

            document.getElementById('create-elderly-form').addEventListener('submit', function(event) {
                console.log('Formulario enviado'); // Depuración

                const languageCheckboxes = document.querySelectorAll('input[name="language[]"]:checked');
                if (languageCheckboxes.length === 0) {
                    console.log('No se seleccionó ningún idioma'); // Depuración
                    document.getElementById('language-error').style.display = 'block';
                    event.preventDefault(); // Evitar que el formulario se envíe
                } else {
                    document.getElementById('language-error').style.display = 'none';
                }
            });
        });
    </script>

    <!-- PARA IDIOMAS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('JavaScript cargado correctamente'); // Depuración

            document.getElementById('create-elderly-form').addEventListener('submit', function(event) {
                console.log('Formulario enviado'); // Depuración

                const languageCheckboxes = document.querySelectorAll('input[name="language[]"]:checked');
                console.log('Checkboxes seleccionados:', languageCheckboxes.length); // Depuración

                if (languageCheckboxes.length === 0) {
                    console.log('No se seleccionó ningún idioma'); // Depuración
                    document.getElementById('language-error').style.display = 'block';

                    // Desplazar la página hasta el campo de idiomas
                    document.getElementById('language-error').scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    event.preventDefault(); // Evitar que el formulario se envíe
                } else {
                    console.log('Idiomas seleccionados:', languageCheckboxes.length); // Depuración
                    document.getElementById('language-error').style.display = 'none';
                }
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
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('phone_number');
            const form = document.querySelector('form');

            // Validación en tiempo real
            phoneInput.addEventListener('input', function() {
                // Solo permite números y limita a 9 caracteres
                this.value = this.value.replace(/\D/g, '').substring(0, 9);

                // Cambia el color del borde según la validación
                if (this.value.length === 9) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                }
            });

            // Validación antes de enviar
            form.addEventListener('submit', function(e) {
                if (phoneInput.value.length !== 9) {
                    e.preventDefault();
                    phoneInput.focus();
                    phoneInput.classList.add('is-invalid');

                    // Muestra mensaje de error más visible
                    const errorElement = document.createElement('div');
                    errorElement.className = 'alert alert-danger mt-2';
                    errorElement.textContent = 'El teléfono debe tener exactamente 9 dígitos';

                    // Inserta después del campo
                    phoneInput.parentNode.insertBefore(errorElement, phoneInput.nextSibling);

                    // Elimina el mensaje después de 5 segundos
                    setTimeout(() => errorElement.remove(), 5000);
                }
            });
        });
    </script>

    <!-- PARA MIEMBROS DEL hogar  -->
    <script>
        // Bloquear caracteres no numéricos
        document.getElementById('household_members').addEventListener('keydown', function(e) {
            // Permitir: teclas de navegación, borrado y tab
            if ([46, 8, 9, 27, 13, 110].includes(e.keyCode) ||
                (e.keyCode === 65 && e.ctrlKey === true) || // Ctrl+A
                (e.keyCode === 67 && e.ctrlKey === true) || // Ctrl+C
                (e.keyCode === 86 && e.ctrlKey === true) || // Ctrl+V
                (e.keyCode === 88 && e.ctrlKey === true) || // Ctrl+X
                (e.keyCode >= 35 && e.keyCode <= 39)) { // Home, End, Left, Right
                return;
            }

            // Bloquear letras (incluyendo 'e'), símbolos y puntos
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        // Validación al enviar el formulario (manteniendo tu lógica existente)
        document.querySelector('form').addEventListener('submit', function(event) {
            var householdMembers = document.getElementById('household_members').value;
            var numMembers = parseInt(householdMembers, 10);

            if (numMembers > 20) {
                alert('Error: Solo puedes ingresar hasta 20 miembros del hogar.');
                event.preventDefault();
            }
        });
    </script>

    <!-- PARA LOS TIPOS DE DISCAPACIDADES -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.toggle-button');
            const hiddenInput = document.getElementById('type_of_disability');

            // Cargar valores seleccionados previamente
            const initialValues = JSON.parse(hiddenInput.value || '[]');
            initialValues.forEach(value => {
                const button = Array.from(buttons).find(btn => btn.getAttribute('data-value') === value);
                if (button) button.classList.add('active');
            });

            // Manejar clics en los botones
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    this.classList.toggle('active');
                    updateHiddenInput();
                });
            });

            // Actualizar el campo oculto con los valores seleccionados
            function updateHiddenInput() {
                const selectedValues = Array.from(buttons)
                    .filter(button => button.classList.contains('active'))
                    .map(button => button.getAttribute('data-value'));
                hiddenInput.value = JSON.stringify(selectedValues);
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

    <!-- Estilo adicional para campo de tipo de discapacidad-->
    <style>
        .btn-group .btn.active {
            background-color: #007bff;
            color: white;
        }

        .btn-group .btn i {
            margin-right: 5px;
            /* Espacio entre el icono y el texto */
        }
    </style>

    <!-- Estilo adicional para campo de IDIOMA-->
    <style>
        #language-error {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }
    </style>

    <!-- Estilo adicional para validacion de el telefono-->
    <style>
        .is-valid {
            border-color: #28a745 !important;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }
    </style>

@stop
