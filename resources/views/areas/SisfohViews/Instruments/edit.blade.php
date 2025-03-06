@extends('adminlte::page')

@section('title', 'Editar Instrumento')

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
                        <h3 class="mb-0 card-title">Editar Instrumento</h3>
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

                        <form action="{{ route('instruments.update', $instrument) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="name_instruments"><strong>Nombre del Instrumento</strong></label>
                                    <input type="text" name="name_instruments" id="name_instruments" 
                                            class="form-control @error('name_instruments') is-invalid @enderror" 
                                            value="{{ old('name_instruments', $instrument->name_instruments) }}" required>
                                    @error('name_instruments')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="type_instruments"><strong>Tipo de Instrumento</strong></label>
                                    <input type="text" name="type_instruments" id="type_instruments" 
                                            class="form-control @error('type_instruments') is-invalid @enderror" 
                                            value="{{ old('type_instruments', $instrument->type_instruments) }}" required>
                                    @error('type_instruments')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="description"><strong>Descripción</strong></label>
                                    <textarea name="description" id="description" rows="4"
                                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $instrument->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

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