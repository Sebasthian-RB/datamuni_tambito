@extends('adminlte::page')

@section('title', 'Editar Adulto Mayor')

@section('content_header')
<h1>Editar Adulto Mayor</h1>
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

                <!-- ID (No editable) -->
                <div class="form-group">
                    <label for="id">ID del Adulto Mayor</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $elderlyAdult->id }}" readonly>
                </div>

                <!-- Tipo de Documento -->
                <div class="form-group">
                    <label for="document_type">Tipo de Documento</label>
                    <select class="form-control" id="document_type" name="document_type" required>
                        @foreach(['DNI', 'Pasaporte', 'Carnet', 'Cedula'] as $type)
                        <option value="{{ $type }}" {{ $elderlyAdult->document_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nombres y Apellidos -->
                <div class="form-group">
                    <label for="given_name">Nombres</label>
                    <input type="text" class="form-control" id="given_name" name="given_name" value="{{ $elderlyAdult->given_name }}" required>
                </div>

                <div class="form-group">
                    <label for="paternal_last_name">Apellido Paterno</label>
                    <input type="text" class="form-control" id="paternal_last_name" name="paternal_last_name" value="{{ $elderlyAdult->paternal_last_name }}" required>
                </div>

                <div class="form-group">
                    <label for="maternal_last_name">Apellido Materno</label>
                    <input type="text" class="form-control" id="maternal_last_name" name="maternal_last_name" value="{{ $elderlyAdult->maternal_last_name }}" required>
                </div>

                <!-- Fecha de Nacimiento -->
                <div class="form-group">
                    <label for="birth_date">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $elderlyAdult->birth_date->format('Y-m-d') }}" required>
                </div>

                <!-- Ubicación -->
                <div class="form-group">
                    <label for="department">Departamento</label>
                    <select id="department" class="form-control" name="department" required>
                        <option value="Junin" {{ $elderlyAdult->department == 'Junin' ? 'selected' : '' }}>Junín</option>
                        <option value="Otro" {{ $elderlyAdult->department == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="province">Provincia</label>
                    <select id="province" class="form-control" name="province" required></select>
                </div>

                <div class="form-group">
                    <label for="district">Distrito</label>
                    <select id="district" class="form-control" name="district" required></select>
                </div>

                <!-- Teléfono -->
                <div class="form-group">
                    <label for="phone_number">Teléfono</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $elderlyAdult->phone_number }}">
                </div>

                <!-- Seguro Público -->
                <div class="form-group">
                    <label for="public_insurance">Seguro Público</label>
                    <select class="form-control" name="public_insurance">
                        <option value="" {{ !$elderlyAdult->public_insurance ? 'selected' : '' }}>Sin seguro</option>
                        <option value="SIS" {{ $elderlyAdult->public_insurance == 'SIS' ? 'selected' : '' }}>SIS</option>
                        <option value="ESSALUD" {{ $elderlyAdult->public_insurance == 'ESSALUD' ? 'selected' : '' }}>ESSALUD</option>
                    </select>
                </div>

                <!-- Seguro Privado -->
                <div class="form-group">
                    <label for="private_insurance">Seguro Privado</label>
                    <input type="text" class="form-control" name="private_insurance" value="{{ $elderlyAdult->private_insurance }}">
                </div>

                <!-- Programas Sociales (Checkbox) -->
                <div class="form-group">
                    <label>Programas Sociales</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="social_programs[]" value="Pensión 65" {{ in_array('Pensión 65', $elderlyAdult->social_programs ?? []) ? 'checked' : '' }}>
                        <label class="form-check-label">Pensión 65</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="social_programs[]" value="Qali Warma" {{ in_array('Qali Warma', $elderlyAdult->social_programs ?? []) ? 'checked' : '' }}>
                        <label class="form-check-label">Qali Warma</label>
                    </div>
                </div>

                <!-- Estado del Adulto Mayor -->
                <div class="form-group">
                    <label for="state">Estado</label>
                    <select class="form-control" name="state">
                        <option value="1" {{ $elderlyAdult->state == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $elderlyAdult->state == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

            </div>
            <div class="card-footer" style="background-color: #9cbf5c;">
                <button type="submit" class="btn" style="background-color: #708f3a; color: white;">Actualizar</button>
                <a href="{{ route('elderly_adults.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById("department").addEventListener("change", function() {
        let provinces = {
            "Junin": ["Huancayo", "Tarma", "Jauja"],
            "Otro": ["Otro"]
        };

        let selectedDep = this.value;
        let provinceSelect = document.getElementById("province");
        let districtSelect = document.getElementById("district");

        provinceSelect.innerHTML = "";
        let districts = provinces[selectedDep] || [];
        districts.forEach(prov => {
            let option = document.createElement("option");
            option.value = prov;
            option.textContent = prov;
            provinceSelect.appendChild(option);
        });

        districtSelect.innerHTML = "";
    });
</script>
@stop