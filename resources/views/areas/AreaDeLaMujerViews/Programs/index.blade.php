@extends('adminlte::page')

@section('title', 'Programs')

@section('content_header')
    <h1>Programs</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('programs.create') }}" class="btn btn-primary">Add New Program</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $program)
                        <tr>
                            <td>{{ $program->id }}</td>
                            <td>{{ $program->name }}</td>
                            <td>{{ $program->program_type }}</td>
                            <td>{{ $program->status }}</td>
                            <td>{{ $program->start_date }}</td>
                            <td>{{ $program->end_date }}</td>
                            <td>
                                <a href="{{ route('programs.show', $program) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('programs.edit', $program) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('programs.destroy', $program) }}" method="POST" class="d-inline">
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
