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
            <div class="card-header">
                <h3 class="card-title">Formulario para agregar un Comité</h3>
            </div>
            <div class="card-body">

                <!-- Nombre del Comité -->
                <div class="form-group">
                    <label for="name">Nombre del Comité</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Presidente -->
                <div class="form-group">
                    <label for="president">Presidente/a</label>
                    <input type="text" class="form-control @error('president') is-invalid @enderror" id="president" name="president" value="{{ old('president') }}" required>
                    @error('president')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Núcleo Urbano -->
                <div class="form-group">
                    <label for="urban_core">Núcleo Urbano</label>
                    <input type="text" class="form-control @error('urban_core') is-invalid @enderror" id="urban_core" name="urban_core" value="{{ old('urban_core') }}" required>
                    @error('urban_core')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Número de Beneficiarios -->
                <div class="form-group">
                    <label for="beneficiaries_count">Número de Beneficiarios</label>
                    <input type="number" class="form-control @error('beneficiaries_count') is-invalid @enderror" id="beneficiaries_count" name="beneficiaries_count" value="{{ old('beneficiaries_count') }}" required>
                    @error('beneficiaries_count')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Sector -->
                <div class="form-group">
                    <label for="sector_id">Sector</label>
                    <select class="form-control @error('sector_id') is-invalid @enderror" id="sector_id" name="sector_id" required>
                        <option value="">Seleccionar Sector</option>
                        @foreach ($sectors as $sector)
                            <option value="{{ $sector->id }}" @selected(old('sector_id') == $sector->id)>{{ $sector->name }}</option>
                        @endforeach
                    </select>
                    @error('sector_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Guardar Comité</button>
            </div>
        </div>
    </form>
</div>
@stop
