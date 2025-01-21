!-- resources/views/areas/SisfohViews/SfhDwellings/show.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detalles de la Vivienda</h1>
    <p><strong>Dirección:</strong> {{ $sfhDwelling->street_address }}</p>
    <p><strong>Referencia:</strong> {{ $sfhDwelling->reference }}</p>
    <p><strong>Barrio:</strong> {{ $sfhDwelling->neighborhood }}</p>
    <p><strong>Distrito:</strong> {{ $sfhDwelling->district }}</p>
    <p><strong>Provincia:</strong> {{ $sfhDwelling->provincia }}</p>
    <p><strong>Región:</strong> {{ $sfhDwelling->region }}</p>
    <a href="{{ route('sfh_dwelling.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('sfh_dwelling.edit', $sfhDwelling) }}" class="btn btn-warning">Editar</a>
</div>
@endsection
