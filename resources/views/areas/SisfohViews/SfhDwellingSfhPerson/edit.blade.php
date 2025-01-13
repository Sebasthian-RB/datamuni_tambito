<!-- resources/views/areas/SisfohViews/SfhDwellingSfhPeople/edit.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Editar Persona en Vivienda</h1>

        <form action="{{ route('areas.SisfohViews.SfhDwellingSfhPerson.update', $sfhDwellingSfhPerson->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $sfhDwellingSfhPerson->name) }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="age">Edad</label>
                <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $sfhDwellingSfhPerson->age) }}">
                @error('age')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="mt-4 btn btn-warning">Actualizar Persona</button>
        </form>
    </div>
@endsection
