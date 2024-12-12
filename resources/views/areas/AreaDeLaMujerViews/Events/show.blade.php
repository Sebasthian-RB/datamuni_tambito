@extends('adminlte::page')

@section('title', 'Event Details')

@section('content_header')
    <h1>Event Details</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5><strong>Name:</strong> {{ $event->name }}</h5>
            <p><strong>Description:</strong> {{ $event->description }}</p>
            <p><strong>Place:</strong> {{ $event->place }}</p>
            <p><strong>Status:</strong> {{ $event->status }}</p>
            <p><strong>Start Date:</strong> {{ $event->start_date }}</p>
            <p><strong>End Date:</strong> {{ $event->end_date }}</p>
            <p><strong>Program:</strong> {{ $event->program->name }}</p>
        </div>
    </div>
    <a href="{{ route('events.index') }}" class="btn btn-primary">Back to List</a>
@stop
