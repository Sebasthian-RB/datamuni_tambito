@extends('adminlte::page')

@section('title', 'Registrar Relación de Violencia')

@section('content_header')
    <h1>Registrar Casos de Personas</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title">Nuevo Caso</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('am_person_violences.store') }}" method="POST">
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
                <label for="violence_id">Tipo de Violencia</label>
                <select name="violence_id" id="violence_id" class="form-control" required>
                    <option value="">Seleccione un tipo de violencia</option>
                    @foreach($violences as $violence)
                        <option value="{{ $violence->id }}">{{ $violence->kind_violence }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="registration_date">Fecha de Registro</label>
                <input type="datetime-local" name="registration_date" id="registration_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('am_person_violences.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height:36px; /* Ajusta la altura según tus necesidades */
            padding: 10px; /* Ajusta el espaciado interno */
            font-size: 16px; /* Ajusta el tamaño de texto si es necesario */
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 20px; /* Alinea el texto verticalmente */
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 20px; /* Alinea la flecha del desplegable */
        }
    </style>

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2
            $('#am_person_id').select2({
                placeholder: "Seleccione una persona",
                allowClear: true,
                width: '100%' // Ajustar al ancho del contenedor
            });
        });
    </script>
@stop