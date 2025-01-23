@extends('adminlte::page')

@section('title', 'Detalles de Vivienda')

@section('content_header')
    <h1>Detalles de Vivienda</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Localización:</strong> {{ $omDwelling->exact_location }}</p>
            <p><strong>Referencia:</strong> {{ $omDwelling->reference ?? 'No especificada' }}</p>
            <p><strong>Anexo/Sector:</strong> {{ $omDwelling->annex_sector ?? 'No especificado' }}</p>
            <p><strong>Agua y/o Luz:</strong> {{ $omDwelling->water_electricity }}</p>
            <p><strong>Tipo de Vivienda:</strong> {{ $omDwelling->type }}</p>
            <p><strong>Situación:</strong> {{ $omDwelling->ownership_status }}</p>
            <p><strong>Ocupantes Permanentes:</strong> {{ $omDwelling->permanent_occupants }}</p>
            <a href="{{ route('om-dwellings.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@stop
