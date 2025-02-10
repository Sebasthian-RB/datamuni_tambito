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
                                    data-minors='@json($member->vlMinors)'
                                    {{ old('vl_family_member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->id }}
                                </option>
                            @endforeach
                        </select>
                        @error('vl_family_member_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Card Principal - Oculto por Defecto -->
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

                            <!-- Título y Botón de Editar -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title text-center" 
                                    style="color: #3B1E54; font-weight: bold; font-size: 20px; margin-bottom: 0;">
                                    🟣 Detalles de Menor(es) de Edad asociado(s)
                                </h5>
                            </div>

                            <div id="children-list" class="mt-3"
                                style="background: white; border-radius: 10px; padding: 15px 20px;
                                    border-left: 4px solid #9B7EBD; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);">
                                <ul id="childrenList" class="list-group" style="border-radius: 8px;"></ul>
                            </div>

                            <!-- Botones (solo visibles si los campos son editables) -->
                            <div id="saveCancelButtons" class="text-center mt-4" style="display: none;">
                                <button type="button" class="btn btn-success" id="saveFamilyMemberBtn" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">Actualizar datos</button>
                                <button type="button" class="btn btn-secondary" id="cancelEditBtn">Cancelar</button>
                            </div>   
                        </div>
                    </div>

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

                // Limpiar la lista de menores antes de hacer la solicitud AJAX
                $('#childrenList').empty();

                // Mostrar los menores si existen
                if (originalValues.minors.length > 0) {
                    originalValues.minors.forEach(function(minor) {
                        // Calcular la edad a partir de la fecha de nacimiento
                        let birthDate = new Date(minor.birth_date);
                        let today = new Date();
                        let age = today.getFullYear() - birthDate.getFullYear();
                        let monthDiff = today.getMonth() - birthDate.getMonth();

                        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                            age--;
                        }

                        // Iconos personalizados con color #9B7EBD
                        let idIcon = '<i class="fas fa-id-card" style="color: #9B7EBD;"></i>';
                        let birthIcon = '<i class="fas fa-birthday-cake" style="color: #9B7EBD;"></i>';
                        let locationIcon = '<i class="fas fa-map-marker-alt" style="color: #9B7EBD;"></i>';
                        let kinshipIcon = '<i class="fas fa-users" style="color: #9B7EBD;"></i>';

                        // Icono de sexo con colores específicos
                        let sexIcon = minor.sex_type 
                            ? '<i class="fas fa-mars" style="color: #007bff;"></i>'   // Azul para masculino
                            : '<i class="fas fa-venus" style="color: #ff69b4;"></i>'; // Rosa para femenino

                        // Estilo para resaltar nombres de mayores de 7 años con advertencia
                        let warningBox = age >= 7 ? `
                        <div class="alert alert-danger text-center" style="border-radius: 10px; font-weight: bold; margin-bottom: 10px;">
                            <i class="fas fa-exclamation-triangle warning-icon"></i> 
                            <span style="font-size: 16px;">${minor.given_name} tiene más de 7 años</span>
                        </div>` 
                        : '';

                        // Estilos de animación para la advertencia
                        let animationStyle = `
                            <style>
                                .warning-icon {
                                    font-size: 24px;
                                    animation: pulse 1s infinite;
                                }

                                @keyframes pulse {
                                    0% { transform: scale(1); }
                                    50% { transform: scale(1.3); }
                                    100% { transform: scale(1); }
                                }
                            </style>`;

                        // Presentación de información de menor de edad
                        let minorHTML = `
                            ${animationStyle}
                            <div class="card mt-3" style="border: none; border-radius: 12px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="card-header" style="background-color: #9B7EBD; color: white; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                                    <h6 class="card-title text-center mb-0">
                                        ${minor.given_name} ${minor.paternal_last_name} ${minor.maternal_last_name}
                                    </h6>
                                </div>
                                <div class="card-body" style="padding: 15px; background-color: #f9f9f9; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                                    ${warningBox}
                                    <table class="table table-borderless" style="font-size: 14px; margin-bottom: 0;">
                                        <tr>
                                            <td>${idIcon} <strong>Documento:</strong></td>
                                            <td>${minor.identity_document} N° ${minor.id}</td>
                                        </tr>
                                        <tr>
                                            <td>${birthIcon} <strong>Edad:</strong></td>
                                            <td>${age} años</td>
                                        </tr>
                                        <tr>
                                            <td>${sexIcon} <strong>Sexo:</strong></td>
                                            <td>${minor.sex_type ? 'Masculino' : 'Femenino'}</td>
                                        </tr>
                                        <tr>
                                            <td>${locationIcon} <strong>Dirección:</strong></td>
                                            <td>${minor.address}</td>
                                        </tr>
                                        <tr>
                                            <td>${kinshipIcon} <strong>Relación:</strong></td>
                                            <td>${minor.kinship}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>`;
                        $('#childrenList').append(minorHTML);
                    });
                } else {
                    $('#childrenList').append(`<li class="text-muted text-center">No hay menores asociados</li>`);
                }
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
@stop