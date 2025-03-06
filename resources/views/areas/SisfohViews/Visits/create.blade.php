@extends('adminlte::page')

@section('title', 'Crear Visita')

@section('content_header')
<!-- Imagen superior -->
<div class="py-3 d-flex justify-content-center align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')
<div class="shadow-lg card" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    <div class="text-white card-header bg-success" style="border-radius: 15px 15px 0 0;">
        <h3 class="mb-0 card-title">Ingresar Nueva Visita</h3>
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

        <form action="{{ route('visits.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="visit_date" class="font-weight-bold">Fecha de la Visita</label>
                        <input type="date" id="visit_date" name="visit_date" class="form-control @error('visit_date') is-invalid @enderror" value="{{ old('visit_date') }}" required>
                        @error('visit_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status" class="font-weight-bold">Estado</label>
                        <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="Visitado" {{ old('status') == 'Visitado' ? 'selected' : '' }}>Visitado</option>
                            <option value="No visitado" {{ old('status') == 'No visitado' ? 'selected' : '' }}>No visitado</option>
                            <option value="No encontrado" {{ old('status') == 'No encontrado' ? 'selected' : '' }}>No encontrado</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="enumerator_id" class="font-weight-bold">Enumerador</label>
                        <select id="enumerator_id" name="enumerator_id" class="form-control @error('enumerator_id') is-invalid @enderror" required>
                            <option value="" selected disabled>Selecciona un enumerador</option>
                            @foreach ($enumerators as $enumerator)
                                <option value="{{ $enumerator->id }}" {{ old('enumerator_id') == $enumerator->id ? 'selected' : '' }}>
                                    {{ $enumerator->given_name }} {{ $enumerator->paternal_last_name }} {{ $enumerator->maternal_last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('enumerator_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sfh_requests_id" class="font-weight-bold">Solicitud</label>
                        <select id="sfh_requests_id" name="sfh_requests_id" class="form-control @error('sfh_requests_id') is-invalid @enderror" required>
                            <option value="" selected disabled>Selecciona una solicitud</option>
                            @foreach ($requests as $request)
                                <option value="{{ $request->id }}" {{ old('sfh_requests_id') == $request->id ? 'selected' : '' }}>
                                    Solicitud #{{ $request->id }}
                                </option>
                            @endforeach
                        </select>
                        @error('sfh_requests_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="observations" class="font-weight-bold">Observaciones</label>
                        <textarea id="observations" name="observations" class="form-control @error('observations') is-invalid @enderror" rows="5" placeholder="Ingrese detalles adicionales sobre la visita">{{ old('observations') }}</textarea>
                        @error('observations')
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
                <a href="{{ route('visits.index') }}" class="ml-2 shadow-sm btn btn-secondary">
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
