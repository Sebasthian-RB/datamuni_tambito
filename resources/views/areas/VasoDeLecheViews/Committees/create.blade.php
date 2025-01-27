@extends('adminlte::page')

@section('title', 'Agregar Comité')

@section('content_header')
    <h1>Agregar Comité</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('committees.store') }}" method="POST">
        @csrf
        <div class="card">
            <!-- Card Header con título más grande -->
            <div class="card-header p-0 d-flex align-items-center" style="background-color: #3B1E54; color: #FFFFFF; height: 60px;">
                <h3 class="card-title mb-0" style="margin-left: 20px; font-size: 1.30rem;">Formulario para agregar nuevo Comité</h3>
                <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="height: 50px; width: auto; margin-left: auto; margin-right: 20px;">
            </div>
            
            <div class="card-body">
                <div class="row">
                    <!-- Sección del Comité (Columna izquierda) -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header" style="background-color: #9B7EBD; color: #FFFFFF;">
                                <h4 style="font-size: 1.20rem;">Datos del Comité</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">Número de comité</label>
                                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id') }}" required>
                                    @error('id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="urban_core">Núcleo Urbano</label>
                                    <select class="form-control @error('urban_core') is-invalid @enderror" id="urban_core" name="urban_core" required>
                                        <option value="" disabled selected>Seleccione un Núcleo Urbano</option>
                                        @foreach ($urbanCores as $core)
                                            <option value="{{ $core }}" {{ old('urban_core') == $core ? 'selected' : '' }}>{{ $core }}</option>
                                        @endforeach
                                    </select>
                                    @error('urban_core')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="sector_id">Sector</label> 
                                    @if($sectors->isEmpty())
                                        <p>No hay sectores disponibles.</p>
                                    @else
                                        <select name="sector_id" id="sector_id" class="form-control @error('sector_id') is-invalid @enderror" required>
                                            <option value="" disabled selected>Seleccione un Sector</option>
                                            @foreach($sectors as $sector)
                                                <option value="{{ $sector->id }}" {{ old('sector_id') == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('sector_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección del Presidente (Columna derecha) -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header" style="background-color: #9B7EBD; color: #FFFFFF;">
                                <h4 style="font-size: 1.20rem;">Datos del Presidente(a)</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="president_paternal_surname">Apellido Paterno</label>
                                    <input type="text" class="form-control @error('president_paternal_surname') is-invalid @enderror" id="president_paternal_surname" name="president_paternal_surname" value="{{ old('president_paternal_surname') }}" required>
                                    @error('president_paternal_surname')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="president_maternal_surname">Apellido Materno</label>
                                    <input type="text" class="form-control @error('president_maternal_surname') is-invalid @enderror" id="president_maternal_surname" name="president_maternal_surname" value="{{ old('president_maternal_surname') }}">
                                    @error('president_maternal_surname')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="president_given_name">Nombres</label>
                                    <input type="text" class="form-control @error('president_given_name') is-invalid @enderror" id="president_given_name" name="president_given_name" value="{{ old('president_given_name') }}" required>
                                    @error('president_given_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Fin de la fila para los dos formularios -->
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">Guardar Comité</button>
                <a href="{{ route('committees.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop
