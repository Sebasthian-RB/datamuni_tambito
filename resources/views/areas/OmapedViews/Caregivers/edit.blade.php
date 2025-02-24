@extends('adminlte::page')

@section('title', 'Editar Cuidador')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3" 
         style="background: #930813; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" 
             alt="Escudo El Tambo" class="img-fluid" 
             style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="card shadow-lg" 
         style="border-radius: 15px; max-width: 800px; margin: 2rem auto; border-left: 5px solid #99050f;">
        
        <!-- Encabezado -->
        <div class="card-header text-center" 
             style="background: #f00e1c; color: white; border-radius: 15px 15px 0 0;">
            <h3 class="card-title mb-0">Editar Cuidador</h3>
        </div>

        <!-- Cuerpo -->
        <div class="card-body" 
             style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%); padding: 2rem;">
            
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

                <div class="row">
                    <!-- Nombre Completo -->
                    <div class="col-md-6 form-group">
                        <label for="full_name"><strong>Nombre Completo</strong></label>
                        <input type="text" name="full_name" id="full_name" 
                               class="form-control @error('full_name') is-invalid @enderror" 
                               value="{{ old('full_name', $caregiver->full_name) }}" required 
                               oninput="formatName(this)">
                        @error('full_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Relación -->
                    <div class="col-md-6 form-group">
                        <label for="relationship"><strong>Relación</strong></label>
                        <select name="relationship" id="relationship" 
                                class="form-control @error('relationship') is-invalid @enderror" required>
                            <option value="">Seleccione...</option>
                            <option value="Padre" {{ old('relationship', $caregiver->relationship) == 'Padre' ? 'selected' : '' }}>Padre</option>
                            <option value="Madre" {{ old('relationship', $caregiver->relationship) == 'Madre' ? 'selected' : '' }}>Madre</option>
                            <option value="Hermano/a" {{ old('relationship', $caregiver->relationship) == 'Hermano/a' ? 'selected' : '' }}>Hermano/a</option>
                            <option value="Tío/a" {{ old('relationship', $caregiver->relationship) == 'Tío/a' ? 'selected' : '' }}>Tío/a</option>
                            <option value="Abuelo/a" {{ old('relationship', $caregiver->relationship) == 'Abuelo/a' ? 'selected' : '' }}>Abuelo/a</option>
                            <option value="Tutor/a" {{ old('relationship', $caregiver->relationship) == 'Tutor/a' ? 'selected' : '' }}>Tutor/a</option>
                            <option value="Otro" {{ old('relationship', $caregiver->relationship) == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('relationship')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- DNI -->
                    <div class="col-md-6 form-group">
                        <label for="dni"><strong>DNI</strong></label>
                        <input type="text" name="dni" id="dni" 
                               class="form-control @error('dni') is-invalid @enderror" 
                               value="{{ old('dni', $caregiver->dni) }}" maxlength="8" required 
                               pattern="\d{8}" title="Debe contener exactamente 8 dígitos"
                               onkeypress="return soloNumeros(event)">
                        @error('dni')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-6 form-group">
                        <label for="phone"><strong>Teléfono</strong></label>
                        <input type="text" name="phone" id="phone" 
                               class="form-control @error('phone') is-invalid @enderror" 
                               value="{{ old('phone', $caregiver->phone) }}" maxlength="9" required
                               pattern="\d{9}" title="Debe contener exactamente 9 dígitos"
                               onkeypress="return soloNumeros(event)">
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="text-center mt-4">
                    <a href="javascript:history.back()" class="btn btn-custom">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-custom">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <style>
        .btn-custom {
            background-color: #930813;
            border: 1px solid #930813;
            color: white;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .btn-custom:hover {
            background-color: #50030a;
            color: #fff;
        }

        .card {
            transition: transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
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
