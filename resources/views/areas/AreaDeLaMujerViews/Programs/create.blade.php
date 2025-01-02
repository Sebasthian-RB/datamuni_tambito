@extends('adminlte::page')

@section('title', 'Crear Programa')

@section('content_header')
    <h1>Crear Programa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('programs.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del Programa</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="program_type">Tipo de Programa</label>
                    <input type="text" name="program_type" id="program_type" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Fecha de Inicio</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="end_date">Fecha de Fin</label>
                    <input type="date" name="end_date" id="end_date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Finalizado">Finalizado</option>
                        <option value="En proceso">En Proceso</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
@stop
