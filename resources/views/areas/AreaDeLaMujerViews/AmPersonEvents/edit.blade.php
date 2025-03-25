@extends('adminlte::page')

@section('title', 'Editar Asistencia')

@section('content_header')
    <h1>Editar Asistencia</h1>
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

    <div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
        <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
            <h3 class="card-title mb-0">Editar Asistencia</h3>
        </div>

        <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
            <form action="{{ route('am_person_events.update', $amPersonEvent->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-4">
                    <label for="am_person_id" class="font-weight-bold" style="color: #355c7d;">Persona</label>
                    <select name="am_person_id" id="am_person_id" class="form-control select2 shadow-sm" required>
                        @foreach($people as $person)
                            <option value="{{ $person->id }}" {{ $person->id == $amPersonEvent->am_person_id ? 'selected' : '' }}>
                                {{ $person->given_name }} {{ $person->paternal_last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="event_id" class="font-weight-bold" style="color: #355c7d;">Evento</label>
                    <select name="event_id" id="event_id" class="form-control select2 shadow-sm" required>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ $event->id == $amPersonEvent->event_id ? 'selected' : '' }}>
                                {{ $event->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="status" class="font-weight-bold" style="color: #355c7d;">Estado</label>
                    <select name="status" id="status" class="form-control shadow-sm" required>
                        <option value="Asistió" {{ $amPersonEvent->status == 'Asistió' ? 'selected' : '' }}>Asistió</option>
                        <option value="No Asistió" {{ $amPersonEvent->status == 'No Asistió' ? 'selected' : '' }}>No Asistió</option>
                        <option value="Justificado" {{ $amPersonEvent->status == 'Justificado' ? 'selected' : '' }}>Justificado</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="attendance_datetime" class="font-weight-bold" style="color: #355c7d;">Fecha y Hora de Asistencia</label>
                    <input type="datetime-local" name="attendance_datetime" id="attendance_datetime" class="form-control" value="{{ old('attendance_datetime', $amPersonEvent->attendance_datetime ? $amPersonEvent->attendance_datetime->format('Y-m-d\TH:i') : '') }}" required>
                </div>

                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-lg shadow-sm" style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                    <a href="{{ route('am_person_events.index') }}" class="btn btn-lg btn-secondary shadow-sm" style="border-radius: 8px;">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <style>
        .select2-container--default .select2-selection--single {
            border-radius: 8px !important;
            border: 2px solid #c06c84 !important;
            height: calc(1.5em + 1rem + 2px) !important;
        }

        .form-control:focus {
            border-color: #f67280 !important;
            box-shadow: 0 0 0 0.2rem rgba(246, 114, 128, 0.25) !important;
        }

        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2 en los campos
            $('.select2').select2({
                width: '100%',
                placeholder: 'Seleccione una opción',
                allowClear: true
            });
        });
    </script>
@stop
