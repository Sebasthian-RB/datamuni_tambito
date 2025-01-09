@extends('adminlte::page')

@section('title', 'Editar Relación de Violencia')

@section('content_header')
    <h1>Editar Casos de Personas</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-warning">
        <h3 class="card-title">Editar Caso</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('am_person_violences.update', $amPersonViolence->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="am_person_id">Persona</label>
                <select name="am_person_id" id="am_person_id" class="form-control select2" required>
                    @foreach($amPersons as $person)
                        <option value="{{ $person->id }}" {{ $person->id == $amPersonViolence->am_person_id ? 'selected' : '' }}>
                            {{ $person->given_name }} {{ $person->paternal_last_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="violence_id">Tipo de Violencia</label>
                <select name="violence_id" id="violence_id" class="form-control" required>
                    @foreach($violences as $violence)
                        <option value="{{ $violence->id }}" {{ $violence->id == $amPersonViolence->violence_id ? 'selected' : '' }}>
                            {{ $violence->kind_violence }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="registration_date">Fecha de Registro</label>
                <input type="datetime-local" name="registration_date" id="registration_date" 
                       value="{{ $amPersonViolence->registration_date->format('Y-m-d\TH:i') }}" 
                       class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="{{ route('am_person_violences.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 36px; /* Ajusta la altura según tus necesidades */
            padding: 10px;
            font-size: 16px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 20px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 20px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2 en el campo Persona
            $('#am_person_id').select2({
                width: '100%', // Ocupa el 100% del ancho del contenedor
                placeholder: 'Seleccione una persona', // Placeholder para campos vacíos
                allowClear: true // Permitir limpiar la selección
            });
        });
    </script>
@stop
