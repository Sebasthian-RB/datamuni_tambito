@extends('adminlte::page')

@section('title', 'Agregar Adulto Mayor')

@section('content_header')
<h1>Agregar Adulto Mayor</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('elderly_adults.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header" style="background-color: #708f3a; color: white;">
                <h3 class="card-title">Formulario para agregar adulto mayor</h3>
            </div>
            <div class="card-body">

                <!-- ID -->
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id') }}" required>
                    @error('id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <!-- Tipo de Documento -->
                <div class="form-group">
                    <label for="document_type">Tipo de Documento</label>
                    <select class="form-control" id="document_type" name="document_type" required>
                        <option value="" disabled selected>Seleccione</option>
                        @foreach(['DNI', 'Pasaporte', 'Carnet', 'Cedula'] as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nombre y Apellidos -->
                <div class="form-group">
                    <label for="given_name">Nombres</label>
                    <input type="text" class="form-control" id="given_name" name="given_name" required>
                </div>
                <div class="form-group">
                    <label for="paternal_last_name">Apellido Paterno</label>
                    <input type="text" class="form-control" id="paternal_last_name" name="paternal_last_name" required>
                </div>
                <div class="form-group">
                    <label for="maternal_last_name">Apellido Materno</label>
                    <input type="text" class="form-control" id="maternal_last_name" name="maternal_last_name" required>
                </div>

                <!-- Fecha de Nacimiento -->
                <div class="form-group">
                    <label for="birth_date">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                </div>

                <!-- Sexo -->
                <div class="form-group">
                    <label>Sexo</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sex_type" value="1" required> Masculino
                        <input class="form-check-input" type="radio" name="sex_type" value="0"> Femenino
                    </div>
                </div>

                <!-- Teléfono -->
                <div class="form-group">
                    <label for="phone_number">Teléfono</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number">
                </div>

                <!-- Ubicación -->
                <div class="form-group">
                    <label for="department">Departamento</label>
                    <select id="department" class="form-control" name="department" required>
                        <option value="" disabled selected>Seleccione</option>
                        <option value="Junin">Junín</option>
                        <option value="Otro">Otro</option>
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

                <!-- Dirección y Referencia -->
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>
                <div class="form-group">
                    <label for="reference">Referencia</label>
                    <input type="text" class="form-control" id="reference" name="reference">
                </div>

                <!-- Tipo de Discapacidad -->
                <div class="form-group">
                    <label for="type_of_disability">Tipo de Discapacidad</label>
                    <select class="form-control" name="type_of_disability">
                        <option value="">Ninguna</option>
                        <option value="Visual">Visual</option>
                        <option value="Motriz">Motriz</option>
                        <option value="Mental">Mental</option>
                    </select>
                </div>

                <!-- Número de miembros del hogar -->
                <div class="form-group">
                    <label for="household_members">Número de Miembros en el Hogar</label>
                    <input type="number" class="form-control" name="household_members">
                </div>

                <!-- Atención Permanente -->
                <div class="form-group">
                    <label for="permanent_attention">Requiere Atención Permanente</label>
                    <input type="checkbox" name="permanent_attention" value="1">
                </div>

                <!-- Campo para buscar y seleccionar Guardián -->
                <div class="form-group">
                    <label for="guardian_search">Buscar Guardián</label>
                    <input type="text" class="form-control" id="guardian_search" placeholder="Escribe el nombre del guardián...">
                    <div id="guardian_list" class="list-group mt-2" style="max-height: 150px; overflow-y: auto; display: none;"></div>
                    <input type="hidden" name="guardian_id" id="guardian_id">
                </div>






                <!-- Observaciones -->
                <div class="form-group">
                    <label for="observation">Observaciones</label>
                    <textarea class="form-control" name="observation"></textarea>
                </div>

                <!-- Seguro Público -->
                <div class="form-group">
                    <label for="public_insurance">Seguro Público</label>
                    <select class="form-control" name="public_insurance">
                        <option value="">Sin seguro</option>
                        <option value="SIS">SIS</option>
                        <option value="ESSALUD">ESSALUD</option>
                    </select>
                </div>

                <!-- Seguro Privado -->
                <div class="form-group">
                    <label for="private_insurance">Seguro Privado</label>
                    <input type="text" class="form-control" name="private_insurance">
                </div>

                <!-- Programas Sociales -->
                <div class="form-group">
                    <label>Programas Sociales</label>
                    @foreach(['Pensión 65', 'Qali Warma'] as $program)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="social_programs[]" value="{{ $program }}">
                        <label class="form-check-label">{{ $program }}</label>
                    </div>
                    @endforeach
                </div>

                <!-- Estado -->
                <div class="form-group">
                    <label for="state">Estado</label>
                    <select class="form-control" name="state">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn" style="background-color: #708f3a; color: white;">Guardar</button>
                <a href="{{ route('elderly_adults.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop

@section('js')
<!-- Lista oculta con los guardianes ya cargados en la página -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let searchInput = document.getElementById('guardian_search');
        let resultList = document.getElementById('guardian_list');
        let guardianIdInput = document.getElementById('guardian_id');

        // Convertir los datos de Guardianes en un array de JavaScript
        let guardians = @json($guardians - > map(function($guardian) {
            return [
                'id' => $guardian - > id,
                'name' => $guardian - > given_name.
                ' '.$guardian - > paternal_last_name.
                ' '.$guardian - > maternal_last_name,
            ];
        }));

        searchInput.addEventListener('input', function() {
            let query = this.value.toLowerCase();

            if (query.length >= 2) {
                let filteredGuardians = guardians.filter(g =>
                    g.name.toLowerCase().includes(query)
                );

                resultList.innerHTML = '';
                resultList.style.display = filteredGuardians.length ? 'block' : 'none';

                filteredGuardians.forEach(guardian => {
                    let item = document.createElement('a');
                    item.href = '#';
                    item.classList.add('list-group-item', 'list-group-item-action');
                    item.textContent = guardian.name;
                    item.dataset.id = guardian.id;

                    item.addEventListener('click', function(event) {
                        event.preventDefault();
                        searchInput.value = this.textContent;
                        guardianIdInput.value = this.dataset.id;
                        resultList.style.display = 'none';
                    });

                    resultList.appendChild(item);
                });
            } else {
                resultList.innerHTML = '';
                resultList.style.display = 'none';
            }
        });
    });
</script>