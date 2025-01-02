@extends('adminlte::page')

@section('title', 'Editar Programa')

@section('content_header')
    <h1>Editar Programa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('programs.update', $program) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre del Programa</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $program->name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ $program->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="program_type">Tipo de Programa</label>
                    <input type="text" name="program_type" id="program_type" class="form-control" value="{{ $program->program_type }}" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Fecha de Inicio</label>
                    <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ $program->start_date }}" required>
                </div>
                <div class="form-group">
                    <label for="end_date">Fecha de Fin</label>
                    <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ $program->end_date }}">
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Pendiente" {{ $program->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Finalizado" {{ $program->status == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        <option value="En proceso" {{ $program->status == 'En proceso' ? 'selected' : '' }}>En Proceso</option>
                        <option value="Cancelado" {{ $program->status == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>
@stop
