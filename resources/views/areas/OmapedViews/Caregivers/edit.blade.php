@extends('adminlte::page')

@section('title', 'Editar Cuidador')

@section('content_header')
    <h1>Editar Cuidador</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('caregivers.update', $caregiver) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nombre Completo (Transforma a Título) -->
            <div class="form-group">
                <label for="full_name">Nombre Completo</label>
                <input type="text" class="form-control" id="full_name" name="full_name" 
                    value="{{ old('full_name', $caregiver->full_name) }}" required 
                    oninput="formatName(this)">
            </div>

            <!-- Relación (Opciones Predefinidas) -->
            <div class="form-group">
                <label for="relationship">Relación</label>
                <select class="form-control" id="relationship" name="relationship" required>
                    <option value="">Seleccione...</option>
                    <option value="Padre" {{ old('relationship', $caregiver->relationship) == 'Padre' ? 'selected' : '' }}>Padre</option>
                    <option value="Madre" {{ old('relationship', $caregiver->relationship) == 'Madre' ? 'selected' : '' }}>Madre</option>
                    <option value="Hermano/a" {{ old('relationship', $caregiver->relationship) == 'Hermano/a' ? 'selected' : '' }}>Hermano/a</option>
                    <option value="Tío/a" {{ old('relationship', $caregiver->relationship) == 'Tío/a' ? 'selected' : '' }}>Tío/a</option>
                    <option value="Abuelo/a" {{ old('relationship', $caregiver->relationship) == 'Abuelo/a' ? 'selected' : '' }}>Abuelo/a</option>
                    <option value="Tutor/a" {{ old('relationship', $caregiver->relationship) == 'Tutor/a' ? 'selected' : '' }}>Tutor/a</option>
                    <option value="Otro" {{ old('relationship', $caregiver->relationship) == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            <!-- DNI (Solo Números, Máximo 8 Dígitos) -->
            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" 
                    value="{{ old('dni', $caregiver->dni) }}" maxlength="8" required 
                    pattern="\d{8}" title="Debe contener exactamente 8 dígitos"
                    onkeypress="return soloNumeros(event)">
            </div>

            <!-- Teléfono (Solo Números, Exactamente 9 Dígitos) -->
            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="text" class="form-control" id="phone" name="phone" 
                    value="{{ old('phone', $caregiver->phone) }}" maxlength="9" required
                    pattern="\d{9}" title="Debe contener exactamente 9 dígitos"
                    onkeypress="return soloNumeros(event)">
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Guardar Cambios
            </button>
            <a href="{{ route('caregivers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </form>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css">
@stop

@section('js')
    <script>
        console.log('Formulario de Editar Cuidador cargado.');

        // Solo permite ingresar números en DNI y Teléfono
        function soloNumeros(event) {
            return event.charCode >= 48 && event.charCode <= 57;
        }

        // Convierte nombres a "Título" (Ejemplo: "Juan Pérez")
        function formatName(input) {
            input.value = input.value.toLowerCase()
                .replace(/\b\w/g, c => c.toUpperCase());
        }
    </script>
@stop
