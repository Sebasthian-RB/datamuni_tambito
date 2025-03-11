@extends('adminlte::page')

@section('title', 'Editar Vivienda SISFOH')

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
                        <h3 class="mb-0 card-title">Editar Vivienda SISFOH</h3>
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

                        <form action="{{ route('sfh_dwelling.update', $sfhDwelling) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Dirección -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="street_address"><strong>Dirección</strong></label>
                                    <input type="text" id="street_address" name="street_address" 
                                            class="form-control @error('street_address') is-invalid @enderror" 
                                            value="{{ old('street_address', $sfhDwelling->street_address) }}" required>
                                    @error('street_address')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Referencia -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="reference"><strong>Referencia</strong></label>
                                    <input type="text" id="reference" name="reference" 
                                            class="form-control @error('reference') is-invalid @enderror" 
                                            value="{{ old('reference', $sfhDwelling->reference) }}">
                                    @error('reference')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Barrio -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="neighborhood"><strong>Zona/Lugares de empadronamiento</strong></label>
                                    <input type="text" id="neighborhood" name="neighborhood" 
                                            class="form-control @error('neighborhood') is-invalid @enderror" 
                                            value="{{ old('neighborhood', $sfhDwelling->neighborhood) }}">
                                    @error('neighborhood')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Distrito -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="district"><strong>Distrito</strong></label>
                                    <input type="text" id="district" name="district" 
                                            class="form-control @error('district') is-invalid @enderror" 
                                            value="{{ old('district', $sfhDwelling->district) }}" required>
                                    @error('district')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Provincia -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="provincia"><strong>Provincia</strong></label>
                                    <input type="text" id="provincia" name="provincia" 
                                            class="form-control @error('provincia') is-invalid @enderror" 
                                            value="{{ old('provincia', $sfhDwelling->provincia) }}" required>
                                    @error('provincia')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Región -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="region"><strong>Región</strong></label>
                                    <input type="text" id="region" name="region" 
                                            class="form-control @error('region') is-invalid @enderror" 
                                            value="{{ old('region', $sfhDwelling->region) }}" required>
                                    @error('region')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="mt-4 text-center">
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