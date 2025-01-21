@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Crear Visita</h1>

        <form action="{{ route('visits.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="visit_date" class="form-label">Fecha de la Visita</label>
                <input type="date" class="form-control" id="visit_date" name="visit_date" value="{{ old('visit_date') }}" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Estado</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Visitado" {{ old('status') == 'Visitado' ? 'selected' : '' }}>Visitado</option>
                    <option value="No visitado" {{ old('status') == 'No visitado' ? 'selected' : '' }}>No visitado</option>
                    <option value="No encontrado" {{ old('status') == 'No encontrado' ? 'selected' : '' }}>No encontrado</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="observations" class="form-label">Observaciones</label>
                <textarea class="form-control" id="observations" name="observations" rows="4">{{ old('observations') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="enumerator_id" class="form-label">Enumerador</label>
                <select class="form-select" id="enumerator_id" name="enumerator_id" required>
                    @foreach ($enumerators as $enumerator)
                        <option value="{{ $enumerator->id }}" {{ old('enumerator_id') == $enumerator->id ? 'selected' : '' }}>
                            {{ $enumerator->given_name }} {{ $enumerator->paternal_last_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="sfh_requests_id" class="form-label">Solicitud</label>
                <select class="form-select" id="sfh_requests_id" name="sfh_requests_id" required>
                    @foreach ($requests as $request)
                        <option value="{{ $request->id }}" {{ old('sfh_requests_id') == $request->id ? 'selected' : '' }}>
                            {{ $request->id }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Crear Visita</button>
        </form>
    </div>
@endsection
