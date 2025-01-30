@extends('adminlte::page')

@section('title', 'Editar Intervención')

@section('content_header')
    <!-- Imagen superior -->
    <div class="d-flex justify-content-center align-items-center py-3" style="background: #c06c84; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
    </div>
@stop

@section('content')
<div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
        <h3 class="card-title mb-0">Editar Intervención</h3>
    </div>
    
    <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
        <form action="{{ route('interventions.update', $intervention->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-4">
                <label for="appointment" class="font-weight-bold" style="color: #355c7d;">Cita</label>
                <textarea name="appointment" id="appointment" class="form-control" rows="3" required>{{ old('appointment', $intervention->appointment) }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="derivation" class="font-weight-bold" style="color: #355c7d;">Derivación</label>
                <textarea name="derivation" id="derivation" class="form-control" rows="3">{{ old('derivation', $intervention->derivation) }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="appointment_date" class="font-weight-bold" style="color: #355c7d;">Fecha de la Cita</label>
                <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control" required value="{{ old('appointment_date', $intervention->appointment_date->format('Y-m-d\TH:i')) }}">
            </div>

            <div class="text-right mt-4">
                <button type="submit" class="btn btn-lg shadow-sm" style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;">
                    <i class="fas fa-save"></i> Actualizar
                </button>
                <a href="{{ route('interventions.index') }}" class="btn btn-lg btn-secondary shadow-sm" style="border-radius: 8px;">
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
