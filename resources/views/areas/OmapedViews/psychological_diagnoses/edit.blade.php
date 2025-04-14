@extends('adminlte::page')

@section('title', 'Editar Diagnóstico')

@section('content_header')
    <h1>Editar Diagnóstico Psicológico</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('psychological-diagnoses.update', $psychologicalDiagnosis) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="om_person_id">Persona</label>
                <select name="om_person_id" id="om_person_id" class="form-control" required>
                    <option value="">-- Seleccione una persona --</option>
                    @foreach($people as $person)
                        <option value="{{ $person->id }}" 
                            {{ $psychologicalDiagnosis->om_person_id == $person->id ? 'selected' : '' }}>
                            {{ $person->given_name }} {{ $person->paternal_last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="diagnosis">Diagnóstico</label>
                <textarea name="diagnosis" id="diagnosis" class="form-control" rows="4">{{ old('diagnosis', $psychologicalDiagnosis->diagnosis) }}</textarea>
            </div>

            <div class="form-group">
                <label for="recommended_sessions">Sesiones Recomendadas</label>
                <input type="number" name="recommended_sessions" id="recommended_sessions" class="form-control" min="1"
                    value="{{ old('recommended_sessions', $psychologicalDiagnosis->recommended_sessions) }}" required>
            </div>

            <div class="form-group">
                <label for="diagnosis_date">Fecha del Diagnóstico</label>
                <input type="date" name="diagnosis_date" id="diagnosis_date" class="form-control" 
                    value="{{ old('diagnosis_date', $psychologicalDiagnosis->diagnosis_date) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('psychological-diagnoses.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection

{{-- CSS de Select2 --}}
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

{{-- JS de Select2 --}}
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#om_person_id').select2({
                placeholder: '-- Seleccione una persona --',
                allowClear: true,
                width: '100%' // Se ajusta al 100% del contenedor
            });
        });
    </script>
@endsection

