@extends('adminlte::page')

@section('title', 'Editar Relación Persona-Intervención')

@section('content')
<!-- Imagen superior -->
<div class="d-flex justify-content-center align-items-center py-3" style="background: #c06c84; border-radius: 0 0 15px 15px;">
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
</div>
<div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
        <h3 class="card-title mb-0">Editar Relación Persona-Intervención</h3>
    </div>
    
    <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
        <form action="{{ route('am_person_interventions.update', $amPersonIntervention->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="am_person_id" class="font-weight-bold" style="color: #355c7d;">Seleccionar Persona</label>
                        <div class="input-group">
                            <select name="am_person_id" id="am_person_id" 
                                    class="form-control select2 shadow-sm" 
                                    style="border: 2px solid #c06c84; border-radius: 8px;" required>
                                <option value="">Buscar persona...</option>
                                @foreach ($amPersons as $person)
                                    <option value="{{ $person->id }}" 
                                        {{ $person->id == $amPersonIntervention->am_person_id ? 'selected' : '' }}>
                                        {{ $person->given_name }} {{ $person->paternal_last_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" 
                                        style="background: #f67280; border-color: #f67280; border-radius: 0 8px 8px 0;"
                                        data-toggle="modal" data-target="#addPersonModal">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="status" class="font-weight-bold" style="color: #355c7d;">Estado de la Intervención</label>
                        <select name="status" id="status" 
                                class="form-control shadow-sm" 
                                style="border: 2px solid #c06c84; border-radius: 8px;" required>
                            <option value="En progreso" {{ $amPersonIntervention->status == 'En progreso' ? 'selected' : '' }} style="color: #355c7d;">🟡 En progreso</option>
                            <option value="Completado" {{ $amPersonIntervention->status == 'Completado' ? 'selected' : '' }} style="color: #355c7d;">🟢 Completado</option>
                            <option value="Cancelado" {{ $amPersonIntervention->status == 'Cancelado' ? 'selected' : '' }} style="color: #355c7d;">🔴 Cancelado</option>
                        </select>
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="intervention_id" class="font-weight-bold" style="color: #355c7d;">Tipo de Intervención</label>
                        <div class="input-group">
                            <select name="intervention_id" id="intervention_id" 
                                    class="form-control select2 shadow-sm" 
                                    style="border: 2px solid #c06c84; border-radius: 8px;" required>
                                <option value="">Seleccionar intervención...</option>
                                @foreach ($interventions as $intervention)
                                    <option value="{{ $intervention->id }}" 
                                        {{ $intervention->id == $amPersonIntervention->intervention_id ? 'selected' : '' }}>
                                        {{ $intervention->appointment }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info" 
                                        style="background: #c06c84; border-color: #c06c84; border-radius: 0 8px 8px 0;"
                                        data-toggle="modal" data-target="#addInterventionModal">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="text-right mt-4">
                <button type="submit" class="btn btn-lg shadow-sm" 
                        style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;">
                    <i class="fas fa-save"></i> Actualizar
                </button>
                <a href="{{ route('am_person_interventions.index') }}" class="btn btn-lg btn-secondary shadow-sm" 
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
        .select2-container--default .select2-selection--single {
            border-radius: 8px !important;
            border: 2px solid #c06c84 !important;
            height: calc(1.5em + 1rem + 2px) !important;
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
            $('.select2').select2({
                width: '100%',
                placeholder: 'Seleccione una opción',
                allowClear: true
            });
        });
    </script>
@stop