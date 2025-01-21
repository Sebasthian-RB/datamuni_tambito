@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Crear Instrumento</h1>

        <form action="{{ route('instruments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name_instruments">Nombre del Instrumento</label>
                <input type="text" name="name_instruments" id="name_instruments" class="form-control @error('name_instruments') is-invalid @enderror" value="{{ old('name_instruments') }}" required>
                @error('name_instruments')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="type_instruments">Tipo de Instrumento</label>
                <input type="text" name="type_instruments" id="type_instruments" class="form-control @error('type_instruments') is-invalid @enderror" value="{{ old('type_instruments') }}" required>
                @error('type_instruments')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Crear Instrumento</button>
        </form>
    </div>
@endsection
