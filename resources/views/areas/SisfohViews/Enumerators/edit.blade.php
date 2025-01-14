<!-- resources/views/sisfoh/enumerators/edit.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Encuestador</h1>
    
    <form action="{{ route('enumerators.update', $enumerator) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="identity_document">Tipo de Documento</label>
            <select id="identity_document" name="identity_document" class="form-control" required>
                <option value="DNI" {{ $enumerator->identity_document === 'DNI' ? 'selected' : '' }}>DNI</option>
                <option value="Pasaporte" {{ $enumerator->identity_document === 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                <option value="Carnet de Extranjería" {{ $enumerator->identity_document === 'Carnet de Extranjería' ? 'selected' : '' }}>Carnet de Extranjería</option>
            </select>
        </div>

        <div class="form-group">
            <label for="given_name">Nombre</label>
            <input type="text" id="given_name" name="given_name" class="form-control" value="{{ $enumerator->given_name }}" required>
        </div>

        <div class="form-group">
            <label for="paternal_last_name">Apellido Paterno</label>
            <input type="text" id="paternal_last_name" name="paternal_last_name" class="form-control" value="{{ $enumerator->paternal_last_name }}" required>
        </div>

        <div class="form-group">
            <label for="maternal_last_name">Apellido Materno</label>
            <input type="text" id="maternal_last_name" name="maternal_last_name" class="form-control" value="{{ $enumerator->maternal_last_name }}" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Número de Teléfono</label>
            <input type="tel" id="phone_number" name="phone_number" class="form-control" pattern="[0-9]{9}" placeholder="123456789" value="{{ $enumerator->phone_number }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
