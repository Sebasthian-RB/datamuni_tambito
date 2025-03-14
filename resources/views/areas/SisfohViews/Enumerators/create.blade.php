@extends('adminlte::page')

@section('title', 'Listado de Encuestadores')

@section('content_header')
<!-- Imagen superior -->
<div class="py-3 d-flex justify-content-center align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')
<div class="shadow-lg card" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    <div class="text-white card-header bg-success" style="border-radius: 15px 15px 0 0;">
        <h3 class="mb-0 card-title">Ingresar Nuevo Empadronador(a)</h3>
    </div>
    
    <div class="card-body">
        <form action="{{ route('enumerators.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="given_name" class="font-weight-bold">Nombre</label>
                        <input type="text" id="given_name" name="given_name" class="form-control @error('given_name') is-invalid @enderror" value="{{ old('given_name') }}" required>
                        @error('given_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="paternal_last_name" class="font-weight-bold">Apellido Paterno</label>
                        <input type="text" id="paternal_last_name" name="paternal_last_name" class="form-control @error('paternal_last_name') is-invalid @enderror" value="{{ old('paternal_last_name') }}" required>
                        @error('paternal_last_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="maternal_last_name" class="font-weight-bold">Apellido Materno</label>
                        <input type="text" id="maternal_last_name" name="maternal_last_name" class="form-control @error('maternal_last_name') is-invalid @enderror" value="{{ old('maternal_last_name') }}" required>
                        @error('maternal_last_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="identity_document" class="font-weight-bold">Tipo de Documento</label>
                        <select id="identity_document" name="identity_document" class="form-control @error('identity_document') is-invalid @enderror" required>
                            <option value="DNI" @selected(old('identity_document') == 'DNI')>DNI</option>
                            <option value="Pasaporte" @selected(old('identity_document') == 'Pasaporte')>Pasaporte</option>
                            <option value="Carnet de Extranjería" @selected(old('identity_document') == 'Carnet de Extranjería')>Carnet de Extranjería</option>
                        </select>
                        @error('identity_document')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="id" class="font-weight-bold">Número de Documento</label>
                        <input type="text" id="id" name="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id') }}" required placeholder="Ingrese el número de documento">
                        <small id="idHelp" class="form-text text-muted">Formato según el tipo de documento.</small>
                        @error('id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="font-weight-bold">Número de Teléfono</label>
                        <input 
                            type="number" 
                            id="phone_number" 
                            name="phone_number" 
                            class="form-control @error('phone_number') is-invalid @enderror" 
                            value="{{ old('phone_number') }}" 
                            placeholder="Ingresa solo números"
                            min="0"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        @error('phone_number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Botones de Acción -->
            <div class="mt-4 text-right">
                <button type="submit" class="shadow-sm btn btn-success">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('enumerators.index') }}" class="ml-2 shadow-sm btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
<style>
    .card {
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .form-control:focus {
        border-color: #028a0f !important;
        box-shadow: 0 0 0 0.2rem rgba(2, 138, 15, 0.25) !important;
    }
</style>
@stop

@section('js')
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
@stop