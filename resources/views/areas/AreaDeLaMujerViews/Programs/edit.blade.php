@extends('adminlte::page')

@section('title', 'Edit Program')

@section('content_header')
    <h1>Edit Program</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('programs.update', $program) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Program Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $program->name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ $program->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="program_type">Program Type</label>
                    <input type="text" name="program_type" id="program_type" class="form-control" value="{{ $program->program_type }}" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ $program->start_date }}" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ $program->end_date }}">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Pendiente" {{ $program->status == 'Pendiente' ? 'selected' : '' }}>Pending</option>
                        <option value="Finalizado" {{ $program->status == 'Finalizado' ? 'selected' : '' }}>Completed</option>
                        <option value="En proceso" {{ $program->status == 'En proceso' ? 'selected' : '' }}>In Progress</option>
                        <option value="Cancelado" {{ $program->status == 'Cancelado' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
@stop
