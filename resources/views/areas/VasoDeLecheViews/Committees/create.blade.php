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
                <h3 class="card-title">Formulario para agregar comité</h3>
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
                    <label for="president">Presidente(a)</label>
                    <input type="text" class="form-control @error('president') is-invalid @enderror" id="president" name="president" value="{{ old('president') }}" required>
                    @error('president')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="urban_core">Núcleo Urbano</label>
                    <select class="form-control @error('urban_core') is-invalid @enderror" id="urban_core" name="urban_core" required>
                        @foreach ($urbanCores as $core)
                            <option value="{{ $core }}" {{ old('urban_core') == $core ? 'selected' : '' }}>
                                {{ $core }}
                            </option>
                        @endforeach
                    </select>
                    @error('urban_core')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="beneficiaries_count">Número de Beneficiarios</label>
                    <input type="number" class="form-control @error('beneficiaries_count') is-invalid @enderror" id="beneficiaries_count" name="beneficiaries_count" value="{{ old('beneficiaries_count') }}" required>
                    @error('beneficiaries_count')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sector_id">Sector</label>
                    <select name="sector_id" id="sector_id" class="form-control" required>
                        @foreach ($sectors as $sector)
                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Guardar Comité</button>
                <a href="{{ route('committees.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop
