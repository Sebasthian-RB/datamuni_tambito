<!-- resources/views/areas/SisfohViews/SfhDwelling/edit.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Editar Vivienda</h1>

        <form action="{{ route('sfh_dwelling.update', $sfhDwelling->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $sfhDwelling->address) }}" required>
            </div>

            <div class="form-group">
                <label for="type">Tipo</label>
                <input type="text" name="type" id="type" class="form-control" value="{{ old('type', $sfhDwelling->type) }}" required>
            </div>

            <button type="submit" class="mt-3 btn btn-warning">Actualizar Vivienda</button>
        </form>
    </div>
@endsection
