@extends('adminlte::page')

@section('title', 'Editar Evento')

@section('content_header')
    <h1>Editar Evento</h1>
@stop

@section('content')
    <div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
        <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
            <h3 class="card-title mb-0">Editar Evento</h3>
        </div>

        <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
            <form action="{{ route('events.update', $event) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-4">
                    <label for="name" class="font-weight-bold" style="color: #355c7d;">Nombre del Evento</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}" required>
                </div>

                <div class="form-group mb-4">
                    <label for="description" class="font-weight-bold" style="color: #355c7d;">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label for="place" class="font-weight-bold" style="color: #355c7d;">Lugar</label>
                    <input type="text" name="place" id="place" class="form-control" value="{{ $event->place }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="start_date" class="font-weight-bold" style="color: #355c7d;">Fecha de Inicio</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $event->start_date->format('Y-m-d\TH:i') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="end_date" class="font-weight-bold" style="color: #355c7d;">Fecha de Fin</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $event->end_date->format('Y-m-d\TH:i') }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="program_id" class="font-weight-bold" style="color: #355c7d;">Programa</label>
                    <select name="program_id" id="program_id" class="form-control" required>
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}" {{ $event->program_id == $program->id ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="status" class="font-weight-bold" style="color: #355c7d;">Estado</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Pendiente" {{ $event->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Finalizado" {{ $event->status == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        <option value="En proceso" {{ $event->status == 'En proceso' ? 'selected' : '' }}>En Proceso</option>
                        <option value="Cancelado" {{ $event->status == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>

                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-lg shadow-sm" style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                    <a href="{{ route('events.index') }}" class="btn btn-lg btn-secondary shadow-sm" style="border-radius: 8px;">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop
