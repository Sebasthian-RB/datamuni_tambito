@extends('adminlte::page')

@section('title', 'Editar Solicitud SISFOH')

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
                        <h3 class="mb-0 card-title">Editar Solicitud SISFOH</h3>
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

                        <form action="{{ route('sfh_requests.update', $sfhRequest->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Fecha de Solicitud -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="request_date"><strong>Fecha de la Solicitud</strong></label>
                                    <input type="date" id="request_date" name="request_date" 
                                            class="form-control @error('request_date') is-invalid @enderror" 
                                            value="{{ old('request_date', $sfhRequest->request_date->format('Y-m-d')) }}" required>
                                    @error('request_date')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="description"><strong>Motivo</strong></label>
                                    <textarea id="description" name="description" rows="4"
                                                class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $sfhRequest->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Persona relacionada -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="sfh_person_id"><strong>Ciudadano Relacionado</strong></label>
                                    <select id="sfh_person_id" name="sfh_person_id" 
                                            class="form-control @error('sfh_person_id') is-invalid @enderror" required>
                                        <option value="" disabled>Selecciona una persona</option>
                                        @foreach($people as $person)
                                            <option value="{{ $person->id }}" {{ old('sfh_person_id', $sfhRequest->sfh_person_id) == $person->id ? 'selected' : '' }}>
                                                {{ $person->given_name }} {{ $person->paternal_last_name }} {{ $person->maternal_last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sfh_person_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="mt-4 text-center">
                                <a href="{{ route('sfh_requests.index') }}" class="btn btn-custom">
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