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
    <label for="document_type" style="color: #6E8E59;">Tipo de Documento</label>
    <select id="document_type" name="document_type" class="form-control @error('document_type') is-invalid @enderror" required>
        <option value="" disabled>Seleccione</option>
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
    <label for="id" style="color: #6E8E59;">Número de Documento</label>
    <input type="text" id="id" name="id" class="form-control @error('id') is-invalid @enderror"
        value="{{ old('id', $guardian->id) }}" placeholder="Seleccione tipo de documento primero" required>
    @error('id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    <small id="idHelp" class="form-text text-muted"></small>
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
                @error('relationship')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para ingresar otra relación si se selecciona "Otro" -->
            <div class="form-group {{ old('relationship', $guardian->relationship) === 'Otro' ? '' : 'd-none' }}" id="other_relationship_div">
                <label for="other_relationship" style="color: #6E8E59;">Especifique otra relación</label>
                <input type="text" id="other_relationship" name="other_relationship" class="form-control"
                    value="{{ old('other_relationship', $guardian->other_relationship ?? '') }}" placeholder="Ingrese otra relación">
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
        const relationshipSelect = document.getElementById('relationship');
        const otherRelationshipDiv = document.getElementById('other_relationship_div');
        const otherRelationshipInput = document.getElementById('other_relationship');

        function toggleOtherRelationship() {
            if (relationshipSelect.value === 'Otro') {
                otherRelationshipDiv.classList.remove('d-none');
                otherRelationshipInput.setAttribute('required', 'true');
            } else {
                otherRelationshipDiv.classList.add('d-none');
                otherRelationshipInput.removeAttribute('required');
                otherRelationshipInput.value = ''; // Limpiar el campo
            }
        }

        relationshipSelect.addEventListener('change', toggleOtherRelationship);
        toggleOtherRelationship(); // Ejecutar al cargar la página
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const documentType = document.getElementById('document_type');
    const idInput = document.getElementById('id');
    const idHelp = document.getElementById('idHelp');
    
    function updateInputRestrictions() {
        const selectedType = documentType.value;
        
        switch(selectedType) {
            case 'DNI':
                idInput.maxLength = 8;
                idInput.pattern = '[0-9]*';
                idInput.placeholder = 'Ingrese 8 dígitos numéricos';
                idInput.title = 'Solo se permiten números (8 dígitos)';
                idHelp.textContent = 'Solo se permiten números (8 dígitos)';
                break;
            case 'Pasaporte':
                idInput.maxLength = 9;
                idInput.pattern = '[A-Za-z0-9]*';
                idInput.placeholder = 'Ingrese 9 caracteres alfanuméricos';
                idInput.title = 'Se permiten letras y números (9 caracteres)';
                idHelp.textContent = 'Se permiten letras y números (9 caracteres)';
                break;
            case 'Carnet':
                idInput.maxLength = 12;
                idInput.pattern = '[0-9]*';
                idInput.placeholder = 'Ingrese 12 dígitos numéricos';
                idInput.title = 'Solo se permiten números (12 dígitos)';
                idHelp.textContent = 'Solo se permiten números (12 dígitos)';
                break;
            case 'Cedula':
                idInput.maxLength = 10;
                idInput.pattern = '[0-9]*';
                idInput.placeholder = 'Ingrese 10 dígitos numéricos';
                idInput.title = 'Solo se permiten números (10 dígitos)';
                idHelp.textContent = 'Solo se permiten números (10 dígitos)';
                break;
            default:
                idInput.maxLength = 12;
                idInput.pattern = '[A-Za-z0-9]*';
                idInput.placeholder = 'Seleccione tipo de documento primero';
                idHelp.textContent = '';
        }
    }
    
    documentType.addEventListener('change', updateInputRestrictions);
    
    // Validar en tiempo real mientras se escribe
    idInput.addEventListener('input', function() {
        const selectedType = documentType.value;
        const regex = selectedType === 'Pasaporte' ? /[^A-Za-z0-9]/g : /[^0-9]/g;
        this.value = this.value.replace(regex, '');
    });
    
    // Inicializar según el valor actual del guardián
    updateInputRestrictions();
});
</script>
@stop