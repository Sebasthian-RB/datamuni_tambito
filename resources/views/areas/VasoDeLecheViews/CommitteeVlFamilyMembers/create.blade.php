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
        }

        /* Ajustar el padding para el texto */
        .select2-container--default .select2-selection__rendered {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }

        /* Ajuste del dropdown de opciones */
        .select2-dropdown {
            max-height: 300px !important; /* Define la altura máxima */
            overflow-y: auto !important; /* Permite el scroll si es necesario */
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
                                    {{ old('vl_family_member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->id }}
                                </option>
                            @endforeach

                        </select>
                        @error('vl_family_member_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div id="family-member-details" class="card p-3" style="display: none; background-color: #FFFFFF; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0,0,0,0.1);">
                        <h5 class="text-center" style="background-color: #3B1E54; color: #FFFFFF; padding: 10px 15px; border-radius: 6px; margin-bottom: 25px; font-size: 16px;">Detalles del Familiar</h5>
                    
                        <div class="row">
                            <!-- Columna izquierda: ID, Documento y Nombres -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="member_id" style="color: #3B1E54; font-weight: 600;">ID</label>
                                    <input type="text" class="form-control" id="member_id" disabled style="background-color: #EEEEEE; border: 1px solid #9B7EBD; border-radius: 5px; padding: 10px; font-size: 14px;">
                                </div>
                            </div>
                    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="identity_document" style="color: #3B1E54; font-weight: 600;">Documento</label>
                                    <input type="text" class="form-control" id="identity_document" disabled style="background-color: #EEEEEE; border: 1px solid #9B7EBD; border-radius: 5px; padding: 10px; font-size: 14px;">
                                </div>
                            </div>
                    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="given_name" style="color: #3B1E54; font-weight: 600;">Nombres</label>
                                    <input type="text" class="form-control" id="given_name" disabled style="background-color: #EEEEEE; border: 1px solid #9B7EBD; border-radius: 5px; padding: 10px; font-size: 14px;">
                                </div>
                            </div>
                        </div>
                    
                        <div class="row mt-3">
                            <!-- Columna derecha: Apellidos -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paternal_last_name" style="color: #3B1E54; font-weight: 600;">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="paternal_last_name" disabled style="background-color: #EEEEEE; border: 1px solid #9B7EBD; border-radius: 5px; padding: 10px; font-size: 14px;">
                                </div>
                            </div>
                    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maternal_last_name" style="color: #3B1E54; font-weight: 600;">Apellido Materno</label>
                                    <input type="text" class="form-control" id="maternal_last_name" disabled style="background-color: #EEEEEE; border: 1px solid #9B7EBD; border-radius: 5px; padding: 10px; font-size: 14px;">
                                </div>
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
            $('#vl_family_member_id').select2();
            $('#vl_family_member_id').on('change', function() {
                const selected = $(this).find(':selected');
                $('#member_id').val(selected.data('id'));
                $('#identity_document').val(selected.data('identity'));
                $('#given_name').val(selected.data('given-name'));
                $('#paternal_last_name').val(selected.data('paternal'));
                $('#maternal_last_name').val(selected.data('maternal'));
                $('#family-member-details').show();
            });
        });
    </script>
@stop