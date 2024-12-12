@extends('adminlte::page')

@section('title', 'Create Program')

@section('content_header')
    <h1>Create Program</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('programs.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Program Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="program_type">Program Type</label>
                    <input type="text" name="program_type" id="program_type" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="datetime-local" name="end_date" id="end_date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Pendiente">Pending</option>
                        <option value="Finalizado">Completed</option>
                        <option value="En proceso">In Progress</option>
                        <option value="Cancelado">Canceled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
@stop
