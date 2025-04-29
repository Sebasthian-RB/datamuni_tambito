@extends('adminlte::page')

@section('title', 'Editar Persona SISFOH')

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
                        <h3 class="mb-0 card-title">Editar Persona SISFOH</h3>
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

                        <form method="POST" action="{{ route('sfh_people.update', $sfhPerson->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Tipo de Documento -->
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="identity_document"><strong>Tipo de Documento</strong></label>
                                    <select id="identity_document" name="identity_document" 
                                            class="form-control @error('identity_document') is-invalid @enderror" required>
                                        <option value="" disabled>Seleccione un tipo de documento...</option>
                                        <option value="DNI" {{ old('identity_document', $sfhPerson->identity_document) == 'DNI' ? 'selected' : '' }}>DNI</option>
                                        <option value="Pasaporte" {{ old('identity_document', $sfhPerson->identity_document) == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                        <option value="Carnet" {{ old('identity_document', $sfhPerson->identity_document) == 'Carnet de extranjeria' ? 'selected' : '' }}>Carnet de extranjería</option>
                                        <option value="CPP" {{ old('identity_document', $sfhPerson->identity_document) == 'CPP' ? 'selected' : '' }}>CPP</option>
                                        <option value="Cedula" {{ old('identity_document', $sfhPerson->identity_document) == 'Cedula' ? 'selected' : '' }}>Cédula</option>
                                    </select>
                                    @error('identity_document')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Número de Documento -->
                                <div class="col-md-6 form-group">
                                    <label for="id"><strong>Número de Documento</strong></label>
                                    <input type="text" id="id" name="id" 
                                            class="form-control @error('id') is-invalid @enderror" 
                                            value="{{ old('id', $sfhPerson->id) }}" placeholder="Ingrese el número de documento" required>
                                    @error('id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nombres y Apellidos -->
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="given_name"><strong>Primer Nombre</strong></label>
                                    <input type="text" id="given_name" name="given_name" 
                                            class="form-control @error('given_name') is-invalid @enderror" 
                                            value="{{ old('given_name', $sfhPerson->given_name) }}" placeholder="Ingrese el primer nombre" required>
                                    @error('given_name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="paternal_last_name"><strong>Apellido Paterno</strong></label>
                                    <input type="text" id="paternal_last_name" name="paternal_last_name" 
                                            class="form-control @error('paternal_last_name') is-invalid @enderror" 
                                            value="{{ old('paternal_last_name', $sfhPerson->paternal_last_name) }}" placeholder="Ingrese el apellido paterno" required>
                                    @error('paternal_last_name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="maternal_last_name"><strong>Apellido Materno</strong></label>
                                    <input type="text" id="maternal_last_name" name="maternal_last_name" 
                                            class="form-control @error('maternal_last_name') is-invalid @enderror" 
                                            value="{{ old('maternal_last_name', $sfhPerson->maternal_last_name) }}" placeholder="Ingrese el apellido materno" required>
                                    @error('maternal_last_name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Estado Civil -->
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="marital_status"><strong>Estado Civil</strong></label>
                                    <select id="marital_status" name="marital_status" 
                                            class="form-control @error('marital_status') is-invalid @enderror">
                                        <option value="" disabled>Seleccione el estado civil...</option>
                                        <option value="Soltero(a)" {{ old('marital_status', $sfhPerson->marital_status) == 'Soltero(a)' ? 'selected' : '' }}>Soltero(a)</option>
                                        <option value="Casado(a)" {{ old('marital_status', $sfhPerson->marital_status) == 'Casado(a)' ? 'selected' : '' }}>Casado(a)</option>
                                        <option value="Divorciado(a)" {{ old('marital_status', $sfhPerson->marital_status) == 'Divorciado(a)' ? 'selected' : '' }}>Divorciado(a)</option>
                                        <option value="Viudo(a)" {{ old('marital_status', $sfhPerson->marital_status) == 'Viudo(a)' ? 'selected' : '' }}>Viudo(a)</option>
                                    </select>
                                    @error('marital_status')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Fecha de Nacimiento -->
                                <div class="col-md-6 form-group">
                                    <label for="birth_date"><strong>Fecha de Nacimiento</strong></label>
                                    <input type="date" id="birth_date" name="birth_date" 
                                            class="form-control @error('birth_date') is-invalid @enderror" 
                                            value="{{ old('birth_date', $sfhPerson->birth_date) }}">
                                    @error('birth_date')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Sexo -->
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="sex_type"><strong>Sexo</strong></label>
                                    <select id="sex_type" name="sex_type" 
                                            class="form-control @error('sex_type') is-invalid @enderror" required>
                                        <option value="" disabled>Seleccione el sexo...</option>
                                        <option value="0" {{ old('sex_type', $sfhPerson->sex_type) == '0' ? 'selected' : '' }}>Femenino</option>
                                        <option value="1" {{ old('sex_type', $sfhPerson->sex_type) == '1' ? 'selected' : '' }}>Masculino</option>
                                    </select>
                                    @error('sex_type')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Teléfono -->
                                <div class="col-md-6 form-group">
                                    <label for="phone_number"><strong>Teléfono</strong></label>
                                    <input type="text" id="phone_number" name="phone_number" 
                                            class="form-control @error('phone_number') is-invalid @enderror" 
                                            value="{{ old('phone_number', $sfhPerson->phone_number) }}" placeholder="Ingrese el número de teléfono">
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nacionalidad -->
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="nationality"><strong>Nacionalidad</strong></label>
                                    <input type="text" id="nationality" name="nationality" 
                                            class="form-control @error('nationality') is-invalid @enderror" 
                                            value="{{ old('nationality', $sfhPerson->nationality) }}" placeholder="Ingrese la nacionalidad">
                                    @error('nationality')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Grado Académico -->
                                <div class="col-md-6 form-group">
                                    <label for="degree"><strong>Grado Académico</strong></label>
                                    <select id="degree" name="degree" 
                                            class="form-control @error('degree') is-invalid @enderror" required>
                                        <option value="" disabled>Seleccione el grado académico...</option>
                                        @foreach ($degrees as $degree)
                                            <option value="{{ $degree }}" {{ old('degree', $sfhPerson->degree) == $degree ? 'selected' : '' }}>{{ $degree }}</option>
                                        @endforeach
                                    </select>
                                    @error('degree')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Ocupación -->
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="occupation"><strong>Ocupación</strong></label>
                                    <input type="text" id="occupation" name="occupation" 
                                            class="form-control @error('occupation') is-invalid @enderror" 
                                            value="{{ old('occupation', $sfhPerson->occupation) }}" placeholder="Ingrese la ocupación">
                                    @error('occupation')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Categoría SISFOH -->
                                <div class="col-md-6 form-group">
                                    <label for="sfh_category"><strong>Categoría SISFOH</strong></label>
                                    <select id="sfh_category" name="sfh_category" 
                                            class="form-control @error('sfh_category') is-invalid @enderror" required>
                                        <option value="" disabled>Seleccione una categoría...</option>
                                        <option value="No pobre" {{ old('sfh_category', $sfhPerson->sfh_category) == 'No pobre' ? 'selected' : '' }}>No pobre</option>
                                        <option value="Pobre" {{ old('sfh_category', $sfhPerson->sfh_category) == 'Pobre' ? 'selected' : '' }}>Pobre</option>
                                        <option value="Pobre extremo" {{ old('sfh_category', $sfhPerson->sfh_category) == 'Pobre extremo' ? 'selected' : '' }}>Pobre extremo</option>
                                    </select>
                                    @error('sfh_category')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Consulta SISFOH -->
                                <div class="col-md-6 form-group">
                                    <label for="sfh_consultation"><strong>Consulta SISFOH</strong></label>
                                    <select id="sfh_consultation" name="sfh_consultation" 
                                            class="form-control @error('sfh_consultation') is-invalid @enderror" required>
                                        <option value="" disabled>Seleccione una consulta...</option>
                                        <option value="Atendido" {{ old('sfh_consultation', $sfhPerson->sfh_consultation) == 'Atendido' ? 'selected' : '' }}>Atendido</option>
                                        <option value="Empadronado" {{ old('sfh_consultation', $sfhPerson->sfh_consultation) == 'Empadronado' ? 'selected' : '' }}>Empadronado</option>
                                        <option value="No empadronado" {{ old('sfh_consultation', $sfhPerson->sfh_consultation) == 'No empadronado' ? 'selected' : '' }}>No empadronado</option>
                                    </select>
                                    @error('sfh_consultation')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="mt-4 text-center">
                                <a href="{{ route('sfh_people.index') }}" class="btn btn-custom">
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