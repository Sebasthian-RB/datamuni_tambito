@extends('adminlte::page')

@section('title', 'Editar Guardián')

@section('content_header')
<h1 style="color: #6E8E59;">Editar Guardián</h1>
@stop

@section('content')
<div class="card" style="background-color: #EAFAEA; border: 1px solid #6E8E59;">
    <div class="card-header" style="background-color: #6E8E59; color: white;">
        <h3 class="card-title">Formulario para editar un guardián</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('guardians.update', $guardian->id) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <!-- Campo para Tipo de Documento -->
            <div class="form-group">
                <label for="document_type" class="font-weight-bold" style="color: #6E8E59;">Tipo de Documento</label>
                <select id="document_type" name="document_type" class="form-control @error('document_type') is-invalid @enderror" required>
                    @foreach(['DNI', 'Pasaporte', 'Carnet', 'Cedula'] as $type)
                    <option value="{{ $type }}" {{ old('document_type', $guardian->document_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('document_type')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para el ID (Número de Documento) -->
            <div class="form-group">
                <label for="id" class="font-weight-bold" style="color: #6E8E59;">Número de Documento</label>
                <input type="text" id="id" name="id" class="form-control @error('id') is-invalid @enderror"
                    value="{{ old('id', $guardian->id) }}" placeholder="Ingrese el número de documento" required>
                @error('id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para Nombres -->
            <div class="form-group">
                <label for="given_name" class="font-weight-bold" style="color: #6E8E59;">Nombres</label>
                <input type="text" id="given_name" name="given_name" class="form-control @error('given_name') is-invalid @enderror"
                    value="{{ old('given_name', $guardian->given_name) }}" placeholder="Ingrese el nombre" required>
                @error('given_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para Apellido Paterno -->
            <div class="form-group">
                <label for="paternal_last_name" class="font-weight-bold" style="color: #6E8E59;">Apellido Paterno</label>
                <input type="text" id="paternal_last_name" name="paternal_last_name" class="form-control @error('paternal_last_name') is-invalid @enderror"
                    value="{{ old('paternal_last_name', $guardian->paternal_last_name) }}" placeholder="Ingrese el apellido paterno" required>
                @error('paternal_last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para Apellido Materno -->
            <div class="form-group">
                <label for="maternal_last_name" class="font-weight-bold" style="color: #6E8E59;">Apellido Materno</label>
                <input type="text" id="maternal_last_name" name="maternal_last_name" class="form-control @error('maternal_last_name') is-invalid @enderror"
                    value="{{ old('maternal_last_name', $guardian->maternal_last_name) }}" placeholder="Ingrese el apellido materno">
                @error('maternal_last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para Teléfono -->
            <div class="form-group">
                <label for="phone_number" class="font-weight-bold" style="color: #6E8E59;">Teléfono</label>
                <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
                    value="{{ old('phone_number', $guardian->phone_number) }}" placeholder="Ingrese el número de teléfono">
                @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para Relación con el Adulto Mayor -->
            <div class="form-group">
                <label for="relationship" class="font-weight-bold" style="color: #6E8E59;">Relación con el Adulto Mayor</label>
                <select id="relationship" name="relationship" class="form-control @error('relationship') is-invalid @enderror" required>
                    <option value="" disabled>Seleccione una relación</option>
                    @foreach(['Hijo/a', 'Esposo/a', 'Nieto/a', 'Hermano/a', 'Cuidador externo', 'Otro'] as $relation)
                    <option value="{{ $relation }}" {{ old('relationship', $guardian->relationship) == $relation ? 'selected' : '' }}>{{ $relation }}</option>
                    @endforeach
                </select>
                <input type="text" id="other_relationship" name="other_relationship" class="form-control mt-2 d-none"
                    placeholder="Ingrese otra relación">
                @error('relationship')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones de acción -->
            <div class="text-center">
                <button type="submit" class="btn" style="background-color: #6E8E59; color: white;">Actualizar</button>
                <a href="{{ route('guardians.index') }}" class="btn btn-secondary" style="background-color: #780C28; color: white;">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const documentType = document.getElementById('document_type');
        const idField = document.getElementById('id');
        const relationshipSelect = document.getElementById('relationship');
        const otherRelationshipField = document.getElementById('other_relationship');

        documentType.addEventListener('change', function() {
            let selectedType = this.value;
            if (selectedType === 'DNI') {
                idField.setAttribute('maxlength', '8');
                idField.setAttribute('pattern', '\\d{8}');
                idField.setAttribute('placeholder', 'Ingrese 8 dígitos');
            } else if (selectedType === 'Pasaporte' || selectedType === 'Carnet') {
                idField.setAttribute('maxlength', '20');
                idField.removeAttribute('pattern');
                idField.setAttribute('placeholder', 'Ingrese hasta 20 caracteres');
            } else if (selectedType === 'Cedula') {
                idField.setAttribute('maxlength', '10');
                idField.setAttribute('pattern', '\\d{10}');
                idField.setAttribute('placeholder', 'Ingrese 10 dígitos');
            }
        });

        relationshipSelect.addEventListener('change', function() {
            if (this.value === 'Otro') {
                otherRelationshipField.classList.remove('d-none');
                otherRelationshipField.setAttribute('required', 'true');
            } else {
                otherRelationshipField.classList.add('d-none');
                otherRelationshipField.removeAttribute('required');
            }
        });
    });
</script>

@stop