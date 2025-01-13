<!-- resources/views/sisfoh/enumerators/edit.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Encuestador</h1>
    
    <form action="{{ route('enumerators.update', $enumerator) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $enumerator->name }}" required>
        </div>
        
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $enumerator->email }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection