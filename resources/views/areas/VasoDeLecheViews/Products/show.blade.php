@extends('adminlte::page')

@section('title', 'Detalle del Producto')

@section('content_header')
    <h1>Detalle del Producto</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header p-0 d-flex justify-content-center align-items-center" style="background-color: #3B1E54; height: 60px;">
            <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="height: 80%; width: auto;">
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $product->id }}</p>
            <p><strong>Nombre:</strong> {{ $product->name }}</p>
            <p><strong>Descripción:</strong> 
                @if($product->description)
                    {{ $product->description }}
                @else
                    <span class="text-secondary"> (Sin descripción)</span>
                @endif
            </p>    
        </div>
        <div class="card-footer">
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-secondary" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">Editar</a>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@stop
