@extends('adminlte::page')

@section('title', 'Crear Solicitud')

@section('content_header')
<!-- Imagen superior -->
<div class="py-3 d-flex justify-content-center align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')
<div class="shadow-lg card" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    <div class="text-white card-header bg-success" style="border-radius: 15px 15px 0 0;">
        <h3 class="mb-0 card-title">Ingresar Nueva Solicitud</h3>
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

        <form action="{{ route('sfh_requests.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="request_date" class="font-weight-bold">Fecha de la Solicitud</label>
                        <input type="date" id="request_date" name="request_date" class="form-control @error('request_date') is-invalid @enderror" value="{{ old('request_date') }}" required>
                        @error('request_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sfh_person_id" class="font-weight-bold">Ciudadano Relacionado</label>
                        <select id="sfh_person_id" name="sfh_person_id" class="form-control @error('sfh_person_id') is-invalid @enderror" required>
                            <option value="" selected disabled>Selecciona una persona</option>
                            @foreach($people as $person)
                                <option value="{{ $person->id }}" {{ old('sfh_person_id') == $person->id ? 'selected' : '' }}>
                                    {{ $person->given_name }} {{ $person->paternal_last_name }} {{ $person->maternal_last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('sfh_person_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description" class="font-weight-bold">Motivo</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Ingrese detalles adicionales sobre la solicitud">{{ old('description') }}</textarea>
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
                <a href="{{ route('sfh_requests.index') }}" class="ml-2 shadow-sm btn btn-secondary">
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
