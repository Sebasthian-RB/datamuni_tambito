<!-- resources/views/sisfoh/enumerators/edit.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Encuestador</h1>
    
    <form action="{{ route('enumerators.update', $enumerator->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Tipo de Documento -->
        <div class="form-group">
            <label for="identity_document">Tipo de Documento</label>
            <select id="identity_document" name="identity_document" class="form-control" required>
                <option value="DNI" {{ $enumerator->identity_document === 'DNI' ? 'selected' : '' }}>DNI</option>
                <option value="Pasaporte" {{ $enumerator->identity_document === 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                <option value="Carnet de Extranjería" {{ $enumerator->identity_document === 'Carnet de Extranjería' ? 'selected' : '' }}>Carnet de Extranjería</option>
            </select>
        </div>

        <!-- ID del Documento -->
        <div class="form-group">
            <label for="id">Número de Documento</label>
            <input type="text" id="id" name="id" class="form-control" 
                value="{{ $enumerator->id }}" 
                required placeholder="Ingrese el número de documento">
            <small id="idHelp" class="form-text text-muted">Formato según el tipo de documento.</small>
        </div>

        <!-- Nombre -->
        <div class="form-group">
            <label for="given_name">Nombre</label>
            <input type="text" id="given_name" name="given_name" class="form-control" 
                value="{{ $enumerator->given_name }}" required>
        </div>

        <!-- Apellido Paterno -->
        <div class="form-group">
            <label for="paternal_last_name">Apellido Paterno</label>
            <input type="text" id="paternal_last_name" name="paternal_last_name" class="form-control" 
                value="{{ $enumerator->paternal_last_name }}" required>
        </div>

        <!-- Apellido Materno -->
        <div class="form-group">
            <label for="maternal_last_name">Apellido Materno</label>
            <input type="text" id="maternal_last_name" name="maternal_last_name" class="form-control" 
                value="{{ $enumerator->maternal_last_name }}" required>
        </div>

        <!-- Teléfono -->
        <div class="form-group">
            <label for="phone_number">Número de Teléfono</label>
            <input type="tel" id="phone_number" name="phone_number" class="form-control" 
                pattern="[0-9]{9}" placeholder="123456789" 
                value="{{ $enumerator->phone_number }}" required>
        </div>

        <!-- Botón -->
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('enumerators.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    // Cambiar el placeholder y validación del ID según el tipo de documento seleccionado
    document.getElementById('identity_document').addEventListener('change', function () {
        const idInput = document.getElementById('id');
        const idHelp = document.getElementById('idHelp');

        switch (this.value) {
            case 'DNI':
                idInput.setAttribute('pattern', '[0-9]{8}');
                idInput.setAttribute('maxlength', '8');
                idInput.setAttribute('placeholder', 'Ingrese 8 dígitos');
                idHelp.textContent = 'Debe contener 8 dígitos.';
                break;
            case 'Pasaporte':
                idInput.removeAttribute('pattern');
                idInput.setAttribute('maxlength', '9');
                idInput.setAttribute('placeholder', 'Ingrese hasta 9 caracteres');
                idHelp.textContent = 'Puede contener hasta 9 caracteres alfanuméricos.';
                break;
            case 'Carnet de Extranjería':
                idInput.setAttribute('pattern', '[A-Z0-9]{9}');
                idInput.setAttribute('maxlength', '9');
                idInput.setAttribute('placeholder', 'Ingrese 9 caracteres alfanuméricos');
                idHelp.textContent = 'Debe contener exactamente 9 caracteres alfanuméricos.';
                break;
            default:
                idInput.removeAttribute('pattern');
                idInput.removeAttribute('maxlength');
                idInput.setAttribute('placeholder', 'Ingrese el número de documento');
                idHelp.textContent = 'Formato según el tipo de documento.';
        }
    });
</script>
@endsection
