@extends('adminlte::page')

@section('title', 'Nuevo Diagnóstico')

@section('content_header')
    <h1>Registrar Nuevo Diagnóstico</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('psychological-diagnoses.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="om_person_id">Persona</label>
                <select name="om_person_id" id="om_person_id" class="form-control select2" required>
                    <option value="">-- Seleccione una persona --</option>
                    @foreach($people as $person)
                        <option value="{{ $person->id }}">{{ $person->given_name }} {{ $person->paternal_last_name }} {{ $person->maternal_last_name }}</option>
                    @endforeach
                </select>
            </div>            

            <div class="form-group">
                <label for="diagnosis">Diagnóstico</label>
                <textarea name="diagnosis" id="diagnosis" class="form-control" rows="4" placeholder="Describa el diagnóstico..."></textarea>
            </div>

            <div class="form-group">
                <label for="recommended_sessions">Sesiones Recomendadas</label>
                <input type="number" name="recommended_sessions" id="recommended_sessions" class="form-control" min="1" value="1" required>
            </div>

            <div class="form-group">
                <label for="diagnosis_date">Fecha del Diagnóstico</label>
                <input type="date" name="diagnosis_date" id="diagnosis_date" class="form-control" value="{{ now()->toDateString() }}" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('psychological-diagnoses.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection

@section('css')
    <!-- Select2 CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('js')
    <!-- jQuery (si aún no lo tienes cargado) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#om_person_id').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: "Seleccione una persona",
                allowClear: true
            });
        });
    </script>
@endsection