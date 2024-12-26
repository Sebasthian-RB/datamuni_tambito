@extends('adminlte::page')

@section('title', 'Programs')

@section('content_header')
    <h1>Programs</h1>
@stop

@section('content')
<div class="container">
    <!-- Botón de acción -->
    <a href="{{ route('programs.create') }}" class="btn btn-info mb-3">
        <i class="fa fa-plus"></i> Add New Program
    </a>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla de datos -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Programs List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
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
                                <a href="{{ route('programs.show', $program) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a href="{{ route('programs.edit', $program) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('programs.destroy', $program) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
