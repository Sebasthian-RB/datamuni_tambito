@extends('adminlte::page')

@section('title', 'Crear Instrumento')

@section('content_header')
<!-- Imagen superior -->
<div class="py-3 d-flex justify-content-center align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')
<div class="shadow-lg card" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    <div class="text-white card-header bg-success" style="border-radius: 15px 15px 0 0;">
        <h3 class="mb-0 card-title">Ingresar Nuevo Instrumento</h3>
    </div>
    
    <div class="card-body">
        <form action="{{ route('instruments.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name_instruments" class="font-weight-bold">Nombre del Instrumento</label>
                        <input type="text" id="name_instruments" name="name_instruments" class="form-control @error('name_instruments') is-invalid @enderror" value="{{ old('name_instruments') }}" required placeholder="Ejemplo: Encuesta">
                        @error('name_instruments')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type_instruments" class="font-weight-bold">Tipo de Instrumento</label>
                        <select id="type_instruments" name="type_instruments" class="form-control @error('type_instruments') is-invalid @enderror" required>
                            <option value="Medición" @selected(old('type_instruments') == 'Medición')>Medición</option>
                            <option value="Prueba" @selected(old('type_instruments') == 'Prueba')>Prueba</option>
                            <option value="Calibración" @selected(old('type_instruments') == 'Calibración')>Calibración</option>
                        </select>
                        @error('type_instruments')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description" class="font-weight-bold">Descripción</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Ingrese detalles adicionales sobre el instrumento">{{ old('description') }}</textarea>
                        @error('description')
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
                <a href="{{ route('instruments.index') }}" class="ml-2 shadow-sm btn btn-secondary">
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
    // Script adicional si es necesario
</script>
@stop