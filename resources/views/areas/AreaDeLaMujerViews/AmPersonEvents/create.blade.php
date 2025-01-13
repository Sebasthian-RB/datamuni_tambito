@extends('adminlte::page')

@section('title', 'Nueva Asistencia')

@section('content_header')
    <h1>Nueva Asistencia</h1>
@stop

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('am_person_events.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="am_person_id">Persona</label>
                    <select name="am_person_id" id="am_person_id" class="form-control select2" required>
                        <option value="">Seleccione una persona</option>
                        @foreach($people as $person)
                            <option value="{{ $person->id }}">{{ $person->given_name }} {{ $person->paternal_last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="event_id">Evento</label>
                    <select name="event_id" id="event_id" class="form-control select2" required>
                        <option value="">Seleccione un evento</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Seleccione un estado</option>
                        <option value="Asistió">Asistió</option>
                        <option value="No Asistió">No Asistió</option>
                        <option value="Justificado">Justificado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="attendance_datetime">Fecha y Hora de Asistencia</label>
                    <input 
                        type="datetime-local" 
                        name="attendance_datetime" 
                        id="attendance_datetime" 
                        class="form-control" 
                        value="{{ old('attendance_datetime') }}" 
                        required
                    >
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('am_person_events.index') }}" class="btn btn-secondary">Cancelar</a>
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
            // Inicializar Select2 en los campos Persona y Evento
            $('.select2').select2({
                width: '100%', // Ocupa el 100% del ancho del contenedor
                placeholder: 'Seleccione una opción', // Placeholder para campos vacíos
                allowClear: true // Permitir limpiar la selección
            });
        });
    </script>
@stop
