@extends('adminlte::page')

@section('title', 'Agregar Menor')

@section('content_header')
    <h1>Agregar Menor</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('vl_minors.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header" style="background-color: #3B1E54; color: #FFFFFF;">
                <h3 class="card-title">Formulario para agregar menor</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="id">Número de Documento</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id') }}" required>
                    @error('id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="identity_document">Tipo de Documento</label>
                    <select class="form-control @error('identity_document') is-invalid @enderror" id="identity_document" name="identity_document" required>
                        <option value="" disabled selected>Seleccione un documento</option>
                        @foreach($documentTypes as $type)
                            <option value="{{ $type }}" {{ old('identity_document') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('identity_document')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="given_name">Nombre</label>
                    <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name" name="given_name" value="{{ old('given_name') }}" required>
                    @error('given_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="paternal_last_name">Apellido Paterno</label>
                    <input type="text" class="form-control @error('paternal_last_name') is-invalid @enderror" id="paternal_last_name" name="paternal_last_name" value="{{ old('paternal_last_name') }}" required>
                    @error('paternal_last_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="maternal_last_name">Apellido Materno</label>
                    <input type="text" class="form-control @error('maternal_last_name') is-invalid @enderror" id="maternal_last_name" name="maternal_last_name" value="{{ old('maternal_last_name') }}" required>
                    @error('maternal_last_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="birth_date">Fecha de Nacimiento</label>
                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                    @error('birth_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sex_type">Sexo</label>
                    <select class="form-control @error('sex_type') is-invalid @enderror" id="sex_type" name="sex_type" required>
                        <option value="" disabled selected>Seleccione el sexo</option>
                        @foreach($sexTypes as $key => $value)
                            <option value="{{ $key }}" {{ old('sex_type') === (string) $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('sex_type')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="registration_date">Fecha de Registro</label>
                    <input type="date" class="form-control @error('registration_date') is-invalid @enderror" id="registration_date" name="registration_date" value="{{ old('registration_date') }}" required>
                    @error('registration_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="withdrawal_date">Fecha de Retiro</label>
                    <input type="date" class="form-control @error('withdrawal_date') is-invalid @enderror" id="withdrawal_date" name="withdrawal_date" value="{{ old('withdrawal_date') }}">
                    @error('withdrawal_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dwelling_type">Tipo de Vivienda</label>
                    <select class="form-control @error('dwelling_type') is-invalid @enderror" id="dwelling_type" name="dwelling_type" required>
                        <option value="" disabled selected>Seleccione el tipo de vivienda</option>
                        @foreach($dwellingTypes as $type)
                            <option value="{{ $type }}" {{ old('dwelling_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('dwelling_type')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="education_level">Nivel Educativo</label>
                    <select class="form-control @error('education_level') is-invalid @enderror" id="education_level" name="education_level" required>
                        <option value="" disabled selected>Seleccione el nivel educativo</option>
                        @foreach($educationLevels as $level)
                            <option value="{{ $level }}" {{ old('education_level') == $level ? 'selected' : '' }}>{{ $level }}</option>
                        @endforeach
                    </select>
                    @error('education_level')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="condition">Condición</label>
                    <select class="form-control @error('condition') is-invalid @enderror" id="condition" name="condition" required>
                        <option value="" disabled selected>Seleccione la condición</option>
                        @foreach($conditions as $condition)
                            <option value="{{ $condition }}" {{ old('condition') == $condition ? 'selected' : '' }}>{{ $condition }}</option>
                        @endforeach
                    </select>
                    @error('condition')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="disability">Discapacidad</label>
                    <select class="form-control @error('disability') is-invalid @enderror" id="disability" name="disability" required>
                        <option value="" disabled {{ old('disability') === null ? 'selected' : '' }}>Seleccione si tiene discapacidad</option>
                        @foreach($disabilities as $key => $value)
                            <option value="{{ $key }}" {{ old('disability') === (string)$key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('disability')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>                                              

                <div class="form-group">
                    <!-- Primera fila: Título Familiar -->
                    <div class="row mb-3">
                        <label for="vl_family_member_id" class="col-sm-2 col-form-label">Familiar</label>
                    </div>
                
                    <!-- Segunda fila: Campos y botones en el orden solicitado -->
                    <div class="row">
                        <!-- Campo para ingresar el ID del Familiar -->
                        <div class="col-sm-3 col-12 mb-2 pr-1">
                            <select name="vl_family_member_id" id="vl_family_member_id" class="form-control select2 @error('vl_family_member_id') is-invalid @enderror" required>
                                <option value="">Seleccione un miembro de la familia</option>
                                @foreach($vlFamilyMembers as $member)
                                    <option value="{{ $member->id }}" 
                                        @if(old('vl_family_member_id') == $member->id) selected @endif>
                                        {{ $member->id }}  <!-- Mostrar solo el ID del miembro -->
                                    </option>
                                @endforeach
                            </select>                             
                            @error('vl_family_member_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botón de Agregar con icono -->
                        <div class="col-2 mb-2 pl-1">
                            <button type="button" class="btn btn-sm" style="background-color: #9B7EBD; color: white; height: 38px; width: 38px; padding: 0;" data-bs-toggle="modal" data-bs-target="#addFamilyMemberModal">
                                <i class="fas fa-plus"></i> <!-- Icono de agregar -->
                            </button>
                        </div>
                
                        <!-- Relación y su campo select en la misma fila -->
                        <div class="col-sm-4 col-12 d-flex align-items-center mb-2">
                            <label for="kinship" class="col-form-label mr-2">Relación:</label>
                        <select name="kinship" id="kinship" class="form-control @error('kinship') is-invalid @enderror" required>
                            <option value="" disabled selected>Seleccione una relación</option>
                            @foreach($kinships as $kinship)
                                <option value="{{ $kinship }}" {{ old('kinship') == $kinship ? 'selected' : '' }}>
                                    {{ $kinship }}
                                </option>
                            @endforeach
                        </select>
                        @error('kinship')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

                        </div>
                    </div>
                </div>                                                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">Guardar Menor</button>
                <a href="{{ route('vl_minors.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

<!-- Modal para Agregar Familiar -->
<div class="modal fade" id="addFamilyMemberModal" tabindex="-1" aria-labelledby="addFamilyMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3B1E54; color: #FFFFFF;">
                <h5 class="modal-title" id="addFamilyMemberModalLabel">Formulario para agregar miembro de familia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addFamilyMemberForm">
                    @csrf
                    <div class="form-group">
                        <label for="id">Número de Documento</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{ old('id') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="identity_document">Tipo de Documento</label>
                        <select class="form-control" id="identity_document" name="identity_document" required>
                            <option value="" disabled selected>Seleccione un tipo de documento</option>
                            @foreach($identityDocumentTypes as $key => $label)
                                <option value="{{ $key }}" {{ old('identity_document') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="given_name">Nombres</label>
                        <input type="text" class="form-control" id="given_name" name="given_name" value="{{ old('given_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="paternal_last_name">Apellido Paterno</label>
                        <input type="text" class="form-control" id="paternal_last_name" name="paternal_last_name" value="{{ old('paternal_last_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="maternal_last_name">Apellido Materno</label>
                        <input type="text" class="form-control" id="maternal_last_name" name="maternal_last_name" value="{{ old('maternal_last_name') }}" required>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <!-- El botón de enviar ahora debe activar el evento submit -->
                <button type="button" class="btn btn-success" style="background-color: #9B7EBD; color: white; border: #9B7EBD;" id="submitFormBtn">Guardar Miembro</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
            </div>
        </div>
    </div>
</div>

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
            // Convertimos los miembros familiares a formato JSON y los pasamos a una variable JS
            var vlFamilyMembers = @json($vlFamilyMembers);  // Convertimos la colección de miembros a un array de JavaScript

            // Inicializar Select2 con búsqueda local por ID
            $('#vl_family_member_id').select2({
                width: '100%',  // Asegura que ocupa el 100% del ancho del contenedor
                placeholder: 'Seleccione un miembro de la familia',  // Placeholder
                allowClear: true,  // Permitir limpiar la selección
                minimumInputLength: 1,  // Empieza la búsqueda después de 1 carácter
                data: function (params) {
                    var query = params.term.toLowerCase(); // Convertimos el término de búsqueda a minúsculas

                    // Filtramos los miembros cuya ID empieza con el término ingresado
                    var filteredMembers = vlFamilyMembers.filter(function (member) {
                        return member.id.toString().startsWith(query);  // Compara solo con el ID
                    });

                    // Verificamos si hay coincidencias y, en caso contrario, no devolver resultados
                    if (filteredMembers.length === 0) {
                        return { results: [{ id: '', text: 'No hay coincidencias' }] };
                    }

                    // Formateamos los resultados para que solo se muestre el ID
                    var results = filteredMembers.map(function (member) {
                        return {
                            id: member.id,
                            text: 'ID: ' + member.id  // Mostrar solo el ID en los resultados
                        };
                    });

                    return {
                        results: results
                    };
                },
                // Mostrar solo el ID en los resultados
                templateResult: function(data) {
                    return 'ID: ' + data.id;
                },
                // Mostrar solo el ID cuando se selecciona
                templateSelection: function(data) {
                    return 'ID: ' + data.id;
                }
            });
        });
    </script>
    <script>
        document.getElementById('submitFormBtn').addEventListener('click', function() {
            // Prevenir el envío normal del formulario
            var form = document.getElementById('addFamilyMemberForm');
            
            var formData = new FormData(form);
            var url = "{{ route('vl_family_members.store') }}"; // Ruta a la que se enviará la solicitud
    
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())  // Convertir la respuesta en formato JSON
            .then(data => {
                if (data.success) {
                    // Si la respuesta es exitosa, cerrar el modal y mostrar un mensaje
                    $('#addFamilyMemberModal').modal('hide');
    
                    // Obtener el select de los miembros familiares
                    var select = document.getElementById('vl_family_member_id');
    
                    // Crear un nuevo option con el ID del miembro agregado
                    var newOption = document.createElement('option');
                    newOption.value = data.id;  // El ID del nuevo miembro
                    newOption.textContent = 'ID: ' + data.id;  // Mostrar el ID en el texto de la opción
    
                    // Insertar la nueva opción en el select
                    select.appendChild(newOption);
    
                    // Establecer la opción recién agregada como seleccionada
                    select.value = data.id;
    
                    // Mostrar un mensaje de éxito
                    alert("Miembro de familia agregado exitosamente.");
                } else {
                    // Si hubo un error, mostrar el mensaje de error
                    alert("Hubo un error al guardar el miembro.");
                }
            })
            .catch(error => {
                // En caso de error, mostrar un mensaje
                console.error('Error:', error);
                alert('Hubo un problema al guardar el miembro.');
            });
        });
    
        // Este script se activará cuando se haga clic en el botón "Cancelar", cerrando el modal sin hacer nada
        document.querySelector('.btn-secondary').addEventListener('click', function() {
            $('#addFamilyMemberModal').modal('hide');
        });
    </script>    
@stop
