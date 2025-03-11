@extends('adminlte::page')

@section('title', 'Crear Nueva Vivienda')

@section('content_header')
<!-- Imagen superior -->
<div class="py-3 d-flex justify-content-center align-items-center" style="background: #028a0f; border-radius: 0 0 0px 0px;">
    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
</div>
@stop

@section('content')
<div class="shadow-lg card" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
    <div class="text-white card-header bg-success" style="border-radius: 15px 15px 0 0;">
        <h3 class="mb-0 card-title">Ingresar Nueva Vivienda</h3>
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

        <form action="{{ route('sfh_dwelling.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="street_address" class="font-weight-bold">Dirección</label>
                        <input type="text" id="street_address" name="street_address" class="form-control @error('street_address') is-invalid @enderror" value="{{ old('street_address') }}" required placeholder="Ejemplo: Av. Los Álamos 123">
                        @error('street_address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="reference" class="font-weight-bold">Referencia</label>
                        <input type="text" id="reference" name="reference" class="form-control @error('reference') is-invalid @enderror" value="{{ old('reference') }}" placeholder="Ejemplo: Cerca del parque central">
                        @error('reference')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="neighborhood" class="font-weight-bold">Zona/Lugares de empadronamiento</label>
                        <input type="text" id="neighborhood" name="neighborhood" class="form-control @error('neighborhood') is-invalid @enderror" value="{{ old('neighborhood') }}" placeholder="Ejemplo: Urbanización San Martín">
                        @error('neighborhood')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="district" class="font-weight-bold">Distrito</label>
                        <input type="text" id="district" name="district" class="form-control @error('district') is-invalid @enderror" value="{{ old('district') }}" required placeholder="Ejemplo: El Tambo">
                        @error('district')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="provincia" class="font-weight-bold">Provincia</label>
                        <input type="text" id="provincia" name="provincia" class="form-control @error('provincia') is-invalid @enderror" value="{{ old('provincia') }}" required placeholder="Ejemplo: Huancayo">
                        @error('provincia')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="region" class="font-weight-bold">Región</label>
                        <input type="text" id="region" name="region" class="form-control @error('region') is-invalid @enderror" value="{{ old('region') }}" required placeholder="Ejemplo: Junín">
                        @error('region')
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
                <a href="{{ route('sfh_dwelling.index') }}" class="ml-2 shadow-sm btn btn-secondary">
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