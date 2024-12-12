@extends('adminlte::page')

@section('title', 'Listado de Productos')

@section('content_header')
    <h1>Listado de Productos</h1>
@stop

@section('content')
<div class="container">
    <h1>Detalles del Producto</h1>

    <div class="card">
        <div class="card-header">
            <strong>{{ $product->name }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Descripción:</strong> {{ $product->description }}</p>
        </div>
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Volver a la Lista</a>
</div>
@stop
