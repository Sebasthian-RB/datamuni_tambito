@extends('adminlte::page')

@section('title', 'Editar Cuidador')

@section('content_header')
    <h1>Editar Cuidador</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('caregivers.update', $caregiver) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="full_name">Nombre Completo</label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $caregiver->full_name) }}" required>
                    @error('full_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="relationship">Parentesco</label>
                    <input type="text" name="relationship" class="form-control" value="{{ old('relationship', $caregiver->relationship) }}" required>
                    @error('relationship')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" class="form-control" value="{{ old('dni', $caregiver->dni) }}" maxlength="8" required>
                    @error('dni')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $caregiver->phone) }}">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('caregivers.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
