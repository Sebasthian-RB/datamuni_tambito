@extends('adminlte::page')

@section('title', 'Editar Vivienda')

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
            <h3 class="card-title mb-0">Editar Vivienda</h3>
        </div>

        <!-- Cuerpo -->
        <div class="card-body" 
             style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%); padding: 2rem;">
            <form action="{{ route('om-dwellings.update', $omDwelling->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="exact_location"><strong>Localización Exacta</strong></label>
                        <input type="text" name="exact_location" id="exact_location" 
                               class="form-control @error('exact_location') is-invalid @enderror" 
                               value="{{ old('exact_location', $omDwelling->exact_location) }}">
                        @error('exact_location')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="reference"><strong>Referencia</strong></label>
                        <textarea name="reference" id="reference" 
                                  class="form-control @error('reference') is-invalid @enderror">{{ old('reference', $omDwelling->reference) }}</textarea>
                        @error('reference')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="annex_sector"><strong>Anexo/Sector</strong></label>
                        <input type="text" name="annex_sector" id="annex_sector" 
                               class="form-control @error('annex_sector') is-invalid @enderror" 
                               value="{{ old('annex_sector', $omDwelling->annex_sector) }}">
                        @error('annex_sector')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="water_electricity"><strong>Agua y/o Luz</strong></label>
                        <select name="water_electricity" id="water_electricity" 
                                class="form-control @error('water_electricity') is-invalid @enderror">
                            <option value="">Seleccione</option>
                            <option value="Agua" {{ old('water_electricity', $omDwelling->water_electricity) == 'Agua' ? 'selected' : '' }}>Agua</option>
                            <option value="Luz" {{ old('water_electricity', $omDwelling->water_electricity) == 'Luz' ? 'selected' : '' }}>Luz</option>
                            <option value="Agua y Luz" {{ old('water_electricity', $omDwelling->water_electricity) == 'Agua y Luz' ? 'selected' : '' }}>Agua y Luz</option>
                            <option value="Ninguno" {{ old('water_electricity', $omDwelling->water_electricity) == 'Ninguno' ? 'selected' : '' }}>Ninguno</option>
                        </select>
                        @error('water_electricity')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="type"><strong>Tipo de Vivienda</strong></label>
                        <input type="text" name="type" id="type" 
                               class="form-control @error('type') is-invalid @enderror" 
                               value="{{ old('type', $omDwelling->type) }}">
                        @error('type')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="ownership_status"><strong>Situación de Vivienda</strong></label>
                        <select name="ownership_status" id="ownership_status" 
                                class="form-control @error('ownership_status') is-invalid @enderror">
                            <option value="">Seleccione</option>
                            <option value="Propia" {{ old('ownership_status', $omDwelling->ownership_status) == 'Propia' ? 'selected' : '' }}>Propia</option>
                            <option value="Alquilada" {{ old('ownership_status', $omDwelling->ownership_status) == 'Alquilada' ? 'selected' : '' }}>Alquilada</option>
                            <option value="Prestada" {{ old('ownership_status', $omDwelling->ownership_status) == 'Prestada' ? 'selected' : '' }}>Prestada</option>
                        </select>
                        @error('ownership_status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="permanent_occupants"><strong>Ocupantes Permanentes</strong></label>
                        <input type="number" name="permanent_occupants" id="permanent_occupants" 
                               class="form-control @error('permanent_occupants') is-invalid @enderror" 
                               value="{{ old('permanent_occupants', $omDwelling->permanent_occupants) }}">
                        @error('permanent_occupants')
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
