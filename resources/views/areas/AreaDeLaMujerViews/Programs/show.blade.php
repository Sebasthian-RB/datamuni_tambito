@extends('adminlte::page')

@section('title', 'Program Details')

@section('content_header')
    <h1>Program Details</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5><strong>Name:</strong> {{ $program->name }}</h5>
            <p><strong>Description:</strong> {{ $program->description }}</p>
            <p><strong>Type:</strong> {{ $program->program_type }}</p>
            <p><strong>Status:</strong> {{ $program->status }}</p>
            <p><strong>Start Date:</strong> {{ $program->start_date }}</p>
            <p><strong>End Date:</strong> {{ $program->end_date }}</p>
        </div>
    </div>
    <a href="{{ route('programs.index') }}" class="btn btn-primary">Back to List</a>
@stop
