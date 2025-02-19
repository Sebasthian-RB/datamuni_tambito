@extends('adminlte::page')

@section('title', 'Agregar Miembro al Comité')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Aplica un estilo personalizado para la caja de selección de Select2 */
        .select2-container--default .select2-selection--single {
            height: 45px !important; /* Ajusta la altura del select */
            line-height: 45px !important; /* Alineación vertical del texto */
            font-size: 16px !important; /* Tamaño de fuente */
            background-color: #ffffff !important; /* Color de fondo igual que el card */
            border: 2px solid #9B7EBD !important; /* Borde similar al diseño del card */
            border-radius: 12px !important; /* Bordes redondeados */
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1) !important; /* Sombra suave */
        }
    
        /* Ajuste del padding para el texto */
        .select2-container--default .select2-selection__rendered {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
            color: #3B1E54 !important; /* Color del texto, como en el card */
        }
    
        /* Ajuste del dropdown de opciones */
        .select2-dropdown {
            max-height: 300px !important; /* Define la altura máxima */
            overflow-y: auto !important; /* Permite el scroll si es necesario */
            background-color: #D4BEE4 !important; /* Fondo similar al de la selección */
            border: 2px solid #9B7EBD !important; /* Borde del dropdown */
            border-radius: 12px !important; /* Bordes redondeados */
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1) !important; /* Sombra suave */
        }
    
        /* Estilo para los elementos del dropdown */
        .select2-results__option {
            padding: 10px !important; /* Aumentar padding para mejor clicabilidad */
            font-size: 16px !important; /* Ajustar tamaño de la fuente */
            color: #3B1E54 !important; /* Color del texto en las opciones */
        }
    
        /* Hover sobre los elementos del dropdown */
        .select2-results__option--highlighted {
            background-color: #9B7EBD !important; /* Color de fondo al pasar el mouse */
            color: white !important; /* Color del texto al pasar el mouse */
        }
        
        /* Estilos para campos editables */
        .editable-field {
            background-color: white !important; /* Fondo blanco */
            border: 1px solid #9B7EBD !important; /* Borde con color */
            padding: 10px;
            font-size: 13px !important; /* Tamaño de fuente */
        }

        .editable-field-minor {
            background-color: white !important; /* Fondo blanco */
            border: 1px solid #B8B8B8 !important; /* Borde con color */
            padding: 10px;
            font-size: 13px !important; /* Tamaño de fuente */
        }
    </style>
@stop

@section('content_header')
    <h1>Agregar Miembro al Comité</h1>
@stop

@section('content')
    <div class="container">
        <form action="{{ route('committee_vl_family_members.store', ['committee_id' => $committee->id]) }}" method="POST">
            @csrf

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="card">
                <div class="card-header" style="background-color: #3B1E54; color: #FFFFFF;">
                    <h3 class="card-title">Formulario para agregar miembro al comité</h3>
                </div>
                <div class="card-body">
                    <!-- Campo oculto para el ID del comité -->
                    <input type="hidden" name="committee_id" id="committee_id" value="{{ $committee->id }}">

                    <!-- Campo oculto para la fecha y hora actual -->
                    <input type="hidden" name="change_date" id="change_date" value="{{ now() }}">

                    <!-- Campo oculto para el estado (siempre activo) -->
                    <input type="hidden" name="status" id="status" value="1">

                    <!-- Información del Comité (Solo visible, no editable) -->
                    <div class="form-group">
                        <label for="committee_name">Comité</label>
                        <input type="text" class="form-control" id="committee_name" value="{{ $committee->name }}" disabled>
                    </div>

                    <!-- Selección del Miembro de Familia -->
                    <div class="form-group">
                        <label for="vl_family_member_id">Miembro de Familia</label>
                        <select class="form-control select2 @error('vl_family_member_id') is-invalid @enderror" id="vl_family_member_id" name="vl_family_member_id" required>
                            <option value="" disabled selected>Seleccione un miembro de familia</option>
                            @foreach($vlFamilyMembers as $member)
                                <option value="{{ $member->id }}" 
                                    data-id="{{ $member->id }}"
                                    data-identity="{{ $member->identity_document }}"
                                    data-given-name="{{ $member->given_name }}"
                                    data-paternal="{{ $member->paternal_last_name }}"
                                    data-maternal="{{ $member->maternal_last_name }}"
                                    data-minors="{{ json_encode($member->vlMinors) }}"
                                    {{ old('vl_family_member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->id }}
                                </option>
                            @endforeach
                        </select>
                        @error('vl_family_member_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Card Principal para Familiar - Oculto por Defecto -->
                    <div id="family-member-details" class="card" 
                        style="display: none; background-color: #D4BEE4; border: none; border-radius: 12px; 
                            padding: 25px; box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.08); max-width: 600px; 
                            margin: auto; transition: all 0.3s ease;">

                        <div class="card-body">
                            <!-- Título y Botón de Editar -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title text-center" 
                                    style="color: #3B1E54; font-weight: bold; font-size: 20px; margin-bottom: 0;">
                                    🟣 Detalles del Familiar
                                </h5>
                                <button type="button" class="btn btn-warning btn-sm" style="background-color: #3B1E54; color: #FFFFFF" id="editFamilyMemberBtn">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                            </div>

                            <!-- Sección 1: ID y Documento -->
                            <div class="info-box d-flex justify-content-between align-items-center"
                                style="background: white; border-radius: 10px; padding: 15px 20px; 
                                    border-left: 4px solid #9B7EBD; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);">
                                <div>
                                    <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">ID</label>
                                    <input type="text" class="form-control" id="member_id" disabled 
                                        style="border: none; background: transparent; font-size: 16px; 
                                            font-weight: bold; color: #3B1E54;">
                                </div>
                                <div>
                                    <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">Documento</label>
                                    <input type="text" class="form-control" id="identity_document" disabled 
                                        style="border: none; background: transparent; font-size: 16px; 
                                            font-weight: bold; color: #3B1E54;">
                                </div>
                            </div>

                            <!-- Espaciado entre secciones -->
                            <div class="mt-3"></div>

                            <!-- Sección 2: Nombre y Apellidos -->
                            <div class="info-box d-flex flex-column"
                                style="background: white; border-radius: 10px; padding: 15px 20px; 
                                    border-left: 4px solid #9B7EBD; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);">  
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="paternal_last_name" disabled 
                                            style="border: none; background: transparent; font-size: 16px; 
                                                font-weight: bold; color: #3B1E54;">
                                    </div>
                                    <div>
                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">Apellido Materno</label>
                                        <input type="text" class="form-control" id="maternal_last_name" disabled 
                                            style="border: none; background: transparent; font-size: 16px; 
                                                font-weight: bold; color: #3B1E54;">
                                    </div>
                                </div>

                                <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">Nombres</label>
                                <input type="text" class="form-control" id="given_name" disabled 
                                    style="border: none; background: transparent; font-size: 16px; 
                                        font-weight: bold; color: #3B1E54;">
                            </div>

                            <!-- Botones (solo visibles si los campos son editables) -->
                            <div id="saveCancelButtons" class="text-center mt-4" style="display: none;">
                                <button type="button" class="btn btn-success" id="saveFamilyMemberBtn" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">Actualizar datos</button>
                                <button type="button" class="btn btn-secondary" id="cancelEditBtn">Cancelar</button>
                            </div>   
                        </div>
                    </div>

                    <!-- Contenedor para mostrar menores de edad -->
                    <div id="minor-details-container"></div>

                    <!-- Descripción -->
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">Guardar Miembro</button>
                    <a href="{{ route('committee_vl_family_members.index', ['committee_id' => $committee->id]) }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    @if(session()->has('confirmation_needed'))
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmación necesaria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Este familiar ya está registrado en otro comité. ¿Está seguro de que desea moverlo?</p>
                        <p class="text-danger"><strong>Nota:</strong> Si confirma, el estado del registro anterior será inactivo y este nuevo será el activo.</p>
                        
                        <!-- Aquí mostramos los datos que recibe el modal -->
                        <hr>
                        <h6>Datos Recibidos:</h6>
                        <ul>
                            <li><strong>Committee ID:</strong> {{ session('committee_id', 'No recibido') }}</li>
                            <li><strong>Familiar ID:</strong> {{ session('existing_member_id', 'No recibido') }}</li>
                            <li><strong>Fecha de Cambio:</strong> {{ session('change_date', 'No recibido') }}</li>
                            <li><strong>Descripción:</strong> {{ session('description', 'No recibido') }}</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <form id="confirmUpdateForm" action="{{ route('committee_vl_family_members.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="committee_id" value="{{ session('committee_id') }}">
                            <input type="hidden" name="vl_family_member_id" value="{{ session('existing_member_id') }}">
                            <input type="hidden" name="change_date" value="{{ session('change_date') }}">
                            <input type="hidden" name="description" value="{{ session('description') }}">
                            <input type="hidden" name="confirm_update" value="1">
                            <input type="hidden" name="status" value="1">

                            <button type="submit" class="btn btn-primary">Sí, actualizar</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>

    <!-- Inicialización de Select2 -->
    <script>
        $(document).ready(function() {
            // Inicializa Select2 en el select con id vl_family_member_id
            $('#vl_family_member_id').select2({
                placeholder: "Selecciona un miembro de familia",
                allowClear: true // Permite borrar la selección
            });

            // Depura el valor seleccionado en la consola
            $('#vl_family_member_id').on('change', function() {
                console.log("Valor seleccionado:", $(this).val());
            });
        });
    </script>


    <!-- Script para el modal -->
    @if(session()->has('confirmation_needed'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                console.log("Mostrando modal con los siguientes datos:");
                console.log("Committee ID:", "{{ session('committee_id') }}");
                console.log("Familiar ID:", "{{ session('existing_member_id') }}");
                console.log("Fecha de Cambio:", "{{ session('change_date') }}");
                console.log("Descripción:", "{{ session('description') }}");
                $('#confirmationModal').modal('show'); // Muestra el modal automáticamente
            });
        </script>
    @endif

    <!-- Script para mostrar datos del familiar -->
    <script>
        $(document).ready(function() {
            let originalValues = {}; // Objeto para almacenar los valores originales

            $('#vl_family_member_id').on('change', function() {
                const selected = $(this).find(':selected');

                // Si no hay selección, ocultar la tarjeta de datos del familiar
                if (!selected.val()) {
                    $('#family-member-details').hide();
                    return;
                }
                
                // Guardar valores originales correctamente
                originalValues = {
                    id: selected.attr('data-id') || '',
                    identity_document: selected.attr('data-identity') || '',
                    given_name: selected.attr('data-given-name') || '',
                    paternal_last_name: selected.attr('data-paternal') || '',
                    maternal_last_name: selected.attr('data-maternal') || '',
                    minors: JSON.parse(selected.attr('data-minors') || '[]')
                };

                // Asignar los valores a los campos del formulario
                $('#member_id').val(originalValues.id).prop('disabled', true).css('background-color', '#e9ecef');
                $('#identity_document').val(originalValues.identity_document).prop('disabled', true).css('background-color', '#e9ecef');
                $('#given_name').val(originalValues.given_name).prop('disabled', true).css('background-color', '#e9ecef');
                $('#paternal_last_name').val(originalValues.paternal_last_name).prop('disabled', true).css('background-color', '#e9ecef');
                $('#maternal_last_name').val(originalValues.maternal_last_name).prop('disabled', true).css('background-color', '#e9ecef');

                // Ajustar ancho original
                $('#given_name, #paternal_last_name, #maternal_last_name').css('width', '')

                // Ocultar mensajes de error si existen
                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');

                // Mostrar la tarjeta con los datos
                $('#family-member-details').show();
            });

            // Al hacer clic en "Editar"
            $('#editFamilyMemberBtn').on('click', function() {
                // Guardar valores actuales antes de editar
                originalValues.id = $('#member_id').val();
                originalValues.identity_document = $('#identity_document').val();
                originalValues.given_name = $('#given_name').val();
                originalValues.paternal_last_name = $('#paternal_last_name').val();
                originalValues.maternal_last_name = $('#maternal_last_name').val();

                // Habilitar edición en los otros campos
                $('#given_name, #paternal_last_name, #maternal_last_name')
                    .prop('disabled', false)
                    .css('background-color', 'white')
                    .addClass('editable-field');

                $('#saveCancelButtons').show();
                $(this).hide();
            });

            // Al hacer clic en "Cancelar"
            $('#cancelEditBtn').on('click', function() {
                // Restaurar los valores originales
                $('#member_id').val(originalValues.id).prop('disabled', true).removeClass('editable-field');
                $('#identity_document').val(originalValues.identity_document);
                $('#given_name').val(originalValues.given_name).prop('disabled', true).css('background-color', '#e9ecef').removeClass('editable-field');
                $('#paternal_last_name').val(originalValues.paternal_last_name).prop('disabled', true).css('background-color', '#e9ecef').removeClass('editable-field');
                $('#maternal_last_name').val(originalValues.maternal_last_name).prop('disabled', true).css('background-color', '#e9ecef').removeClass('editable-field');

                $('#saveCancelButtons').hide();
                $('#editFamilyMemberBtn').show();

                // Ocultar mensajes de error si existen
                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');
            });

            // Al hacer clic en "Guardar"
            $('#saveFamilyMemberBtn').on('click', function() {
                const memberId = $('#member_id').val();

                if (!memberId) {
                    alert("Error: No se ha seleccionado un miembro de familia.");
                    return;
                }

                const updateUrl = `{{ url('vl_family_members') }}/${memberId}`;

                const updatedData = {
                    _token: "{{ csrf_token() }}",
                    _method: "PUT",
                    id: memberId,
                    identity_document: $('#identity_document').val(),
                    given_name: $('#given_name').val(),
                    paternal_last_name: $('#paternal_last_name').val(),
                    maternal_last_name: $('#maternal_last_name').val(),
                };

                $.ajax({
                    url: updateUrl,
                    type: "POST",
                    data: updatedData,
                    success: function(response) {
                        alert('Datos actualizados correctamente');
                        $('#saveCancelButtons').hide();
                        $('#editFamilyMemberBtn').show();
                        $('#member_id, #identity_document, #given_name, #paternal_last_name, #maternal_last_name').prop('disabled', true).removeClass('editable-field').css('background-color', '#e9ecef');
                        
                        // Ocultar mensajes de error si existen
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');
                    },
                    error: function(xhr) {
                        
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            // Eliminar mensajes de error previos
                            $('.invalid-feedback').remove();
                            $('.is-invalid').removeClass('is-invalid');

                            $.each(errors, function(key, messages) {
                                let inputField = $('#' + key);

                                // Agregar clase de error al input
                                inputField.addClass('is-invalid');

                                // Mostrar el mensaje de error debajo del campo
                                inputField.after(`<div class="invalid-feedback">${messages[0]}</div>`);
                            });
                        } else {
                            console.log(xhr.responseText);
                            alert('Error al actualizar los datos: ' + xhr.responseText);
                        }
                    }
                });
            });
        });
    </script>

    <!-- Script para mostrar datos del menor de edad -->
    <script>
        // Función para convertir fechas a formato YYYY-MM-DD
        function formatDate(inputDate) {
            const date = new Date(inputDate);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');  // Asegura que el mes tenga 2 dígitos
            const day = String(date.getDate()).padStart(2, '0');  // Asegura que el día tenga 2 dígitos
            return `${year}-${month}-${day}`;
        }

        $(document).ready(function() {
            let originalMinorValues = {}; // Objeto para almacenar los valores originales del menor
        
            $('#vl_family_member_id').on('change', function() {
                const selected = $(this).find(':selected');
                const minorsData = JSON.parse(selected.attr('data-minors') || '[]'); // Obtener los menores asociados
        
                // Limpiar los detalles de los menores previos
                $('#minor-details-container').empty(); // Limpiar todos los cards existentes
        
                if (minorsData.length > 0) {
                    // Crear una fila (row) para los cards, ahora con dos columnas por fila
                    const rowHTML = $('<div class="row row-cols-1 row-cols-md-2 g-4"></div>'); // row-cols-md-2 para 2 cards por fila
        
                    minorsData.forEach(function(minor) {
                        originalMinorValues[minor.id] = { ...minor }; // Guardar valores originales

                        // Validar si birth_date está definido y tiene formato correcto
                        let age = 0;
                        if (minor.birth_date) {
                            let birthDate = new Date(minor.birth_date);
                            
                            if (!isNaN(birthDate.getTime())) { // Asegura que la fecha sea válida
                                const today = new Date();
                                age = today.getFullYear() - birthDate.getFullYear();
                                const monthDiff = today.getMonth() - birthDate.getMonth();
                                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                                    age--; // Ajustar si aún no ha cumplido años este año
                                }
                            } else {
                                console.warn(`Fecha inválida para el menor ID: ${minor.id} - Fecha recibida: ${minor.birth_date}`);
                            }
                        } else {
                            console.warn(`El menor con ID ${minor.id} no tiene fecha de nacimiento.`);
                        }

                        // Generar alerta si el menor tiene más de 7 años
                        const ageAlert = age > 7 ? `
                            <div class="d-flex align-items-center justify-content-center p-3" 
                                style="background: #FFE5E5; 
                                    color: #B71C1C; 
                                    border-left: 5px solid #B71C1C; 
                                    border-radius: 10px; 
                                    box-shadow: 0px 4px 10px rgba(183, 28, 28, 0.2); 
                                    font-weight: 600; 
                                    font-size: 16px; 
                                    padding: 15px; 
                                    margin-bottom: 15px;">
                                <i class="fas fa-exclamation-circle fa-lg me-2"></i>
                                <span>Advertencia: Este menor tiene <strong>${age}</strong> años.</span>
                            </div>


                        ` : '';

                        const cardHTML = `
                            <div id="minor-details-${minor.id}" class="col-12" style="padding: 25px">
                                <div class="card" style="background-color: #EEEEEE; border: none; border-radius: 12px;
                                    padding: 25px; box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; width: 100%;">
                                    
                                    <div class="card-body">
                                        ${ageAlert} <!-- Alerta si el menor tiene más de 7 años -->

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title text-center" style="color: #3B1E54; font-weight: bold; font-size: 20px; margin-bottom: 0;">
                                                ⚫ Detalles del Menor
                                            </h5>
                                            <button type="button" class="btn btn-warning btn-sm editMinorBtn" style="background-color: #3B1E54; color: #FFFFFF" data-id="${minor.id}">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </button>
                                        </div>

                                        <!-- Contenedor para las dos columnas -->
                                        <div class="row">
                                            <!-- Columna 1: Información básica + Apellidos y nombres -->
                                            <div class="col-12">
                                                <!-- Información básica -->
                                                <div class="info-box d-flex justify-content-between align-items-center" style="background: white; border-radius: 10px; padding: 15px 20px; border-left: 4px solid #B8B8B8; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);">
                                                    <div>
                                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                            <i class="fas fa-id-card"></i> ID
                                                        </label>
                                                        <input type="text" class="form-control" id="minor_id_${minor.id}" disabled value="${minor.id}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                    </div>
                                                    <div>
                                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                            <i class="fas fa-file-alt"></i> Documento
                                                        </label>
                                                        <input type="text" class="form-control" id="identity_document_${minor.id}" disabled value="${minor.identity_document}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                    </div>
                                                </div>

                                                <!-- Apellidos y nombres -->
                                                <div class="info-box d-flex flex-column mt-3" style="background: white; border-radius: 10px; padding: 15px 20px; border-left: 4px solid #B8B8B8; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                                Apellido Paterno
                                                            </label>
                                                            <input type="text" class="form-control" id="paternal_last_name_${minor.id}" disabled value="${minor.paternal_last_name}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                        </div>
                                                        <div>
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                                Apellido Materno
                                                            </label>
                                                            <input type="text" class="form-control" id="maternal_last_name_${minor.id}" disabled value="${minor.maternal_last_name}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                        </div>
                                                    </div>

                                                    <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                        Nombres
                                                    </label>
                                                    <input type="text" class="form-control" id="given_name_${minor.id}" disabled value="${minor.given_name}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                </div>
                                            </div>

                                            <!-- Columna 2: Información adicional -->
                                            <div class="col-12">
                                                <div class="info-box d-flex flex-column mt-3" style="background: white; border-radius: 10px; padding: 15px 20px; border-left: 4px solid #B8B8B8; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);">
                                                    
                                                    <div style="display: flex; justify-content: space-between; gap: 20px;">
                                                        <div>
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                                <i class="fas fa-calendar-alt"></i> Fecha de Nacimiento
                                                            </label>
                                                            <input type="date" class="form-control" id="birth_date_${minor.id}" disabled value="${formatDate(minor.birth_date)}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                        </div>
                                                        <div>
                                                            <label style="color: #3B1E54; font-weight: 600; font-size: 14px;">
                                                                <i class="fas fa-venus-mars"></i> Sexo
                                                            </label>
                                                            <select class="form-control" id="sex_type_${minor.id}" disabled 
                                                                style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                                ${Object.entries(@json($sexTypes)).map(([sex, value]) => 
                                                                    `<option value="${sex}" ${minor.sex_type == sex ? 'selected' : ''}>${value}</option>`
                                                                ).join('')}
                                                            </select>                                                   
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                            <i class="fas fa-map-marker-alt"></i> Dirección
                                                        </label>
                                                        <input type="text" class="form-control" id="address_${minor.id}" disabled value="${minor.address}" style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                    </div>
                                                    <div>
                                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                            <i class="fas fa-home"></i> Tipo de Vivienda
                                                        </label>
                                                        <select class="form-control" id="dwelling_type_${minor.id}" disabled 
                                                            style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                            ${@json($dwellingTypes).map(dwelling => 
                                                                `<option value="${dwelling}" ${minor.dwelling_type === dwelling ? 'selected' : ''}>${dwelling}</option>`
                                                            ).join('')}
                                                        </select>

                                                    </div>
                                                    <div>
                                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                            <i class="fas fa-graduation-cap"></i> Nivel de Educación
                                                        </label>
                                                        <select class="form-control" id="education_level_${minor.id}" disabled 
                                                            style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                            ${@json($educationLevels).map(level => 
                                                                `<option value="${level}" ${minor.education_level === level ? 'selected' : ''}>${level}</option>`
                                                            ).join('')}
                                                        </select>

                                                    </div>
                                                    <div>
                                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                            <i class="fas fa-clipboard-list"></i> Condición
                                                        </label>
                                                        <select class="form-control" id="condition_${minor.id}" disabled 
                                                            style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                            ${@json($conditions).map(condition => 
                                                                `<option value="${condition}" ${minor.condition === condition ? 'selected' : ''}>${condition}</option>`
                                                            ).join('')}
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                            <i class="fas fa-users"></i> Relación
                                                        </label>
                                                        <select class="form-control" id="kinship_${minor.id}" disabled 
                                                            style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                            ${@json($kinships).map(kinship => 
                                                                `<option value="${kinship}" ${minor.kinship === kinship ? 'selected' : ''}>${kinship}</option>`
                                                            ).join('')}
                                                        </select>

                                                    </div>
                                                    <div>
                                                        <label style="color: #3B1E54; font-weight: 600; font-size: 14px; padding-top: 15px;">
                                                            <i class="fas fa-wheelchair"></i> Discapacidad
                                                        </label>
                                                        <select class="form-control" id="disability_${minor.id}" disabled 
                                                            style="border: none; background: transparent; font-size: 16px; font-weight: bold; color: #3B1E54;">
                                                            ${Object.entries(@json($disabilities)).map(([disability, value]) => 
                                                                `<option value="${disability}" ${minor.disability == disability ? 'selected' : ''}>${value}</option>`
                                                            ).join('')}
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="saveCancelButtons_${minor.id}" class="text-center mt-4" style="display: none;">
                                            <button type="button" class="btn btn-success" id="saveMinorBtn_${minor.id}" data-id="${minor.id}" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">
                                                <i class="fas fa-save"></i> Actualizar datos
                                            </button>
                                            <button type="button" class="btn btn-secondary" id="cancelEditBtn_${minor.id}">
                                                <i class="fas fa-times-circle"></i> Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        // Añadir el card al contenedor de la fila
                        rowHTML.append(cardHTML);
                    });
        
                    // Añadir la fila completa al contenedor principal
                    $('#minor-details-container').append(rowHTML);
        
                    // Mostrar la sección de detalles
                    $('#minor-details-container').show();
                } else {
                    $('#minor-details-container').html("<p>No hay menores asociados.</p>").show();
                }
            });

            // Evento para editar los datos del menor
            $(document).on('click', '.editMinorBtn', function() {
                const minorId = $(this).data('id');

                // Habilitar todos los campos EXCEPTO ID y Documento de Identidad
                $(`#given_name_${minorId}, #paternal_last_name_${minorId}, #maternal_last_name_${minorId}, 
                #birth_date_${minorId}, #sex_type_${minorId}, #address_${minorId}, 
                #dwelling_type_${minorId}, #education_level_${minorId}, #condition_${minorId}, #kinship_${minorId}, #disability_${minorId}`)
                    .prop('disabled', false)
                    .css('background-color', 'white')
                    .addClass('editable-field-minor');

                $(`#minor_id_${minorId}, #identity_document_${minorId}`)
                    .css('background-color', '#e9ecef');

                // Mostrar los botones de guardar y cancelar
                $(`#saveCancelButtons_${minorId}`).show();
                
                // Ocultar el botón de edición
                $(this).hide();
            });

            // Al hacer clic en "Cancelar"
            $(document).on('click', '[id^="cancelEditBtn_"]', function() {
                const minorId = $(this).attr('id').split('_')[1]; // Extraer el ID del menor a partir del id del botón

                // Restaurar los valores originales para este menor
                $(`#minor_id_${minorId}, #identity_document_${minorId}`)
                    .css('background-color', 'transparent');

                if (originalMinorValues[minorId]) {
                    $(`#given_name_${minorId}`).val(originalMinorValues[minorId].given_name).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#paternal_last_name_${minorId}`).val(originalMinorValues[minorId].paternal_last_name).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#maternal_last_name_${minorId}`).val(originalMinorValues[minorId].maternal_last_name).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#birth_date_${minorId}`).val(formatDate(originalMinorValues[minorId].birth_date)).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    
                    // Restaurar el valor de sexo con formato correcto
                    const sexValue = originalMinorValues[minorId].sex_type ? '1' : '0';
                    $(`#sex_type_${minorId}`).val(sexValue).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    
                    $(`#address_${minorId}`).val(originalMinorValues[minorId].address).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#dwelling_type_${minorId}`).val(originalMinorValues[minorId].dwelling_type).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#education_level_${minorId}`).val(originalMinorValues[minorId].education_level).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#condition_${minorId}`).val(originalMinorValues[minorId].condition).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    $(`#kinship_${minorId}`).val(originalMinorValues[minorId].kinship).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    
                    // Restaurar el valor de discapacidad con formato correcto
                    const disabilityValue = originalMinorValues[minorId].disability ? '1' : '0';
                    $(`#disability_${minorId}`).val(disabilityValue).prop('disabled', true).css('background-color', 'transparent').removeClass('editable-field-minor');
                    
                } else {
                    console.log("No se encontraron valores originales para este menor.");
                }

                // Ocultar botones de guardar/cancelar y mostrar el de editar
                $(`#saveCancelButtons_${minorId}`).fadeOut();
                $(`.editMinorBtn[data-id="${minorId}"]`).fadeIn();

                // Restablecer los estilos y elementos que estaban modificados
                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');
            });

            // Evento para guardar los cambios
            $(document).on('click', '[id^="saveMinorBtn_"]', function() {
                const minorId = $(this).data('id');

                const updateUrl = `{{ url('vl_minors') }}/${minorId}`;

                const updatedData = {
                    _token: "{{ csrf_token() }}",
                    _method: "PUT",
                    id: String(minorId), // Convertir a string porque en la BD es VARCHAR
                    identity_document: $(`#identity_document_${minorId}`).val() || originalMinorValues[minorId]?.identity_document || "",
                    given_name: $(`#given_name_${minorId}`).val() || originalMinorValues[minorId]?.given_name || "",
                    paternal_last_name: $(`#paternal_last_name_${minorId}`).val() || originalMinorValues[minorId]?.paternal_last_name || "",
                    maternal_last_name: $(`#maternal_last_name_${minorId}`).val() || originalMinorValues[minorId]?.maternal_last_name || "",
                    birth_date: formatDate($(`#birth_date_${minorId}`).val() || originalMinorValues[minorId]?.birth_date),
                    sex_type: $(`#sex_type_${minorId}`).val() !== undefined ? parseInt($(`#sex_type_${minorId}`).val()) : (originalMinorValues[minorId]?.sex_type ? 1 : 0),
                    registration_date: formatDate($(`#registration_date_${minorId}`).val() || originalMinorValues[minorId]?.registration_date),
                    withdrawal_date: formatDate($(`#withdrawal_date_${minorId}`).val() || originalMinorValues[minorId]?.withdrawal_date),
                    address: $(`#address_${minorId}`).val() || originalMinorValues[minorId]?.address || "",
                    dwelling_type: $(`#dwelling_type_${minorId}`).val() || originalMinorValues[minorId]?.dwelling_type || "Propio",
                    education_level: $(`#education_level_${minorId}`).val() || originalMinorValues[minorId]?.education_level || "Ninguno",
                    condition: $(`#condition_${minorId}`).val() || originalMinorValues[minorId]?.condition || "Lact.",
                    disability: $(`#disability_${minorId}`).val() !== undefined ? parseInt($(`#disability_${minorId}`).val()) : (originalMinorValues[minorId]?.disability ? 1 : 0),
                    kinship: $(`#kinship_${minorId}`).val() || originalMinorValues[minorId]?.kinship || "Hijo(a)",
                    vl_family_member_id: $(`#vl_family_member_id_${minorId}`).val() || originalMinorValues[minorId]?.vl_family_member_id || "",
                };

                // Función para formatear fechas correctamente
                function formatDate(date) {
                    if (!date) return null;
                    return date.split("T")[0]; // Extraer solo la parte "YYYY-MM-DD"
                }

                // Verificar los datos antes de enviarlos
                console.log("Datos a enviar:", updatedData);

                $.ajax({
                    url: updateUrl,
                    type: "POST",
                    data: updatedData,
                    success: function(response) {
                        alert('Datos del menor actualizados correctamente');

                        // Deshabilitar los campos nuevamente
                        $(`#given_name_${minorId}, #paternal_last_name_${minorId}, #maternal_last_name_${minorId}, 
                        #birth_date_${minorId}, #sex_type_${minorId}, #address_${minorId}, 
                        #dwelling_type_${minorId}, #education_level_${minorId}, #condition_${minorId}, #kinship_${minorId}, #disability_${minorId}`)
                            .prop('disabled', true)
                            .removeClass('editable-field-minor')
                            .css('background-color', 'transparent');

                        // Ocultar botones de guardar/cancelar y mostrar el de editar
                        $(`#saveCancelButtons_${minorId}`).hide();
                        $(`.editMinorBtn[data-id="${minorId}"]`).show();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $('.invalid-feedback').remove();
                            $('.is-invalid').removeClass('is-invalid');

                            $.each(errors, function(key, messages) {
                                let inputField = $(`#${key}_${minorId}`);
                                inputField.addClass('is-invalid');
                                inputField.after(`<div class="invalid-feedback">${messages[0]}</div>`);
                            });
                        } else {
                            console.log(xhr.responseText);
                            alert('Error al actualizar los datos: ' + xhr.responseText);
                        }
                    }
                });
            });

        });
    </script>
@stop