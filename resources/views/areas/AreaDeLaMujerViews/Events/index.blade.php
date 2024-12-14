@extends('adminlte::page')

@section('title', 'Events')

@section('content_header')
    <h1>Events</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('events.create') }}" class="btn btn-primary">Add New Event</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Place</th>
                        <th>Program</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->place }}</td>
                            <td>{{ $event->program->name }}</td>
                            <td>{{ $event->status }}</td>
                            <td>{{ $event->start_date }}</td>
                            <td>{{ $event->end_date }}</td>
                            <td>
                                <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
