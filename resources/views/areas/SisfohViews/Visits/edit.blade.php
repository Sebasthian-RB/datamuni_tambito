@extends('adminlte::page')

@section('title', 'Editar Visita SISFOH')

@section('content_header')
    <div class="py-3 d-flex justify-content-center align-items-center" 
        style="background: #028a0f; border-radius: 0 0 0px 0px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" 
            alt="Escudo El Tambo" class="img-fluid" 
            style="max-height: 80px;">
    </div>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="shadow-lg card" 
                    style="border-radius: 15px; border-left: 5px solid #028a0f;"> 
                    
                    <div class="text-center card-header" 
                        style="background: #028a0f; color: white; border-radius: 15px 15px 0 0;">
                        <h3 class="mb-0 card-title">Editar Visita SISFOH</h3>
                    </div>

                    <div class="card-body" 
                        style="background: linear-gradient(135deg, #a8e6a350 0%, #56ab2f50 100%); padding: 2rem;">
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('visits.update', $visit->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Fecha de la Visita -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="visit_date"><strong>Fecha de la Visita</strong></label>
                                    <input type="date" id="visit_date" name="visit_date" 
                                            class="form-control @error('visit_date') is-invalid @enderror" 
                                            value="{{ old('visit_date', $visit->visit_date->format('Y-m-d')) }}" required>
                                    @error('visit_date')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Estado -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="status"><strong>Estado</strong></label>
                                    <select id="status" name="status" 
                                            class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="Visitado" {{ old('status', $visit->status) == 'Visitado' ? 'selected' : '' }}>Visitado</option>
                                        <option value="No visitado" {{ old('status', $visit->status) == 'No visitado' ? 'selected' : '' }}>No visitado</option>
                                        <option value="No encontrado" {{ old('status', $visit->status) == 'No encontrado' ? 'selected' : '' }}>No encontrado</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Enumerador -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="enumerator_id"><strong>Empadronador(a)</strong></label>
                                    <select id="enumerator_id" name="enumerator_id" 
                                            class="form-control @error('enumerator_id') is-invalid @enderror" required>
                                        @foreach ($enumerators as $enumerator)
                                            <option value="{{ $enumerator->id }}" {{ old('enumerator_id', $visit->enumerator_id) == $enumerator->id ? 'selected' : '' }}>
                                                {{ $enumerator->given_name }} {{ $enumerator->paternal_last_name }} {{ $enumerator->maternal_last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('enumerator_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Solicitud -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="sfh_requests_id"><strong>Solicitud</strong></label>
                                    <select id="sfh_requests_id" name="sfh_requests_id" 
                                            class="form-control @error('sfh_requests_id') is-invalid @enderror" required>
                                        @foreach ($requests as $request)
                                            <option value="{{ $request->id }}" {{ old('sfh_requests_id', $visit->sfh_requests_id) == $request->id ? 'selected' : '' }}>
                                                {{ $request->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sfh_requests_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Observaciones -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="observations"><strong>Lugar de empadronamiento</strong></label>
                                    <textarea id="observations" name="observations" rows="4"
                                                class="form-control @error('observations') is-invalid @enderror">{{ old('observations', $visit->observations) }}</textarea>
                                    @error('observations')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="mt-4 text-center">
                                <a href="{{ route('visits.index') }}" class="btn btn-custom">
                                    <i class="fas fa-arrow-left"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-custom">
                                    <i class="fas fa-save"></i> Guardar
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .btn-custom {
            background-color: #028a0f;
            border: 1px solid #028a0f;
            color: white;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .btn-custom:hover {
            background-color: #028a0f;
            color: #fff;
        }
    </style>
@stop

@section('js')
    <script>
        // Aquí puedes agregar scripts personalizados si es necesario
    </script>
@stop
