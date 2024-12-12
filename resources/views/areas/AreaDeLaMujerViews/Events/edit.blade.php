@extends('adminlte::page')

@section('title', 'Edit Event')

@section('content_header')
    <h1>Edit Event</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('events.update', $event) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Event Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="place">Place</label>
                    <input type="text" name="place" id="place" class="form-control" value="{{ $event->place }}" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ $event->start_date->format('Y-m-d\TH:i') }}" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ $event->end_date->format('Y-m-d\TH:i') }}" required>
                </div>
                <div class="form-group">
                    <label for="program_id">Program</label>
                    <select name="program_id" id="program_id" class="form-control" required>
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}" {{ $event->program_id == $program->id ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Pendiente" {{ $event->status == 'Pendiente' ? 'selected' : '' }}>Pending</option>
                        <option value="Finalizado" {{ $event->status == 'Finalizado' ? 'selected' : '' }}>Completed</option>
                        <option value="En proceso" {{ $event->status == 'En proceso' ? 'selected' : '' }}>In Progress</option>
                        <option value="Cancelado" {{ $event->status == 'Cancelado' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
@stop
