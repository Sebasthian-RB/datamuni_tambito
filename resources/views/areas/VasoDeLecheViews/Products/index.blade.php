@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Lista de Productos</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('products.create') }}" class="btn mb-3" style="background-color: #9B7EBD; color: white;">Agregar Producto</a>
    <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-secondary mb-3">Volver</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Productos Registrados</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                @if($product->description)
                                    {{ $product->description }}
                                @else
                                    <span class="text-secondary"> (Sin descripción)</span>
                                @endif
                            </td>                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm" style="background-color: #9B7EBD; color: white;">Ver</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm" style="background-color: #D4BEE4; color: white;">Editar</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"onclick="return confirm('¿Está seguro de eliminar este producto?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop