<!-- resources/views/areas/SisfohViews/SfhDwellings/edit.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Vivienda</h1>
    <form action="{{ route('sfh_dwelling.update', $sfhDwelling) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="street_address" class="form-label">Dirección</label>
            <input type="text" name="street_address" id="street_address" class="form-control" value="{{ $sfhDwelling->street_address }}" required>
        </div>
        <div class="mb-3">
            <label for="reference" class="form-label">Referencia</label>
            <input type="text" name="reference" id="reference" class="form-control" value="{{ $sfhDwelling->reference }}">
        </div>
        <div class="mb-3">
            <label for="neighborhood" class="form-label">Barrio</label>
            <input type="text" name="neighborhood" id="neighborhood" class="form-control" value="{{ $sfhDwelling->neighborhood }}">
        </div>
        <div class="mb-3">
            <label for="district" class="form-label">Distrito</label>
            <input type="text" name="district" id="district" class="form-control" value="{{ $sfhDwelling->district }}" required>
        </div>
        <div class="mb-3">
            <label for="provincia" class="form-label">Provincia</label>
            <input type="text" name="provincia" id="provincia" class="form-control" value="{{ $sfhDwelling->provincia }}" required>
        </div>
        <div class="mb-3">
            <label for="region" class="form-label">Región</label>
            <input type="text" name="region" id="region" class="form-control" value="{{ $sfhDwelling->region }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
