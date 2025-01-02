@extends('adminlte::page')

@section('title', 'Editar Evento')

@section('content_header')
    <h1>Editar Evento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('events.update', $event) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre del Evento</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="place">Lugar</label>
                    <input type="text" name="place" id="place" class="form-control" value="{{ $event->place }}" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Fecha de Inicio</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $event->start_date->format('Y-m-d\TH:i') }}" required>
                </div>
                <div class="form-group">
                    <label for="end_date">Fecha de Fin</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $event->end_date->format('Y-m-d\TH:i') }}" required>
                </div>
                <div class="form-group">
                    <label for="program_id">Programa</label>
                    <select name="program_id" id="program_id" class="form-control" required>
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}" {{ $event->program_id == $program->id ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Pendiente" {{ $event->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Finalizado" {{ $event->status == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        <option value="En proceso" {{ $event->status == 'En proceso' ? 'selected' : '' }}>En Proceso</option>
                        <option value="Cancelado" {{ $event->status == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>
@stop
