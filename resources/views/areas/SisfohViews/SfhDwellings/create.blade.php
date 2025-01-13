<!-- resources/views/areas/SisfohViews/SfhDwelling/create.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Crear Vivienda</h1>

        <form action="{{ route('sfh_dwelling.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
            </div>

            <div class="form-group">
                <label for="type">Tipo</label>
                <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}" required>
            </div>

            <button type="submit" class="mt-3 btn btn-success">Guardar Vivienda</button>
        </form>
    </div>
@endsection
