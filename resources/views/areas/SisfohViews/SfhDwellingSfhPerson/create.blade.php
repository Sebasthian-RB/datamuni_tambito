<!-- resources/views/areas/SisfohViews/SfhDwellingSfhPeople/create.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Agregar Persona a Vivienda</h1>

        <form action="{{ route('areas.SisfohViews.SfhDwellingSfhPerson.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="age">Edad</label>
                <input type="number" name="age" id="age" class="form-control" value="{{ old('age') }}">
                @error('age')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="mt-4 btn btn-success">Guardar Persona</button>
        </form>
    </div>
@endsection
