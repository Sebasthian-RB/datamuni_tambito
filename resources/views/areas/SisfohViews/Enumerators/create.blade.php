<!-- resources/views/sisfoh/enumerators/create.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Crear Nuevo Encuestador</h1>
    
    <form action="{{ route('enumerators.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
