@extends('adminlte::page')

@section('title', 'Editar Relación de Violencia')

@section('content_header')

    <!-- Imagen superior -->
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #f67280; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
@endsection

@section('content')


    <div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
        <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
            <h3 class="card-title mb-0">Editar Caso</h3>
        </div>

        <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
            <form action="{{ route('am_person_violences.update', $amPersonViolence->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Persona -->
                <div class="form-group mb-4">
                    <label for="am_person_id" class="font-weight-bold" style="color: #355c7d;">Persona</label>
                    <select name="am_person_id" id="am_person_id" class="form-control select2 shadow-sm"
                        style="border: 2px solid #c06c84; border-radius: 8px;" required>
                        @foreach ($amPersons as $person)
                            <option value="{{ $person->id }}"
                                {{ $person->id == $amPersonViolence->am_person_id ? 'selected' : '' }}>
                                {{ $person->given_name }} {{ $person->paternal_last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipo de Violencia -->
                <div class="form-group mb-4">
                    <label for="violence_id" class="font-weight-bold" style="color: #355c7d;">Tipo de Violencia</label>
                    <select name="violence_id" id="violence_id" class="form-control shadow-sm"
                        style="border: 2px solid #c06c84; border-radius: 8px;" required>
                        @foreach ($violences as $violence)
                            <option value="{{ $violence->id }}"
                                {{ $violence->id == $amPersonViolence->violence_id ? 'selected' : '' }}>
                                {{ $violence->kind_violence }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Fecha de Registro -->
                <div class="form-group mb-4">
                    <label for="registration_date" class="font-weight-bold" style="color: #355c7d;">Fecha de
                        Registro</label>
                    <input type="datetime-local" name="registration_date" id="registration_date"
                        value="{{ $amPersonViolence->registration_date->format('Y-m-d\TH:i') }}"
                        class="form-control shadow-sm" style="border: 2px solid #c06c84; border-radius: 8px;" required>
                </div>

                <!-- Botones de Acción -->
                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-lg shadow-sm"
                        style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                    <a href="{{ route('am_person_violences.index') }}" class="btn btn-lg btn-secondary shadow-sm"
                        style="border-radius: 8px;">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 36px;
            /* Ajusta la altura según tus necesidades */
            padding: 10px;
            font-size: 16px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 20px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 20px;
        }

        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .form-control:focus {
            border-color: #f67280 !important;
            box-shadow: 0 0 0 0.2rem rgba(246, 114, 128, 0.25) !important;
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2 en el campo Persona
            $('#am_person_id').select2({
                width: '100%', // Ocupa el 100% del ancho del contenedor
                placeholder: 'Seleccione una persona', // Placeholder para campos vacíos
                allowClear: true // Permitir limpiar la selección
            });
        });
    </script>
@stop
