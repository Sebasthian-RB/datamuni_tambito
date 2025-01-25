@extends('adminlte::page')

@section('title', 'Nueva Vivienda')

@section('content_header')
    <h1>Registrar Nueva Vivienda</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('om-dwellings.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exact_location">Localización Exacta</label>
                    <input type="text" name="exact_location" id="exact_location" class="form-control @error('exact_location') is-invalid @enderror" value="{{ old('exact_location') }}">
                    @error('exact_location')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reference">Referencia</label>
                    <textarea name="reference" id="reference" class="form-control @error('reference') is-invalid @enderror">{{ old('reference') }}</textarea>
                    @error('reference')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="annex_sector">Anexo/Sector</label>
                    <input type="text" name="annex_sector" id="annex_sector" class="form-control @error('annex_sector') is-invalid @enderror" value="{{ old('annex_sector') }}">
                    @error('annex_sector')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="water_electricity">Agua y/o Luz</label>
                    <select name="water_electricity" id="water_electricity" class="form-control @error('water_electricity') is-invalid @enderror">
                        <option value="">Seleccione</option>
                        <option value="Agua" {{ old('water_electricity') == 'Agua' ? 'selected' : '' }}>Agua</option>
                        <option value="Luz" {{ old('water_electricity') == 'Luz' ? 'selected' : '' }}>Luz</option>
                        <option value="Agua y Luz" {{ old('water_electricity') == 'Agua y Luz' ? 'selected' : '' }}>Agua y Luz</option>
                        <option value="Ninguno" {{ old('water_electricity') == 'Ninguno' ? 'selected' : '' }}>Ninguno</option>
                    </select>
                    @error('water_electricity')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="type">Tipo de Vivienda</label>
                    <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}">
                    @error('type')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ownership_status">Situación de Vivienda</label>
                    <select name="ownership_status" id="ownership_status" class="form-control @error('ownership_status') is-invalid @enderror">
                        <option value="">Seleccione</option>
                        <option value="Propia" {{ old('ownership_status') == 'Propia' ? 'selected' : '' }}>Propia</option>
                        <option value="Alquilada" {{ old('ownership_status') == 'Alquilada' ? 'selected' : '' }}>Alquilada</option>
                        <option value="Prestada" {{ old('ownership_status') == 'Prestada' ? 'selected' : '' }}>Prestada</option>
                    </select>
                    @error('ownership_status')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="permanent_occupants">Ocupantes Permanentes</label>
                    <input type="number" name="permanent_occupants" id="permanent_occupants" class="form-control @error('permanent_occupants') is-invalid @enderror" value="{{ old('permanent_occupants') }}">
                    @error('permanent_occupants')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Registrar</button>
                <a href="{{ route('om-dwellings.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
