@extends('adminlte::page')

@section('title', 'Crear Persona')

@section('content_header')
<!-- Imagen superior -->
<div class="py-3 d-flex justify-content-center align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')
<div class="shadow-lg card" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    <div class="text-white card-header bg-success" style="border-radius: 15px 15px 0 0;">
        <h3 class="mb-0 card-title">Ingresar Nueva Persona</h3>
    </div>
    
    <div class="card-body">
        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sfh_people.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="identity_document" class="font-weight-bold">Tipo de Documento</label>
                        <select id="identity_document" name="identity_document" class="form-control @error('identity_document') is-invalid @enderror" required>
                            <option value="" disabled selected>Seleccione un tipo de documento...</option>
                            <option value="DNI" {{ old('identity_document') == 'DNI' ? 'selected' : '' }}>DNI</option>
                            <option value="Pasaporte" {{ old('identity_document') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                            <option value="Carnet" {{ old('identity_document') == 'Carnet' ? 'selected' : '' }}>Carnet</option>
                            <option value="Cedula" {{ old('identity_document') == 'Cedula' ? 'selected' : '' }}>Cédula</option>
                        </select>
                        @error('identity_document')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="id" class="font-weight-bold">Número de Documento</label>
                        <input type="text" id="id" name="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id') }}" placeholder="Ingrese el número de documento" required>
                        @error('id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="given_name" class="font-weight-bold">Nombre</label>
                        <input type="text" id="given_name" name="given_name" class="form-control @error('given_name') is-invalid @enderror" value="{{ old('given_name') }}" placeholder="Ingrese el primer nombre" required>
                        @error('given_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="paternal_last_name" class="font-weight-bold">Apellido Paterno</label>
                        <input type="text" id="paternal_last_name" name="paternal_last_name" class="form-control @error('paternal_last_name') is-invalid @enderror" value="{{ old('paternal_last_name') }}" placeholder="Ingrese el apellido paterno" required>
                        @error('paternal_last_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="maternal_last_name" class="font-weight-bold">Apellido Materno</label>
                        <input type="text" id="maternal_last_name" name="maternal_last_name" class="form-control @error('maternal_last_name') is-invalid @enderror" value="{{ old('maternal_last_name') }}" placeholder="Ingrese el apellido materno" required>
                        @error('maternal_last_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marital_status" class="font-weight-bold">Estado Civil</label>
                        <select id="marital_status" name="marital_status" class="form-control @error('marital_status') is-invalid @enderror">
                            <option value="" disabled selected>Seleccione el estado civil...</option>
                            <option value="Soltero(a)" {{ old('marital_status') == 'Soltero(a)' ? 'selected' : '' }}>Soltero(a)</option>
                            <option value="Casado(a)" {{ old('marital_status') == 'Casado(a)' ? 'selected' : '' }}>Casado(a)</option>
                            <option value="Divorciado(a)" {{ old('marital_status') == 'Divorciado(a)' ? 'selected' : '' }}>Divorciado(a)</option>
                            <option value="Viudo(a)" {{ old('marital_status') == 'Viudo(a)' ? 'selected' : '' }}>Viudo(a)</option>
                        </select>
                        @error('marital_status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birth_date" class="font-weight-bold">Fecha de Nacimiento</label>
                        <input type="date" id="birth_date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}">
                        @error('birth_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sex_type" class="font-weight-bold">Sexo</label>
                        <select id="sex_type" name="sex_type" class="form-control @error('sex_type') is-invalid @enderror" required>
                            <option value="" disabled selected>Seleccione el sexo...</option>
                            <option value="0" {{ old('sex_type') == '0' ? 'selected' : '' }}>Femenino</option>
                            <option value="1" {{ old('sex_type') == '1' ? 'selected' : '' }}>Masculino</option>
                        </select>
                        @error('sex_type')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="font-weight-bold">Teléfono</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" placeholder="Ingrese el número de teléfono">
                        @error('phone_number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nationality" class="font-weight-bold">Nacionalidad</label>
                        <input type="text" id="nationality" name="nationality" class="form-control @error('nationality') is-invalid @enderror" value="{{ old('nationality') }}" placeholder="Ingrese la nacionalidad">
                        @error('nationality')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="degree" class="font-weight-bold">Grado Académico</label>
                        <select id="degree" name="degree" class="form-control @error('degree') is-invalid @enderror" required>
                            <option value="" disabled selected>Seleccione el grado académico...</option>
                            @foreach ($degrees as $degree)
                                <option value="{{ $degree }}" {{ old('degree') == $degree ? 'selected' : '' }}>{{ $degree }}</option>
                            @endforeach
                        </select>
                        @error('degree')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="occupation" class="font-weight-bold">Ocupación</label>
                        <input type="text" id="occupation" name="occupation" class="form-control @error('occupation') is-invalid @enderror" value="{{ old('occupation') }}" placeholder="Ingrese la ocupación">
                        @error('occupation')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sfh_category" class="font-weight-bold">Categoría SISFOH</label>
                        <select id="sfh_category" name="sfh_category" class="form-control @error('sfh_category') is-invalid @enderror" required>
                            <option value="" disabled selected>Seleccione una categoría...</option>
                            <option value="No pobre" {{ old('sfh_category') == 'No pobre' ? 'selected' : '' }}>No pobre</option>
                            <option value="Pobre" {{ old('sfh_category') == 'Pobre' ? 'selected' : '' }}>Pobre</option>
                            <option value="Pobre extremo" {{ old('sfh_category') == 'Pobre extremo' ? 'selected' : '' }}>Pobre extremo</option>
                        </select>
                        @error('sfh_category')
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
                <a href="{{ route('sfh_people.index') }}" class="ml-2 shadow-sm btn btn-secondary">
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
                break;
            case 'Pasaporte':
                idInput.removeAttribute('pattern');
                idInput.setAttribute('maxlength', '9');
                idInput.setAttribute('placeholder', 'Ingrese hasta 9 caracteres');
                break;
            case 'Carnet':
                idInput.setAttribute('pattern', '[A-Z0-9]{9}');
                idInput.setAttribute('maxlength', '9');
                idInput.setAttribute('placeholder', 'Ingrese 9 caracteres alfanuméricos');
                break;
            case 'Cedula':
                idInput.setAttribute('pattern', '[0-9]{12}');
                idInput.setAttribute('maxlength', '12');
                idInput.setAttribute('placeholder', 'Ingrese 12 dígitos');
                break;
            default:
                idInput.removeAttribute('pattern');
                idInput.removeAttribute('maxlength');
                idInput.setAttribute('placeholder', 'Ingrese el número de documento');
        }
    });
</script>
@stop
