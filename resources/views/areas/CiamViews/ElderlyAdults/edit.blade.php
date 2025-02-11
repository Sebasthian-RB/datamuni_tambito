@extends('adminlte::page')

@section('title', 'Editar Adulto Mayor')

@section('content_header')
<h1 style="color: #6E8E59;">Editar Adulto Mayor</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('elderly_adults.update', $elderlyAdult->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header" style="background-color: #708f3a; color: white;">
                <h3 class="card-title">Formulario para editar adulto mayor</h3>
            </div>
            <div class="card-body">

                <!-- Tipo de Documento -->
                <div class="form-group">
                    <label for="document_type">Tipo de Documento</label>
                    <select class="form-control" id="document_type" name="document_type" required>
                        <option value="DNI" {{ $elderlyAdult->document_type == 'DNI' ? 'selected' : '' }}>DNI</option>
                        <option value="Pasaporte" {{ $elderlyAdult->document_type == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                        <option value="Carnet" {{ $elderlyAdult->document_type == 'Carnet' ? 'selected' : '' }}>Carnet</option>
                        <option value="Cedula" {{ $elderlyAdult->document_type == 'Cedula' ? 'selected' : '' }}>Cédula</option>
                    </select>
                </div>

                <!-- Número de Documento -->
                <div class="form-group">
                    <label for="id">Número de Documento</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ $elderlyAdult->id }}" required>
                    @error('id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

            </div>
            <div class="card-footer" style="background-color: #9cbf5c;">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('elderly_adults.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop

@section('js')

<!--  JS -->

<!--  PARA EL TIPO DE DOCUMENTOS Y ID'S -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const documentTypeSelect = document.getElementById('document_type');
        const documentInput = document.getElementById('id');

        function updateValidation() {
            const selectedType = documentTypeSelect.value;

            // Mantiene el valor actual sin borrarlo
            let currentValue = documentInput.value;

            // Resetea restricciones
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

            // Mantiene el valor actual si cumple la validación
            documentInput.value = currentValue.slice(0, documentInput.getAttribute('maxlength'));
        }

        documentTypeSelect.addEventListener('change', updateValidation);

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

        // Aplica la validación cuando se carga la página
        updateValidation();
    });
</script>

@stop