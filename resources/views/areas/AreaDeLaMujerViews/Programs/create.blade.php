@extends('adminlte::page')

@section('title', 'Crear Programa')

@section('content_header')
<!-- Imagen superior -->
<div class="d-flex justify-content-center align-items-center py-3" style="background: #c06c84; border-radius: 0 0 15px 15px;">
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')
<div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
        <h3 class="card-title mb-0">Crear Nuevo Programa</h3>
    </div>
    
    <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
        <form action="{{ route('programs.store') }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="name" class="font-weight-bold" style="color: #355c7d;">Nombre del Programa</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
            </div>
            
            <div class="form-group mb-4">
                <label for="description" class="font-weight-bold" style="color: #355c7d;">Descripción</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
            </div>
            
            <div class="form-group mb-4">
                <label for="program_type" class="font-weight-bold" style="color: #355c7d;">Tipo de Programa</label>
                <input type="text" name="program_type" id="program_type" class="form-control" required value="{{ old('program_type') }}">
            </div>

            <div class="form-group mb-4">
                <label for="start_date" class="font-weight-bold" style="color: #355c7d;">Fecha de Inicio</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required value="{{ old('start_date') }}">
            </div>

            <div class="form-group mb-4">
                <label for="end_date" class="font-weight-bold" style="color: #355c7d;">Fecha de Fin</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
            </div>

            <div class="form-group mb-4">
                <label for="status" class="font-weight-bold" style="color: #355c7d;">Estado</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Pendiente" {{ old('status') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Finalizado" {{ old('status') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                    <option value="En proceso" {{ old('status') == 'En proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="Cancelado" {{ old('status') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>

            <!-- Botones de Acción -->
            <div class="text-right mt-4">
                <button type="submit" class="btn btn-lg shadow-sm" 
                        style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('programs.index') }}" class="btn btn-lg btn-secondary shadow-sm" 
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
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <style>
        .form-control:focus {
            border-color: #f67280 !important;
            box-shadow: 0 0 0 0.2rem rgba(246, 114, 128, 0.25) !important;
        }

        .card {
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }

        .select2-container--default .select2-selection--single {
            border-radius: 8px !important;
            border: 2px solid #c06c84 !important;
            height: calc(1.5em + 1rem + 2px) !important;
        }
    </style>
@stop
