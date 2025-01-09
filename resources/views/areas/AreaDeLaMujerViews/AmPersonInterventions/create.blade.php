@extends('adminlte::page')

@section('title', 'Crear Relación Persona-Intervención')

@section('content_header')
    <h1>Crear Relación Persona-Intervención</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('am_person_interventions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="am_person_id">Persona</label>
                <select name="am_person_id" id="am_person_id" class="form-control select2" required>
                    <option value="">Seleccione una persona</option>
                    @foreach($amPersons as $person)
                        <option value="{{ $person->id }}">{{ $person->given_name }} {{ $person->paternal_last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="intervention_id">Intervención</label>
                <select name="intervention_id" id="intervention_id" class="form-control select2" required>
                    <option value="">Seleccione una persona</option>
                    @foreach($interventions as $intervention)
                        <option value="{{ $intervention->id }}">{{ $intervention->appointment }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Estado</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="En progreso">En progreso</option>
                    <option value="Completado">Completado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('am_person_interventions.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop

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
            // Inicializar Select2 en todos los campos con la clase 'select2'
            $('.select2').select2({
                width: '100%', // Asegurar que ocupa el 100% del ancho del contenedor
                placeholder: 'Seleccione una opción', // Placeholder para campos vacíos
                allowClear: true // Permitir limpiar la selección
            });
        });
    </script>
@stop
