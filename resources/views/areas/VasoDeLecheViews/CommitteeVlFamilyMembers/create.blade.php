@extends('adminlte::page')

@section('title', 'Agregar Miembro al Comité')

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
                    <select class="form-control @error('vl_family_member_id') is-invalid @enderror" id="vl_family_member_id" name="vl_family_member_id" required>
                        <option value="" disabled selected>Seleccione un miembro de familia</option>
                        @foreach($vlFamilyMembers as $member)
                            <option value="{{ $member->id }}" {{ old('vl_family_member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->given_name }} {{ $member->paternal_last_name }} {{ $member->maternal_last_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('vl_family_member_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
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


@stop
