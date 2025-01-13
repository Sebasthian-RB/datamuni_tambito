<!-- resources/views/sisfoh/requests/edit.blade.php -->

@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Editar Solicitud #{{ $sfhRequest->id }}</h1>
        <form action="{{ route('sfh_requests.update', $sfhRequest) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $sfhRequest->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $sfhRequest->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-warning">Actualizar Solicitud</button>
        </form>
    </div>
@endsection
