@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Editar Visita</h1>
        <a href="{{ route('visits.index') }}" class="mb-3 btn btn-secondary">Volver al listado</a>

        <form action="{{ route('visits.update', $visit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Fecha de la Visita -->
            <div class="form-group">
                <label for="visit_date">Fecha de la Visita</label>
                <input type="date" id="visit_date" name="visit_date" class="form-control @error('visit_date') is-invalid @enderror" value="{{ old('visit_date', $visit->visit_date->format('Y-m-d')) }}">
                @error('visit_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Estado -->
            <div class="form-group">
                <label for="status">Estado</label>
                <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="Visitado" {{ old('status', $visit->status) == 'Visitado' ? 'selected' : '' }}>Visitado</option>
                    <option value="No visitado" {{ old('status', $visit->status) == 'No visitado' ? 'selected' : '' }}>No visitado</option>
                    <option value="No encontrado" {{ old('status', $visit->status) == 'No encontrado' ? 'selected' : '' }}>No encontrado</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Enumerador -->
            <div class="form-group">
                <label for="enumerator_id">Enumerador</label>
                <select id="enumerator_id" name="enumerator_id" class="form-control @error('enumerator_id') is-invalid @enderror">
                    @foreach ($enumerators as $enumerator)
                        <option value="{{ $enumerator->id }}" {{ old('enumerator_id', $visit->enumerator_id) == $enumerator->id ? 'selected' : '' }}>
                            {{ $enumerator->given_name }} {{ $enumerator->paternal_last_name }} {{ $enumerator->maternal_last_name }}
                        </option>
                    @endforeach
                </select>
                @error('enumerator_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Solicitud -->
            <div class="form-group">
                <label for="sfh_requests_id">Solicitud</label>
                <select id="sfh_requests_id" name="sfh_requests_id" class="form-control @error('sfh_requests_id') is-invalid @enderror">
                    @foreach ($requests as $request)
                        <option value="{{ $request->id }}" {{ old('sfh_requests_id', $visit->sfh_requests_id) == $request->id ? 'selected' : '' }}>
                            {{ $request->id }}
                        </option>
                    @endforeach
                </select>
                @error('sfh_requests_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Observaciones -->
            <div class="form-group">
                <label for="observations">Observaciones</label>
                <textarea id="observations" name="observations" class="form-control @error('observations') is-invalid @enderror" rows="4">{{ old('observations', $visit->observations) }}</textarea>
                @error('observations')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Guardar cambios</button>
        </form>
    </div>
@endsection

