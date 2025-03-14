@extends('adminlte::page')

@section('title', 'Editar Encuestador')

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
                        <h3 class="mb-0 card-title">Editar Empadronador(a)</h3>
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

                        <form action="{{ route('enumerators.update', $enumerator->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="identity_document"><strong>Tipo de Documento</strong></label>
                                    <select id="identity_document" name="identity_document" 
                                            class="form-control @error('identity_document') is-invalid @enderror" required>
                                        <option value="DNI" {{ old('identity_document', $enumerator->identity_document) == 'DNI' ? 'selected' : '' }}>DNI</option>
                                        <option value="Pasaporte" {{ old('identity_document', $enumerator->identity_document) == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                        <option value="Carnet de Extranjería" {{ old('identity_document', $enumerator->identity_document) == 'Carnet de Extranjería' ? 'selected' : '' }}>Carnet de Extranjería</option>
                                    </select>
                                    @error('identity_document')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="id"><strong>Número de Documento</strong></label>
                                    <input type="text" name="id" id="id" 
                                            class="form-control @error('id') is-invalid @enderror" 
                                            value="{{ old('id', $enumerator->id) }}" required>
                                    <small id="idHelp" class="form-text text-muted">Formato según el tipo de documento.</small>
                                    @error('id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="given_name"><strong>Nombre</strong></label>
                                    <input type="text" name="given_name" id="given_name" 
                                            class="form-control @error('given_name') is-invalid @enderror" 
                                            value="{{ old('given_name', $enumerator->given_name) }}" required>
                                    @error('given_name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="paternal_last_name"><strong>Apellido Paterno</strong></label>
                                    <input type="text" name="paternal_last_name" id="paternal_last_name" 
                                            class="form-control @error('paternal_last_name') is-invalid @enderror" 
                                            value="{{ old('paternal_last_name', $enumerator->paternal_last_name) }}" required>
                                    @error('paternal_last_name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="maternal_last_name"><strong>Apellido Materno</strong></label>
                                    <input type="text" name="maternal_last_name" id="maternal_last_name" 
                                            class="form-control @error('maternal_last_name') is-invalid @enderror" 
                                            value="{{ old('maternal_last_name', $enumerator->maternal_last_name) }}" required>
                                    @error('maternal_last_name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="phone_number"><strong>Número de Teléfono</strong></label>
                                    <input type="tel" name="phone_number" id="phone_number" 
                                            class="form-control @error('phone_number') is-invalid @enderror" 
                                            value="{{ old('phone_number', $enumerator->phone_number) }}" 
                                            pattern="[0-9]{9}" placeholder="123456789" required>
                                    @error('phone_number')
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
        document.getElementById('identity_document').addEventListener('change', function () {
            const idInput = document.getElementById('id');
            const idHelp = document.getElementById('idHelp');

            switch (this.value) {
                case 'DNI':
                    idInput.setAttribute('pattern', '[0-9]{8}');
                    idInput.setAttribute('maxlength', '8');
                    idInput.setAttribute('placeholder', 'Ingrese 8 dígitos');
                    idHelp.textContent = 'Debe contener 8 dígitos.';
                    break;
                case 'Pasaporte':
                    idInput.removeAttribute('pattern');
                    idInput.setAttribute('maxlength', '9');
                    idInput.setAttribute('placeholder', 'Ingrese hasta 9 caracteres');
                    idHelp.textContent = 'Puede contener hasta 9 caracteres alfanuméricos.';
                    break;
                case 'Carnet de Extranjería':
                    idInput.setAttribute('pattern', '[A-Z0-9]{9}');
                    idInput.setAttribute('maxlength', '9');
                    idInput.setAttribute('placeholder', 'Ingrese 9 caracteres alfanuméricos');
                    idHelp.textContent = 'Debe contener exactamente 9 caracteres alfanuméricos.';
                break;
            }
        });
    </script>
@stop